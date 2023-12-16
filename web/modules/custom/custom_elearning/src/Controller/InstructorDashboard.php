<?php

namespace Drupal\custom_elearning\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\custom_elearning\CommonService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns all details for instructor role user.
 */
class InstructorDashboard extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected Connection $connection;

  /**
   * The current user service.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The common service.
   *
   * @var \Drupal\custom_elearning\CommonService
   */
  protected $commonService;

  /**
   * The controller constructor.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, Connection $connection, AccountProxyInterface $currentUser, CommonService $commonService) {
    $this->entityTypeManager = $entityTypeManager;
    $this->connection = $connection;
    $this->currentUser = $currentUser;
    $this->commonService = $commonService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('database'),
      $container->get('current_user'),
      $container->get('custom_elearning.common_service')
    );
  }

  /**
   * Build the response.
   */
  public function getDashboardData() {
    // Get student enrollment course data from course enrollment table.
    $query = $this->connection->select('custom_enrollment_course_enrollment_table', 'cect')
      ->fields('cect');
    $result = $query->execute()->fetchAll();
    foreach ($result as $row) {
      $courseId = $row->course_id;
      $userId = $row->user_id;
      $courseNode = $this->entityTypeManager->getStorage('node')->load($courseId);
      $progress = $this->commonService->calculateCoursePercentage($courseId, $userId);
      $courseTitle = $courseNode->getTitle();
      $studentUser = $this->entityTypeManager->getStorage('user')->load($userId);
      $studentName = $studentUser->getDisplayName();

      $dashboardData[] = [
        "courseId" => $courseId,
        "userId" => $userId,
        "studentName" => $studentName,
        "courseTitle" => $courseTitle,
        "progress" => $progress,
        "createdDate" => $row->created_date,
      ];
    }

    $build = [
      '#theme' => 'instructor_dashboard',
      '#data' => $dashboardData,
    ];

    // Indicate that the render array should not be cached.
    \Drupal::service('renderer')->addCacheableDependency($build, $dashboardData);

    return $build;
  }

}
