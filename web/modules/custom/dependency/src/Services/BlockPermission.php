<?php

namespace Drupal\dependency\Services;

use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Visibility Control for a block.
 */
class BlockPermission{

  /**
   * Storing a route.
   *
   * @var Drupal\Core\Routing\RouteMatchInterface
   */
  protected $route;

  /**
   * A constructor for storing the default route.
   *
   * @param Drupal\Core\Routing\RouteMatchInterface $route_match_interface
   *   Retrieve information about the current route and its parameters.
   */
  public function __construct(RouteMatchInterface $route_match_interface) {
    $this->route = $route_match_interface;
  }

  /**
   * For restricting the visibility of the block.
   *
   * @return bool
   *   Returns true if the route is in allowed routes, else false.
   */
  public function blockVisibilityRestriction() {
    // Get the current route.
    $routeName = $this->route->getRouteName();
    // Route list for which the blocks are allowed.
    $allowedPages = [
      'dependency.service_controller',
    ];

    if (in_array($routeName, $allowedPages)) {
      return TRUE;
    }

    return FALSE;

  }

}
