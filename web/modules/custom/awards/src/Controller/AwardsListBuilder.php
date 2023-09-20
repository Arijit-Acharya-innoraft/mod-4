<?php

namespace Drupal\awards\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Example.
 */
class AwardsListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Award');
    $header['id'] = $this->t('Machine name');
    $header['year'] =$this->t('year');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['year'] = $entity->get('year');
    // You probably want a few more properties here...

    return $row + parent::buildRow($entity);
  }

}
