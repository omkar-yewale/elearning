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
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder, RouteMatchInterface $route_match, AccountProxyInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
    $this->routeMatch = $route_match;
    $this->currentUser = $current_user;
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
    // Check if the user is viewing a course node.
    $node = $this->routeMatch->getParameter('node');
    if ($node && $node->getType() == 'course') {
      // Check if the user role is student.
      $user = $this->currentUser;
      if ($user->hasRole('student')) {
        // Return the enrollment form.
        return $this->formBuilder->getForm('Drupal\custom_elearning\Form\EnrollmentStatusForm');
      }
    }

    return [];
  }

}
