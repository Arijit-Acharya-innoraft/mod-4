<?php

namespace Drupal\myblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *  id = "first_custom_block",
 *  admin_label = @Translation("First Custom Block"),
 *  category = @Translation("Custom Block")
 *  )
 */

 class CustomBlock extends BlockBase {

  /**
   * @return [type]
   */
  public function build() {
    $roles = \Drupal::currentUser()->getRoles();
    foreach ($roles as $role){
      $encoded_tags[] = \Drupal\Component\Utility\Tags::encode($role);
    }
    $str = implode(', ', $encoded_tags);
    return[
      '#type' => 'markup',
      '#markup' => $this->t('Welcome @role',[
        '@role'=> $str
      ])
    ];
  }
 }
?>
