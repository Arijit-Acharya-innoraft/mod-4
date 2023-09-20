<?php

namespace Drupal\myservice\Plugin\Block;

use Drupal\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\user\Plugin\views\argument_default\CurrentUser;

/**
 * Display a basic Block displaying user role.
 *
 * @Block(
 *  id = "serviceblock",
 *  admin_label = "Service Block",
 *  category = "Service"
 * )
 */
class ServiceBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $visibility = \Drupal::service('myservice.block_visibiity')->blockVisibilityRestriction();

    if ($visibility) {
      $data = \Drupal::service('myservice.with_service')->getRole();
      $userRoles = implode(" ", $data);
      return [
        '#type' => 'markup',
        '#markup' => $userRoles,
      ];
    }

  }

}
