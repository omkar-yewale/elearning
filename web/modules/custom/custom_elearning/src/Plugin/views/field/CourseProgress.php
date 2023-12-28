<?php

namespace Drupal\custom_elearning\Plugin\views\field;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a custom Views field for course progress.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("course_progress")
 */
class CourseProgress extends FieldPluginBase {

  /**
   * The current display.
   *
   * @var string
   *   The current display of the view.
   */
  protected $currentDisplay;

  /**
   * The request object.
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
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Constructs a new AvailableRooms object.
   *
   * @param array $configuration
   *   The configuration.
   * @param string $plugin_id
   *   The plugin_id.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   * @param \Drupal\custom_elearning\CommonService $commonService
   *   The common services.
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   *   The current user.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $request, $commonService, AccountProxyInterface $currentUser) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentDisplay = isset($configuration['view']) ? $configuration['view']->current_display : NULL;
    $this->request = $request;
    $this->commonService = $commonService;
    $this->currentUser = $currentUser;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('request_stack')->getCurrentRequest(),
      $container->get('custom_elearning.common_service'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->currentDisplay = $view->current_display;
  }

  /**
   * {@inheritdoc}
   */
  public function usesGroupBy() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    // First check whether the field should be hidden,
    // if the value(hide_alter_empty = TRUE)
    // the rewrite is empty (hide_alter_empty = FALSE).
    $options['hide_alter_empty'] = ['default' => FALSE];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    global $base_url;
    $roles = [];
    $node = $values->_entity;
    if (empty($node)) {
      $node = $values->_relationship_entities['course'];
      $currentUserId = $values->custom_enrollment_course_enrollment_table_user_id;
    }
    else {
      $currentUserId = $this->currentUser->id();
    }
    $courseId = $node->get('nid')->getValue()[0]['value'];
    // Calculate percentage of course complition.
    $percentage = $this->commonService->calculateCoursePercentage($courseId, $currentUserId);
    // Creating output for render.
    $output = '<div class="progress">' . $percentage . '% Complete' . '</div>';
    $roles = $this->currentUser->getRoles();
    // Check if $percentage is 100 and add the view certificate button.
    if ($percentage == 100 && in_array('student', $roles)) {
      $output .= '<a href="' . $base_url . '/my-courses/certificate/' . $courseId . '" class="button button--action button--primary" target="_blank"> View Certificate </a>';
    }
    return [
      '#markup' => $output,
    ];
  }

}
