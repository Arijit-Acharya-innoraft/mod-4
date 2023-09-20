<?php

namespace Drupal\awards\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\awards\AwardsInterface;

/**
 * Defines the Award entity.
 *
 * @ConfigEntityType(
 *   id = "awards",
 *   label = @Translation("Awards"),
 *   handlers = {
 *     "list_builder" = "Drupal\awards\Controller\AwardsListBuilder",
 *     "form" = {
 *       "add" = "Drupal\awards\Form\AwardsForm",
 *       "edit" = "Drupal\awards\Form\AwardsForm",
 *       "delete" = "Drupal\awards\Form\AwardsDeleteForm",
 *     }
 *   },
 *   config_prefix = "awards",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "year" = "year",
 *     "movies" = "movies"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "year",
 *     "movies"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/awards/{awards}",
 *     "delete-form" = "/admin/config/system/awards/{awards}/delete",
 *   }
 * )
 */
class Awards extends ConfigEntityBase implements AwardsInterface {

  /**
   * The Award ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Award label.
   *
   * @var string
   */
  protected $label;

  /**
   * The award year
   * 
   * @var date
   */

  protected $year;

  /**
   * The awarded movie.
   * 
   * @var string
   */
  protected $movies;
  
}
