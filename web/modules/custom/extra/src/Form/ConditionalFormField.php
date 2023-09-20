<?php

namespace Drupal\extra\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ConditionalFormField extends FormBase {

  public function getFormId() {
    return 'conditional_form_id'; 
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['color'] =[
      '#type' => 'radios',
      '#title'=> 'Choose Color',
      '#options' =>[
        'red' => 'Red',
        'blue'=>'Blue',
        'yellow' => 'Yellow',
        'green' => 'Green',
        'other' => 'Other'
      ],
      '#attributes' => [
        'id' =>'field_color_select'
      ]
    ];

    $form['custom_color'] = [
      '#type' => 'textfield',
      '#size' => '50',
      '#placeholder' => 'Enter favourite color',
      '#attributes' => [
        'id' => 'custom_color_addition'
      ],
      '#states' =>[
        'visible' => [
          ':input[id ="field_color_select"]' => ['value' =>'other'], 
        ]
      ]
    ];

    $form['submit'] =[
      '#type' =>'submit',
      '#value' =>$this->t('Submit')

    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('You have choosen the color'));
   
  }
}

?>
