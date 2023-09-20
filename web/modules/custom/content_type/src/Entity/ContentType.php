<?php

namespace Drupal\content_type\Entity;

use Drupal\content_type\ContentTypeInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the content type entity
 * 
 * @ConfigEntityType(
 *   id = "content_type",
 *   label = @Translation("Content Type"),
 *   handlers = {
 *     "list_builder" = "Drupal\content_type\Controller\ExampleListBuilder",
 *     "form" = {
 *       "add" = "Drupal\content_type\Form\ExampleForm",
 *       "edit" = "Drupal\content_type\Form\ExampleForm",
 *       "delete" = "Drupal\content_type\Form\ExampleDeleteForm",
 *     }
 *   },
 *   config_prefix = "content_type",
 *   admin_permission = "administer content_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/content_type/{content_type}",
 *     "delete-form" = "/admin/config/system/content_type/{content_type}/delete",
 *   }
 * )
 * 
 */
class ContentType extends ConfigEntityBase implements ContentTypeInterface {

    /**
   * The Example ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Example label.
   *
   * @var string
   */
  protected $label;

}