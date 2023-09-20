<?php

namespace Drupal\config_entity;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of ces.
 */
class CeListBuilder extends ConfigEntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Label');

    $header['year'] =$this->t('Year');
    // $header['name'] =$this->t('Movie name');
    $header['id'] = $this->t('Machine name');
    // $header['status'] = $this->t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\config_entity\CeInterface $entity */
    $row['label'] = $entity->label();
    $row['year'] = $entity->get('year');
    // $row['name'] = $entity->get('name');
    $row['id'] = $entity->id();
    return $row + parent::buildRow($entity);
  }

}
