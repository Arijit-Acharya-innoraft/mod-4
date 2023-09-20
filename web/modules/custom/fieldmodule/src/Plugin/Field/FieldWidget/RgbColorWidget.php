<?php

namespace Drupal\fieldmodule\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'Rgb_color_code' widget.
 *
 * @FieldWidget(
 *   id = "rgb_widget",
 *   module = "fieldmodule",
 *   label = @Translation("RGB"),
 *   field_types = {
 *     "field_color"
 *   }
 * )
 */
class RgbColorWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // Fetching the stored value from the database
    $hex_value = isset($items[$delta]->hexcode) ? $items[$delta]->hexcode : '';

    $red_value = 0;
    $green_value = 0;
    $blue_value = 0;

    if($hex_value != NULL) {
      $store = $this->convertToRgb($hex_value);
      $red_value = $store[0];
      $green_value = $store[1];
      $blue_value = $store[2];
    }


    $element['red'] = [
      '#type' => 'number',
      '#title' => 'Red color',
      '#default_value' => $red_value,
      '#min' => 0,
      '#max' => 255,
    ];

    $element['green'] = [
      '#type' => 'number',
      '#title' => 'Green color',
      '#default_value' => $green_value,
      '#min' => 0,
      '#max' => 255,
    ];

    $element['blue'] = [
      '#type' => 'number',
      '#title' => 'Blue color',
      '#default_value' => $blue_value,
      '#min' => 0,
      '#max' => 255,
    ];

    return $element;
  }

  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach ($values as &$value) {
      $red = (int) $value['red'];
      $green = (int) $value['green'];
      $blue = (int) $value['blue'];
      $value['hexcode'] = sprintf('#%02x%02x%02x', $red, $green, $blue);
    }

    return $values;
  }

  /**
   * Function for conveting the hexcode value to rgb.
   * 
   * @param $hex_value
   *  Stores the hexcode value from the database.
   * 
   * @return array
   *  An array containing the rgb values.
   */
  public function convertToRgb($hex_value) {
    list($r, $g, $b) = sscanf($hex_value, "#%02x%02x%02x");
    return array($r,$g,$b);
  }

}
