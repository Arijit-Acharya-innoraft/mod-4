<?php

namespace Drupal\f1\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'f1_newfield' field type.
 *
 * @FieldType(
 *   id = "f1_newfield",
 *   label = @Translation("newfield"),
 *   category = @Translation("General"),
 *   default_widget = "f1_newfield",
 *   default_formatter = "f1_newfield_default"
 * )
 */
class NewfieldItem extends FieldItemBase {


  /**
   * {@inheritdoc}
   */
  // public function isEmpty() {
  //   if ($this->value_1 !== NULL) {
  //     return FALSE;
  //   }
  //   elseif ($this->value_2 !== NULL) {
  //     return FALSE;
  //   }
  //   elseif ($this->value_3 == 1) {
  //     return FALSE;
  //   }
  //   return TRUE;
  // }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['value_1'] = DataDefinition::create('string')
      ->setLabel(t('Value 1'));
    $properties['value_2'] = DataDefinition::create('integer')
      ->setLabel(t('Value 2'));
    $properties['value_3'] = DataDefinition::create('boolean')
      ->setLabel(t('Value 3'));

    return $properties;
  }



  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'value_1' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'value_2' => [
        'type' => 'int',
        'size' => 'normal',
      ],
      'value_3' => [
        'type' => 'int',
        'size' => 'tiny',
      ],
    ];

    $schema = [
      'columns' => $columns,
    ];

    return $schema;
  }

}
