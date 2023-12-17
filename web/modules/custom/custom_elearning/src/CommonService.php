<?php

namespace Drupal\custom_elearning;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * Common service for custom elearning.
 */
class CommonService {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a CommonService.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   *   The current user.
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connector.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, AccountProxyInterface $currentUser, Connection $connection) {
    $this->entityTypeManager = $entity_type_manager;
    $this->currentUser = $currentUser;
    $this->connection = $connection;
  }

  /**
   * Checks Course enrollment status.
   */
  public function checkCourseEnrollmentStatus($courseId) {
    $query = $this->connection->select('custom_enrollment_course_enrollment_table', 'es')
      ->fields('es', ['id'])
      ->condition('es.course_id', $courseId)
      ->condition('es.user_id', $this->currentUser->id())
      ->countQuery();
    $count = $query->execute()->fetchField();

    return $count;
  }

  /**
   * Checks Course enrollment progress status.
   */
  public function checkCourseProgressStatus($courseId, $userId) {
    $query = $this->connection->select('custom_enrollment_course_enrollment_table', 'es')
      ->fields('es', ['course_status'])
      ->condition('es.course_id', $courseId)
      ->condition('es.user_id', $userId);

    $status = $query->execute()->fetchField();

    return $status;
  }

  /**
   * Add course enrollment details into enrollment table.
   */
  public function addCourseEnrollmentDetails($courseId, $courseStatus = NULL) {
    $currentTime = date('Y-m-d H:i:s', \Drupal::time()->getRequestTime());
    $this->connection->merge('custom_enrollment_course_enrollment_table')
      ->key([
        'user_id' => $this->currentUser->id(),
        'course_id' => $courseId,
      ])
      ->fields([
        'user_id' => $this->currentUser->id(),
        'course_id' => $courseId,
        'course_status' => $courseStatus ?? 0,
        'created_date' => $currentTime,
      ])
      ->updateFields([
        'course_status' => $courseStatus ?? 0,
        'updated_date' => $currentTime,
      ])
      ->execute();
  }

  /**
   * Get student all enrolled courses.
   */
  public function getEnrolledCourses($uid) {
    $query = $this->connection->select('custom_enrollment_course_enrollment_table', 'es')
      ->fields('es', ['course_id'])
      ->condition('es.user_id', $uid);
    $result = $query->execute()->fetchCol();

    return $result;
  }

  /**
   * Checks course and lesson association.
   */
  public function checkCourseLessonAssociation($courseNid, $lessonNid) {
    // Check if the course node ID is valid.
    $courseQuery = $this->entityTypeManager->getStorage('node')
      ->getQuery()
      ->condition('type', 'course')
      ->condition('nid', $courseNid)
      ->accessCheck(TRUE)
      ->range(0, 1);

    $courseResult = $courseQuery->execute();
    if (empty($courseResult)) {
      // The course node ID is not valid.
      return 1;
    }

    // Check if the lesson node ID is associated with the course.
    $courseNode = $this->entityTypeManager->getStorage('node')->load($courseNid);
    // Get all lesson IDs associated with the course.
    $associated_lesson_ids = [];
    foreach ($courseNode->get('field_lessons')->referencedEntities() as $lesson) {
      $associated_lesson_ids[] = $lesson->id();
    }

    // Check if the given lesson node ID is among the associated lessons.
    if (!in_array($lessonNid, $associated_lesson_ids)) {
      // The lesson is not associated with the course.
      return 1;
    }

    // Both course and lesson are valid and associated.
    return 0;
  }

  /**
   * Get all completed Leassons.
   */
  public function checkLessonComplete($courseId, $userId) {
    $query = $this->connection->select('custom_enrollment_lesson_completion_table', 'els')
      ->fields('els', ['lesson_id'])
      ->condition('els.user_id', $userId)
      ->condition('els.course_id', $courseId);
    $ids = $query->execute()->fetchCol();

    return $ids;
  }

  /**
   * Checks Leasson complition status.
   */
  public function checkLessonStatus($courseId, $lessonId) {
    $query = $this->connection->select('custom_enrollment_lesson_completion_table', 'els')
      ->fields('els', ['id'])
      ->condition('els.user_id', $this->currentUser->id())
      ->condition('els.course_id', $courseId)
      ->condition('els.lesson_id', $lessonId)
      ->countQuery();
    $count = $query->execute()->fetchField();

    return $count;
  }

  /**
   * Add complete lesson status.
   */
  public function addLessonCompleteDetails($courseId, $lessonId) {
    $currentTime = date('Y-m-d H:i:s', \Drupal::time()->getRequestTime());
    $this->connection->merge('custom_enrollment_lesson_completion_table')
      ->key([
        'user_id' => $this->currentUser->id(),
        'course_id' => $courseId,
        'lesson_id' => $lessonId,
      ])
      ->fields([
        'user_id' => $this->currentUser->id(),
        'course_id' => $courseId,
        'lesson_id' => $lessonId,
        'completion_date' => $currentTime,
      ])
      ->execute();
  }

  /**
   * Checks studend course grade status.
   */
  public function getCourseGrade($courseId, $userId) {
    $query = $this->connection->select('custom_enrollment_course_grade_table', 'cg')
      ->fields('cg', ['course_grade'])
      ->condition('cg.user_id', $userId)
      ->condition('cg.course_id', $courseId);

    $result = $query->execute()->fetchField();

    return $result;
  }

  /**
   * Add course Grade.
   */
  public function addCourseGrade($courseId, $userId, $grade) {
    $currentTime = date('Y-m-d H:i:s', \Drupal::time()->getRequestTime());
    $this->connection->merge('custom_enrollment_course_grade_table')
      ->key([
        'course_id' => $courseId,
        'user_id' => $userId,
      ])
      ->fields([
        'course_id' => $courseId,
        'user_id' => $userId,
        'course_grade' => $grade,
        'created_date' => $currentTime,
      ])
      ->updateFields([
        'course_grade' => $grade,
      ])
      ->execute();
  }

  /**
   * Calculate course completion percentage.
   */
  public function calculateCoursePercentage($courseId, $userId) {
    $courseNode = $this->entityTypeManager->getStorage('node')->load($courseId);
    $associateLessonIds = [];
    foreach ($courseNode->get('field_lessons')->referencedEntities() as $lesson) {
      $associateLessonIds[] = $lesson->id();
    }
    // Get all completed lessons.
    $completedLessons = $this->checkLessonComplete($courseId, $userId);
    // Calculate the common lessons.
    $commonLessons = array_intersect($associateLessonIds, $completedLessons);
    // Calculate the percentage.
    $percentage = (count($commonLessons) > 0) ? round((count($commonLessons) / count($associateLessonIds)) * 100, 2) : 0;

    return $percentage;
  }

}
