<?php

namespace Drupal\f1\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'f1_newfield_default' formatter.
 *
 * @FieldFormatter(
 *   id = "f1_newfield_default",
 *   label = @Translation("Default"),
 *   field_types = {"f1_newfield"}
 * )
 */
class NewfieldDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  // public static function defaultSettings() {
  //   return ['foo' => 'bar'] + parent::defaultSettings();
  // }

  // /**
  //  * {@inheritdoc}
  //  */
  // public function settingsForm(array $form, FormStateInterface $form_state) {
  //   $settings = $this->getSettings();
  //   $element['foo'] = [
  //     '#type' => 'textfield',
  //     '#title' => $this->t('Foo'),
  //     '#default_value' => $settings['foo'],
  //   ];
  //   return $element;
  // }

  // /**
  //  * {@inheritdoc}
  //  */
  // public function settingsSummary() {
  //   $settings = $this->getSettings();
  //   $summary[] = $this->t('Foo: @foo', ['@foo' => $settings['foo']]);
  //   return $summary;
  // }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {

      if ($item->value_1) {
        $element[$delta]['value_1'] = [
          '#type' => 'item',
          '#title' => $this->t('Value 1'),
          '#markup' => $item->value_1,
        ];
      }

      if ($item->value_2) {
        $element[$delta]['value_2'] = [
          '#type' => 'item',
          '#title' => $this->t('Value 2'),
          '#markup' => $item->value_2,
        ];
      }

      $element[$delta]['value_3'] = [
        '#type' => 'item',
        '#title' => $this->t('Value 3'),
        '#markup' => $item->value_3 ? $this->t('Yes') : $this->t('No'),
      ];

    }

    return $element;
  }

}
