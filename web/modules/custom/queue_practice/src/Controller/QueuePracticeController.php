<?php

namespace Drupal\queue_practice\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for queue-practice routes.
 */
class QueuePracticeController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
