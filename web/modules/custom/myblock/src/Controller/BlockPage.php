<?php
namespace Drupal\myblock\Controller;

use Drupal\Core\Controller\ControllerBase;
/**
 * [Description BlockPage]
 */
class BlockPage extends ControllerBase {


  /**
   * @return [type]
   */
  function pageDisplay() {
   return[
    '#type'=>'markup',
    '#markup' => $this->t('Hello World!')
   ];
  }
}
?>
