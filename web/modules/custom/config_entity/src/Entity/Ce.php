<?php

namespace Drupal\config_entity\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\config_entity\CeInterface;

/**
 * Defines the ce entity type.
 *
 * @ConfigEntityType(
 *   id = "ce",
 *   label = @Translation("Ce"),
 *   label_collection = @Translation("Ces"),
 *   label_singular = @Translation("ce"),
 *   label_plural = @Translation("ces"),
 *   label_count = @PluralTranslation(
 *     singular = "@count ce",
 *     plural = "@count ces",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\config_entity\CeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\config_entity\Form\CeForm",
 *       "edit" = "Drupal\config_entity\Form\CeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "ce",
 *   admin_permission = "administer ce",
 *   links = {
 *     "collection" = "/admin/structure/ce",
 *     "add-form" = "/admin/structure/ce/add",
 *     "edit-form" = "/admin/structure/ce/{ce}",
 *     "delete-form" = "/admin/structure/ce/{ce}/delete"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "name" = "name",
 *     "year" = "year"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "name",
 *     "year"
 *   }
 * )
 */
class Ce extends ConfigEntityBase implements CeInterface {

  /**
   * The ce ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The ce label.
   *
   * @var string
   */
  protected $label;

  /**
   * The ce status.
   *
   * @var bool
   */
  // protected $status;

  /**
   * The ce description.
   *
   * @var string
   */
  // protected $description;

  /**
   * The ce field_name
   * 
   * @var string 
   */
  // protected $name;

   /**
   * The ce field_year
   * 
   * @var year 
   */
  protected $year;
}
