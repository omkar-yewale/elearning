<?php

namespace Drupal\custom_elearning\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\custom_elearning\CommonService;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a Custom elearning lessons complete form.
 */
class GradeSubmitForm extends FormBase {

  /**
   * The current user service.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Symfony Request Object.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * The common service.
   *
   * @var \Drupal\custom_elearning\CommonService
   */
  protected $commonService;

  /**
   * {@inheritdoc}
   */
  public function __construct(AccountProxyInterface $currentUser, Connection $database, Request $request, CommonService $commonService) {
    $this->currentUser = $currentUser;
    $this->database = $database;
    $this->request = $request;
    $this->commonService = $commonService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('database'),
      $container->get('request_stack')->getCurrentRequest(),
      $container->get('custom_elearning.common_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'custom_elearning_enrollment_status';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Get the current View course ID.
    $node = $this->request->attributes->get('node');
    $userId = $this->request->get('uid');
    if ($node instanceof NodeInterface && $node->bundle() == 'course') {
      $courseId = $node->id();
      // Check course grade result.
      $grade = $this->commonService->getCourseGrade($courseId, $userId);

      // Hidden fields.
      $form['course_id'] = [
        '#type' => 'hidden',
        '#value' => $courseId,
      ];
      $form['user_id'] = [
        '#type' => 'hidden',
        '#value' => $userId,
      ];
      $form['grade'] = [
        '#type' => 'select',
        '#title' => $this->t('Grade the Course'),
        '#required' => TRUE,
        '#default_value' => $grade ?? 1,
        '#options' => [
          '1' => $this->t('1 star'),
          '2' => $this->t('2 stars'),
          '3' => $this->t('3 stars'),
          '4' => $this->t('4 stars'),
          '5' => $this->t('5 stars'),
        ],
      ];

      $form['actions'] = [
        '#type' => 'actions',
        'submit' => [
          '#type' => 'submit',
          '#value' => $this->t('Submit Grade'),
        ],
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $courseId = $form_state->getValue('course_id');
    $userId = $form_state->getValue('user_id');
    $grade = $form_state->getValue('grade');
    // Before submiting grade validate user course progress.
    $currentStatus = $this->commonService->checkCourseProgressStatus($courseId, $userId);
    if ($currentStatus == 2) {
      $this->commonService->addCourseGrade($courseId, $userId, $grade);
      $this->messenger()->addStatus($this->t('Grade submitted successfully.'));
    }
    else {
      $this->messenger()->addError($this->t('100% Course not completed yet from user.'));
    }

  }

}
