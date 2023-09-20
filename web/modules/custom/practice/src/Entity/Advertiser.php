<?php

namespace Drupal\practice\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines advertiser entity
 * 
 * @ContentEntityType(
 *  id = "advertiser",
 *  label= @Translation("Advertiser"),
 *  base_table = "advertiser",
 *  entity_keys = {
 *    "id" = "id",
 *    "uuid" = "uuid",
 *   }

 * )
 */
class Advertiser extends ContentEntityBase implements ContentEntityInterface {

  /**
   * @param EntityTypeInterface $entity_type
   *  The entity type definition.
   * 
   * @return array
   *  An array of base field definitions for the entity type.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel('ID')
      ->setDescription(t('The id of the advertiser entity'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel('UUID')
      ->setDescription(t('The uuid of the advertiser entity'))
      ->setReadOnly(TRUE);

    return $fields;
  }
}

