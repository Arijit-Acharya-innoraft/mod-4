<?php

namespace Drupal\myroute\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Implementing applications of routing.
 */
class ChangeRoute extends RouteSubscriberBase {

  /**
   * Method for changing the route provided in routing.yml file to another.
   */
  public function alterRoutes(RouteCollection $collection) {

    $route_file_name = 'myroute.practicingRoute';
    // Getting the route name of the routing.yml file.
    $route = $collection->get($route_file_name);
    $new_path = '/altered_route';
    // Checking route presence for redirecting.
    if ($route) {
      $route->setPath($new_path);
      $route->setRequirement('_role', 'administrator');
    }
  }

}
