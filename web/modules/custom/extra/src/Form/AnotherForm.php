<?php

namespace Drupal\extra\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AnotherForm extends FormBase {

  public function getFormId() {
    return 'another_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // Create an array of main checkboxes and sub-checkboxes.
    $options = [
      'option1' => 'Option 1',
      'option2' => 'Option 2',
      'option3' => 'Option 3',
    ];

    $form['main_checkboxes'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Show Additional Checkboxes'),
      '#options' => $options,
      
    ];

    $form['sub-checkboxes_wrapper'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'sub-checkboxes-wrapper'],
    ];

    // Sub-checkboxes. Initially hidden.
    for ($i = 1; $i <= 3; $i++) {
      $form['sub-checkboxes_wrapper']['sub_checkbox_' . $i] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Sub Checkbox ' . $i),
        '#states' => [
          'visible' => [
            ':input[name^="main_checkboxes[option"]' => ['checked' => TRUE],
          ],
        ],
      ];
    }

    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Handle form submission here.
    $this->messenger()->addStatus($this->t('Form submitted.'));
  }

  /**
   * AJAX callback to show/hide additional checkboxes.
   */
  public function ajaxCallback(array &$form, FormStateInterface $form_state) {
    return $form['sub-checkboxes_wrapper'];
  }

}

