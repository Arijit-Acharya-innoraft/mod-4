<?php

namespace Drupal\api_tutorial\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Returns responses for api_tutorial routes.
 */
class ApiTutorialController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $data = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'article']);
    
    foreach($data as $info) {
      $build []= [
      'uid' => $info->get('uuid')->value,
       'data' => [
        'name' => $info->get('title')->value,
        'body' => $info->get('body')->value,

       ]
      ];
    }
    return new JsonResponse($build);
  }

}
