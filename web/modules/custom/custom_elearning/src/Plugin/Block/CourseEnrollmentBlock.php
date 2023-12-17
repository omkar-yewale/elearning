<?php

namespace Drupal\custom_elearning\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a course enrollment block.
 *
 * @Block(
 *   id = "custom_elearning_course_enrollment",
 *   admin_label = @Translation("Course Enrollment"),
 *   category = @Translation("Custom"),
 * )
 */
class CourseEnrollmentBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * The route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * The current user service.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder, RouteMatchInterface $route_match, AccountProxyInterface $currentUser) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
    $this->routeMatch = $route_match;
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
      $container->get('form_builder'),
      $container->get('current_route_match'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = [];
    $node = $this->routeMatch->getParameter('node');
    // Check if the user is viewing a course or lessons node.
    if ($node && $user = $this->currentUser) {
      if ($node->getType() == 'course' && $user->hasRole('student')) {
        // Return the enrollment form.
        $form = $this->formBuilder->getForm('Drupal\custom_elearning\Form\EnrollmentStatusForm');
      }
      elseif ($node->getType() == 'lessons' && $user->hasRole('student')) {
        // Return the lesson complete form.
        $form = $this->formBuilder->getForm('Drupal\custom_elearning\Form\LessonStatusForm');
      }
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    // Set the maximum age of the cache to 0 (no caching).
    return 0;
  }

}
