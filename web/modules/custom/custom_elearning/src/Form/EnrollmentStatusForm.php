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
 * Provides a Custom elearning enrollment course form.
 */
class EnrollmentStatusForm extends FormBase {

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
    // Get the current course ID.
    $node = $this->request->attributes->get('node');
    if ($node instanceof NodeInterface && $node->bundle() == 'course') {
      $courseId = $node->id();
      // Check course enrollment status.
      $status = $this->commonService->checkCourseEnrollmentStatus($courseId);
      $isEnrolled = ($status == 0);
      // Hidden field.
      $form['course_id'] = [
        '#type' => 'hidden',
        '#value' => $courseId,
      ];

      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $isEnrolled ? 'Enroll For this course' : 'Already Enrolled',
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
    // Check user has already enroll the course or not.
    $status = $this->commonService->checkCourseEnrollmentStatus($courseId);
    if ($status != 0) {
      $this->messenger()->addError($this->t('You alreadye enrolled for this course.'));
    }
    else {
      $this->commonService->addCourseEnrollmentDetails($courseId, 0);
      $this->messenger()->addStatus($this->t('Successfully enrolled in the course'));
    }
  }

}
