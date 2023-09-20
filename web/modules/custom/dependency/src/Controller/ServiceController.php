<?php
namespace Drupal\dependency\Controller;

use Drupal\Core\Controller\ControllerBase;
/**
 * [Description BlockPage]
 */
class ServiceController extends ControllerBase {

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
