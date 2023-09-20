<?php
namespace Drupal\practice\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Displays a basic block.
 * 
 * @Block(
 *  id = "practice",
 *  admin_label = "practice block",
 *  category = "Practice"
 * )
 */
class PracticeBlock extends BlockBase {

  function build() {
    $data = \Drupal::service('practice.dbinsert')->getData();
    $str ="";
    foreach($data as $d){
      $str = $str ." ". $d->name ;
    }
    
    return[
      '#type' => 'markup',
      '#markup' =>$str
    ];
  }

}

?>
