<?php

namespace Drupal\configform\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ConfigForm.
 */
class CustomConfigForm extends ConfigFormBase {

  /**
   * Settings variable.
   */
  const CONFIGNAME = "configform.settings";

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'configform_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
      static::CONFIGNAME,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::CONFIGNAME);
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#default_value' => $config->get('full_name'),
    ];

    $form['phone_no'] = [
      '#type' => 'tel',
      '#title' => 'Phone No',
      '#default_value' => $config->get('phone_no'),
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => 'Email Id',
      '#default_value' => $config->get('email'),
    ];

    $form['gender'] = [
      '#type' => 'radios',
      '#title' => 'Gender',
      '#options' => ['Male' => 'Male', 'Female' => 'Female', 'Others' => 'Others'],
      '#default_value' => $config->get('gender'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $publicDomains = ['gmail', 'yahoo', 'outlook'];
    $email = $form_state->getValue('email');
    $locAtTheRate = strrpos($email, "@") + 1;
    $substring = substr($email, $locAtTheRate);
    $locDot = strrpos($substring, ".");
    $domainName = substr($substring, 0, $locDot);

    // Validation of Full name.
    if (preg_match("/^[a-zA-Z]+$/", $form_state->getValue('full_name')) == FALSE) {
      $form_state->setErrorByName('full_name', $this->t('Only text allowed'));
    }

    // Validation of Phone Number.
    if (preg_match("/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/", $form_state->getValue('phone_no')) == FALSE) {
      $form_state->setErrorByName('phone_no', $this->t('Only numbers are allowed'));
    }

    // if(strlen($form_state->getValue('phone_no'))!=10){
    //   $form_state ->setErrorByName('phone_no',$this->t('Enter a valid phone no'));
    // }.
    // if(preg_match("/^[0-9]+$/", $form_state->getValue('phone_no')) == FALSE){
    //     $form_state->setErrorByName('phone_no',$this->t('Only numbers are allowed'));
    //   }.
    if (strlen($form_state->getValue('phone_no')) < 10 && strlen($form_state->getValue('phone_no')) > 13) {
      $form_state->setErrorByName('phone_no', $this->t('Enter a valid phone no'));
    }
    // Validation of email.
    if (preg_match("/^[a-zA-Z0-9\+\-\_\~\.\@]+$/", $form_state->getValue('email')) == FALSE) {
      $form_state->setErrorByName('email', $this->t('Input proper email id'));
    }
    if (!str_ends_with($form_state->getValue('email'), ".com")) {
      $form_state->setErrorByName('email', $this->t('You will be blacklisted'));
    }
    if (!in_array($domainName, $publicDomains)) {
      $form_state->setErrorByName('email', $this->t('Not in public domain'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::CONFIGNAME);
    $config->set('full_name', $form_state->getValue('full_name'));
    $config->set('phone_no', $form_state->getValue('phone_no'));
    $config->set('email', $form_state->getValue('email'));
    $config->set('gender', $form_state->getValue('gender'));
    $config->save();
    $this->messenger()->addStatus($this->t('Your form is submitted'));
    parent::submitForm($form, $form_state);
  }

}
