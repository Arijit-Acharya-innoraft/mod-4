<?php

namespace Drupal\my_menu\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {

  public function normalMenu() {
    return[
      '#type'=>'markup',
      '#markup'=>'This page is for menu.'
    ];
  }

  public function localTask() {
    return [
      '#type' => 'markup',
      '#markup' => 'Used for creating a local task Menu.These are tabs.
       Thesed are local to the displayed page.
       These are mostly used in administrative pages.'
    ];
  }

  public function localAction() {
    return [
      '#type' => 'markup',
      '#markup' => 'These are responsible to conduct a action rather than display an information. '
    ];
  }

  public function contextualMenu() {
    return[
      '#type' => 'markup',
      '#markup'=> 'These are the fields present in the edit/Configuration option.'
    ];
  }

  
  
}