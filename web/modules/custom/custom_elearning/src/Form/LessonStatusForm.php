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
class LessonStatusForm extends FormBase {

  /**
   * Current User Object.
   */
  protected AccountProxyInterface $currentUser;

  /**
   * Database connection Object.
   */
  protected Connection $database;
  /**
   * Symfony Request Object.
   */
  protected Request $request;

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
    $courseId = $this->request->get('cid');
    if ($node instanceof NodeInterface && $node->bundle() == 'lessons') {
      $lessonId = $node->id();
      // Check course enrollment status.
      $status = $this->commonService->checkLessonStatus($courseId, $lessonId);
      $isEnrolled = ($status == 0);
      // Hidden fields.
      $form['course_id'] = [
        '#type' => 'hidden',
        '#value' => $courseId,
      ];

      $form['leasson_id'] = [
        '#type' => 'hidden',
        '#value' => $lessonId,
      ];

      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $isEnrolled ? 'Complete Lesson' : 'Lesson Already Completed',
        '#attributes' =>
        $isEnrolled ? [] : ['readonly' => 'readonly', 'disabled' => 'disabled'],
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $courseId = $form_state->getValue('course_id');
    $lessonId = $form_state->getValue('leasson_id');
    // Check course and leasson node association.
    $association = $this->commonService->checkCourseLessonAssociation($courseId, $lessonId);
    if ($association == 0) {
      // Check user has already enroll the course or not.
      $status = $this->commonService->checkLessonStatus($courseId, $lessonId);
      if ($status != 0) {
        $this->messenger()->addError($this->t('You already completed this lesson.'));
      }
      else {
        // Add data into lesson completion table.
        $this->commonService->addLessonCompleteDetails($courseId, $lessonId);
        $form_state->setRedirect('view.my_learning.page_1');
        $this->messenger()->addStatus($this->t('Successfully completed lesson.'));
      }
    }
    else {
      $this->messenger()->addError($this->t('Something went wrong.'));
    }
  }

}
