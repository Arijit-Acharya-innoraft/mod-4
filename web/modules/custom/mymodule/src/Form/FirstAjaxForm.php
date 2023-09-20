<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
// use Drupal\Core\Database\Database;
class FirstAjaxForm extends FormBase {

  public $ajax_response;
  public $error = 0;
  public $err_msg;
  
  function __construct() {
    $this->ajax_response = new AjaxResponse ();
  }
  
  /**
   * {{@inheritdoc}}
   */
  public function getFormId()  {
    return 'ajax_form_settings';
  }


  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * 
   * @return [type]
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['element'] =[
      '#type' =>'markup',
      '#markup' => "<div class = message ></div>"
    ];

    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' =>$this->t('Full Name'),
    ];

    $form['phone_no'] =[
      '#type' =>'tel',
      '#title' =>'Phone No',
    ];

    $form['email'] =[
      '#type' => 'email',
      '#title' => 'Email Id',
    ];

    $form['gender'] =[
      '#type' =>'radiois',
      '#title'=> 'Gender',
      '#options' => array('Male'=>'Male','Female'=>'Female','Others'=>'Others')
    ];

    $form['submit'] = [
      '#type' =>'submit',
      '#value' =>'Submit',
      '#ajax' => [
        'callback' => '::submitForm'
      ]
    ] ;  
    
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

 
  }
  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * 
   * @return [type]
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $publicDomains = ['gmail','yahoo','outlook'];
    $email =$form_state->getValue('email');
    $locAtTheRate = strrpos($email,"@") +1;
    $substring = substr($email,$locAtTheRate);
    $locDot = strrpos($substring,".");
    $domainName = substr($substring,0,$locDot);

    $this->err_msg ="";

    if(strlen(trim($form_state->getValue('full_name'))) == 0){
      $this->error = 1;
      $this->err_msg = $this->err_msg . "Enter Your Full name. ";
    }
    else{
      if(preg_match("/^[a-zA-Z]+$/",$form_state->getValue('full_name')) == FALSE ) {
        $this->error = 1;
        $this->err_msg = $this->err_msg . "Only text is expected in name field. ";
      }
    }

    if(preg_match("/^[0-9]+$/", $form_state->getValue('phone_no')) == FALSE) {
      $this->error = 1;
      $this->err_msg = $this->err_msg .'Only numbers are allowed in phone number';
    }
    else {
      if(strlen($form_state->getValue('phone_no'))!=10) {
        $this->error = 1;
        $this->err_msg = $this->err_msg . 'Enter a valid phone no';
      }   
    }

    if(preg_match("/^[a-zA-Z0-9\+\-\_\~\.\@]+$/",$form_state->getValue('email')) == FALSE) {
      $this->error = 1;
      $this->err_msg = $this->err_msg . 'Input proper email id';
    }

    if(!str_ends_with($form_state->getValue('email'),".com")) {
      $this->error = 1;
      $this->err_msg = $this->err_msg . '".com" is not present.You will be blacklisted';
    }

    if(!in_array($domainName,$publicDomains)){
      $this->error = 1;
      $this->err_msg = $this->err_msg . 'Not in public domain';
    }
    

    if($this->error == 0) {
      $this->err_msg ='Form Submitted successfully';
    }

    $this->ajax_response->addCommand(new HtmlCommand('.message',$this->err_msg));
    return $this->ajax_response;
  }



}

?>
