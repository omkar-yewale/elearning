<?php

namespace Drupal\custom_elearning\Plugin\views\field;

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
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $request, $commonService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentDisplay = $configuration['view']->current_display;
    $this->request = $request;
    $this->commonService = $commonService;
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
      $container->get('custom_elearning.common_service')
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
    $node = $values->_entity;
    $courseId = $node->get('nid')->getValue()[0]['value'];
    $totalLessons = count($node->get('field_lessons')->referencedEntities());
    $completedLessons = $this->commonService->checkLessonComplete($courseId);
    $percentage = ($totalLessons > 0) ? ((int) $completedLessons / (int) $totalLessons) * 100 : 0;
    return [
      '#markup' => '<div class="fa">' . $percentage . '% Complete' . '</div>',
    ];
  }

}
