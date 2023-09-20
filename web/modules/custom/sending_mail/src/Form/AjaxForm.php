<?php

// namespace Drupal\sending_mail\Form;

// use Drupal\Core\Ajax\AjaxResponse;
// use Drupal\Core\Ajax\MessageCommand;
// use Drupal\Core\Form\FormBase;
// use Drupal\Core\Form\FormStateInterface;
// use Drupal\Core\Url;

// class AjaxForm extends FormBase {

//   public function getFormId() {
//     return 'ajax_form';
//   }

//   public function buildForm(array $form, FormStateInterface $form_state) {
//     $form['user_name'] = [
//       '#type' => 'textfield', 
//       '#title' => $this->t('Name'), 
//       '#required' => TRUE,
//       '#maxlength' => 255, 
//     ];

//     $form['actions']['#type'] = 'actions';
//     $form['actions']['submit'] = [
//       '#type' => 'submit',
//       '#value' => $this->t('Save'),
//       '#button_type' => 'primary',
//       '#ajax' => [
//         'callback' => '::ajaxFormSubmitHandler',
//       ],
//     ];

//     return $form;
//   }

  
// public static function ajaxFormSubmitHandler(array &$form, FormStateInterface $form_state) {
//   $response = new AjaxResponse();
//   $formField = $form_state->getValues();
//   $userName = trim($formField['user_name']);
//   $account = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $userName]);

//   if (!empty($account)) {
//       $account = reset($account);
//       $url = Url::fromRoute('user.pass', ['user' => $account->id()], ['absolute' => TRUE]);
//       $otll = $url->toString();
//       $store = (t('One Time Login Link: @otll', ['@otll' => $otll]));
//       // $response->addCommand(new MessageCommand
//   } else {
//     $store =(t('User not found'));
//       // $response->addCommand(new MessageCommand(t('User not found')));
//   }
//   $email ="arijit.acharya@innoraft.com";
//   $params = [
//     'message' => $store,
//   ];

//   $langcode = \Drupal::currentUser()->getPreferredLangcode();
//   $send = true;
//   $result = \Drupal::service('plugin.manager.mail')
//   ->mail('my_module', 'custom_email_key', $email, $langcode, $params, NULL, $send);
//   if ($result['result'] !== true) {
//     // \Drupal::messenger()->addError(t('There was a problem sending the email.'));
//     $response->addCommand(new MessageCommand(t('There was a problem sending the email.')));

//   } else {
//     $response->addCommand(new MessageCommand(t('Email sent successfully.')));
//     // \Drupal::messenger()->addStatus(t('Email sent successfully.'));
//   }
// return $response;
// }

//   public function submitForm(array &$form, FormStateInterface $form_state) {
//   }
// }









namespace Drupal\sending_mail\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class AjaxForm extends FormBase {

  public function getFormId() {
    return 'ajax_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['user_name'] = [
      '#type' => 'textfield', 
      '#title' => $this->t('Name'), 
      '#required' => TRUE,
      '#maxlength' => 255, 
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
      // '#ajax' => [
      //   'callback' => '::ajaxFormSubmitHandler',
      // ],
    ];

    return $form;
  }

  // public function ajaxFormSubmitHandler(array &$form, FormStateInterface $form_state) {
  //   $response = new AjaxResponse();
  //   $formField = $form_state->getValues();
  //   $userName = trim($formField['user_name']);
  //   $account = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $userName]);

  //   if (!empty($account)) {
  //     $account = reset($account);
  //     $url = Url::fromRoute('user.pass', ['user' => $account->id()], ['absolute' => TRUE]);
  //     $otll = $url->toString();
  //     $store = $this->t('One Time Login Link: @otll', ['@otll' => $otll]);
  //   } else {
  //     $store = $this->t('User not found');
  //   }

  //   $email = "arijit.acharya@innoraft.com";
  //   $params = [
  //     'message' => $store,
  //   ];

  //   $langcode = \Drupal::currentUser()->getPreferredLangcode();
  //   $send = TRUE;
  //   $result = \Drupal::service('plugin.manager.mail')
  //     ->mail('sending_mail', 'custom_email_key', $email, $langcode, $params, NULL, $send);
  //   if ($result['result'] !== TRUE) {
  //     $response->addCommand(new MessageCommand($this->t('There was a problem sending the email.')));
  //   } else {
  //     $response->addCommand(new MessageCommand($this->t('Email sent successfully.')));
  //   }

  //   return $response;
  // }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Add your logic here if needed.
    $userName = $form['user_name']['#value'];
    $account = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $userName]);

    if (!empty($account)) {
      $account = reset($account);
      $url = Url::fromRoute('user.pass', ['user' => $account->id()], ['absolute' => TRUE]);
      $otll = $url->toString();
      $store = $this->t('One Time Login Link: @otll', ['@otll' => $otll]);
    }
    else {
      $store = $this->t('User not found');
    }

    $email = "diwakar.sah@innoraft.com";
    $params = [
      'message' => $store,
    ];

    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = TRUE;
    $result = \Drupal::service('plugin.manager.mail')
      ->mail('sending_mail', 'custom_email_key', $email, $langcode, $params, NULL, $send);
    if ($result['result'] !== TRUE) {
    $this->messenger()->addStatus($this->t('There was a problem sending the email.'));
      // $response->addCommand(new MessageCommand($this->t('There was a problem sending the email.')));
    }
    else {
      $this->messenger()->addStatus($this->t('Email sent successfully.'));

      // $response->addCommand(new MessageCommand($this->t('Email sent successfully.')));
    }

    // return $response;
  }
}
