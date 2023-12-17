<?php

namespace Drupal\custom_elearning\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\custom_elearning\CommonService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns completed course certificate.
 */
class CourseCertificate extends ControllerBase {

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
  protected $connection;

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
   * Build the response for certificate.
   */
  public function getCertificate($cid) {
    $currentUid = $this->currentUser;
    $userName = $currentUid->getDisplayName();
    $courseNode = $this->entityTypeManager->getStorage('node')->load($cid);
    $courseTitle = $courseNode->getTitle();
    $date = date('d/m/y');

    return [
      '#theme' => 'certificate_generate',
      "#user_name" => $userName,
      "#course_title" => $courseTitle,
      "#date" => $date,
    ];
  }

}
