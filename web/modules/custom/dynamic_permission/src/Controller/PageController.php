<?php

namespace Drupal\dynamic_permission\Controller;

// use Drupal\Core\Controller\ControllerBase;
// use Drupal\Core\Entity\EntityTypeManagerInterface;
// use Symfony\Component\DependencyInjection\ContainerInterface;
// use Drupal\Core\Session\AccountInterface;

// class DynamicPermissions extends ControllerBase {

//   protected $entityManager;


//   public function __construct(EntityTypeManagerInterface $entityManager) {
//     $this->entityManager = $entityManager;
//   }

//   public static function create(ContainerInterface $container) {
//     return new static(
//       $container->get('entity_type.manager')
//     );
//   }

// }


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\Entity\NodeType;


class PageController extends ControllerBase {
  public function PageTitle(Node $node) {
    if (!empty($node)) {
      $title = $node->getTitle();
      return [
        '#markup' => "Node of " . $title,
      ];
    }
  }

  public function NodeData(Node $node) {
    return [
        '#markup' => "Sample Controller Page",
    ];
  }

  public function dynamicPermissions() {
    $perms = [];
    // Generate node permissions for all node types.
    foreach (NodeType::loadMultiple() as $type) {
      $type_id = $type->id();
      $type_params = ['%type' => $type->label()];
      $perms += [
        "controller $type_id perm" => [
          'title' => $this->t('%type: controller permission', $type_params),
          'description' => "permission for controller based on node",
        ],
      ];
    }
    return $perms;
  }

  public function accessController(AccountInterface $account, $node) {
    $node = Node::load($node);
    $type_id = $node->bundle();
    if ($account->hasPermission("controller $type_id perm")) {
      $result = AccessResult::allowed();
    }
    else {
      $result = AccessResult::forbidden();
    }

    $result->addCacheableDependency($node);

    return $result;
  }

}