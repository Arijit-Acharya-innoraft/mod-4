<?php

namespace Drupal\custom_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\custom_entity\CustomEntityInterface;

/**
 * Defines the custom entity entity type.
 *
 * @ConfigEntityType(
 *   id = "custom_entity",
 *   label = @Translation("Custom Entity"),
 *   label_collection = @Translation("Custom Entities"),
 *   label_singular = @Translation("custom entity"),
 *   label_plural = @Translation("custom entities"),
 *   label_count = @PluralTranslation(
 *     singular = "@count custom entity",
 *     plural = "@count custom entities",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\custom_entity\CustomEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\custom_entity\Form\CustomEntityForm",
 *       "edit" = "Drupal\custom_entity\Form\CustomEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "custom_entity",
 *   admin_permission = "administer custom_entity",
 *   links = {
 *     "collection" = "/admin/structure/custom-entity",
 *     "add-form" = "/admin/structure/custom-entity/add",
 *     "edit-form" = "/admin/structure/custom-entity/{custom_entity}",
 *     "delete-form" = "/admin/structure/custom-entity/{custom_entity}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description"
 *   }
 * )
 */
class CustomEntity extends ConfigEntityBase implements CustomEntityInterface {

  /**
   * The custom entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The custom entity label.
   *
   * @var string
   */
  protected $label;

  /**
   * The custom entity status.
   *
   * @var bool
   */
  protected $status;

  /**
   * The custom_entity description.
   *
   * @var string
   */
  protected $description;

}
