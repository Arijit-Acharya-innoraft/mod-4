<?php

namespace Drupal\fieldmodule\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Plugin implementation of the 'ColorPicker' widget.
 *
 * @FieldWidget(
 *   id = "colorpicker_widget",
 *   module = "fieldmodule",
 *   label = @Translation("ColorPicker"),
 *   field_types = {
 *     "field_color"
 *   }
 * )
 */
class ColorPickerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    
    $value = isset($items[$delta]->hexcode) ? $items[$delta]->hexcode : '';

    $element['hexcode'] = [
      '#type' => 'color',
      '#title'=>'Pick Color',
      '#default_value' => $value,
      '#size' => 10,
      '#maxlength' => 10,
    ];
    return $element;
  }
}