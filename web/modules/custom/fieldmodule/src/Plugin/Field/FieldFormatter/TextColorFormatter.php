<?php

namespace Drupal\fieldmodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Template\Attribute;

/**
 * Plugin implementation of the 'text color' formatter.
 *
 * @FieldFormatter(
 *   id = "text_formatter",
 *   label = @Translation("Text color"),
 *   field_types = {
 *     "field_color"
 *   }
 * )
 */
class TextColorFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $elements = [];
    foreach ($items as $delta => $item) {
      // Storing the color
      $color = $item->hexcode;
      // Storing that particuar entity.
      $entity = $item->getEntity();
      // Fetching that entity's body value.
      $body_value = $entity->body->value;
      $attributes = new Attribute();
      $attributes->setAttribute('style', 'color: ' . $color);
      $elements[$delta] = [
        '#type' => 'html_tag',
        '#tag' => 'div',
        '#value' => $body_value,
        '#attributes' => $attributes->toArray(),
      ];
    }

    return $elements;
  }

}
