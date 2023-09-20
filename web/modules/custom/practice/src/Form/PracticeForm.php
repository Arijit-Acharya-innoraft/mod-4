<?php

namespace Drupal\practice\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * [Description PracticeForm]
 */
class PracticeForm extends FormBase {

  protected $loaddata;

  /**
   * @return [type]
   */
  public function getFormId() {
    return 'practice_form';
  }

  public function __construct() {
    $this->loaddata = \Drupal::service('practice.dbinsert');
    
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * 
   * @return [type]
   */
  function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => 'Name',
      '#required' => TRUE,
      '#length' =>255
    ];

    $form['mail']= [
      '#type' => 'email',
      '#title' => 'Email',
      '#required' =>TRUE,
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => 'Password',
      '#required' => TRUE,
      '#length' => 50
    ];

    $form['submit'] = [
      '#type' =>'submit',
      '#value' => 'Register'
    ];

    return $form;
    
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * 
   * @return [type]
   */
  function submitForm(array &$form, FormStateInterface $form_state) {
    $query = $this->loaddata->setData($form_state);
    \Drupal::messenger()->addMessage($this->t('Your Response has been collected'),'status');
  }
}

?>
