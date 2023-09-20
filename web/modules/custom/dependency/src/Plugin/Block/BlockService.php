<?php

namespace Drupal\dependency\Plugin\Block;

use Drupal\block\Plugin\migrate\process\BlockVisibility; 
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\dependency\Services\WithService;
use Drupal\dependency\Services\BlockPermission;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Block(
 *   id = "blockid",
 *   admin_label = @Translation("Block Title"),
 *   category = @Translation("Blockid")
 * )
 */
class BlockService extends BlockBase implements ContainerFactoryPluginInterface {

  protected $user;
  protected $visibility;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, WithService $user, BlockPermission $visibility) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->user = $user;
    $this->visibility = $visibility;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('dependency.with_service'),
      $container->get('dependency.block_visibility') 
    );
  }
  

  public function build() {
    $permission = $this->visibility->blockVisibilityRestriction();
    $data = $this->user->getRole();
    if ($permission) {
      $user_roles = implode(" ", $data);
      return [
        '#type' => 'markup',
        '#markup' => $this->t('Welcome @user_roles!', [
          '@user_roles' => $user_roles,
        ]),
      ];
    } 
  }
}
