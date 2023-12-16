<?php

namespace Drupal\custom_elearning\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\custom_elearning\CommonService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a course grade block.
 *
 * @Block(
 *   id = "custom_elearning_course_grade",
 *   admin_label = @Translation("Course Grade"),
 *   category = @Translation("Custom"),
 * )
 */
class CourseGradeBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
   * The current request object.
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
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder, RouteMatchInterface $route_match, AccountProxyInterface $currentUser, Request $request, CommonService $commonService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
    $this->routeMatch = $route_match;
    $this->currentUser = $currentUser;
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
      $container->get('form_builder'),
      $container->get('current_route_match'),
      $container->get('current_user'),
      $container->get('request_stack')->getCurrentRequest(),
      $container->get('custom_elearning.common_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Check if the user is viewing a course node.
    $node = $this->routeMatch->getParameter('node');
    $uid = $this->request->get('uid');
    $currentStatus = $this->commonService->checkCourseProgressStatus($node->id(), $uid);
    if (!empty($uid) && $currentStatus == 2) {
      if ($node && $node->getType() == 'course') {
        // Check if the user role is student.
        $user = $this->currentUser;
        if ($user->hasRole('instructor')) {
          // Return the enrollment form.
          $form = $this->formBuilder->getForm('Drupal\custom_elearning\Form\GradeSubmitForm');
        }
      }
    }

    return $form ?? [];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    // Set the maximum age of the cache to 0 (no caching).
    return 0;
  }

}
