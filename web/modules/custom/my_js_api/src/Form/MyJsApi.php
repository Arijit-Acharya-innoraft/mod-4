<?php

namespace Drupal\my_js_api\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyJsApi extends FormBase{

  public function getFormId() {
    return 'my_js_api';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['ph_no'] = [
      '#type' => 'tel',
      '#title' =>$this->t("Phone no")
    ];
    
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Your form is submitted'));    
  }
}