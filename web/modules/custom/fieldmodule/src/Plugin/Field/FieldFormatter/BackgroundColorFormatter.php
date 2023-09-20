<?php

namespace Drupal\fieldmodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Template\Attribute;

/**
 * Plugin implementation of the 'background color' formatter.
 *
 * @FieldFormatter(
 *   id = "background_formatter",
 *   label = @Translation("Background color"),
 *   field_types = {
 *     "field_color"
 *   }
 * )
 */
class BackgroundColorFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      $color = $item->hexcode;
      $attributes = new Attribute();
      $attributes->setAttribute('style', 'background-color: ' . $color);
      $elements[$delta] = [
        '#type' => 'html_tag',
        '#tag' => 'div',
        '#value' => $color,
        '#attributes' => $attributes->toArray(),
        // '#attributes'=>[
          // 'style' => 'background-color: ' . $color . ';',
        // ]
      ];
    
    }
    return $elements;
  }

}
