<?php

namespace Drupal\my_database\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class TaxonomyForm extends ConfigFormBase {

 /**
   * Settings variable.
   */
  const CONFIGNAME = "my_database.settings";

  public $return;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'taxonomy_form';
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

    $form['tax_term']=[
      '#type'=>'textfield',
      '#title' => 'Enter your term',
      '#required'=>TRUE,
      '#length'=>255,
    ];

    $form['submit'] =[
      '#type' => 'submit',
      '#value' => 'Submit'
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $input_value = $form_state->getValue('tax_term');
    $database = \Drupal::database();
    $query = $database->select('taxonomy_term_field_data','ttfd');
    $query->addField('ttfd', 'name');
    $results = $query->execute()->fetchAll();

    if(!empty($results)) {
      $query->join('taxonomy_term_data', 'ttd', 'ttfd.tid = ttd.tid');
      $query->addField('ttd', 'uuid');
      $query->addField('ttfd', 'tid');
      $query->where('binary ttfd.name = :name', [
        'name' => $input_value,
      ]);
      // $query->condition('ttfd.name', $input_value);
      $output = $query->execute()->fetchAll();
      if(!empty($output)){
        $tid= $output[0]->tid;
        $uuid = $output[0]->uuid;
        $query = $database->select('node__field_alphabets', 'nfa');
        $query->addField('nfa', 'entity_id');
        $query->condition('nfa.field_alphabets_target_id', $tid); 
        $results = $query->execute()->fetchAll();
        $entity_ids = [];
        $node_url = [];
        foreach ($results as $result) {
          $entity_ids[] = $result->entity_id;
          $node_url[] = "mod_four.com/node/".$result->entity_id;
        }  
      }

      
      if(!empty($entity_ids)){
        $query =$database->select('node_field_data', 'nfd');
        $query->addField('nfd', 'title');
        $query->condition('nfd.nid', $entity_ids, 'IN');
        $results = $query->execute()->fetchAll();
        $titles = [];
        foreach ($results as $result) {
          $titles[] = $result->title;
        }
        $this->return = array($tid,$uuid,$titles,$node_url);
      }
    }

    else{
      $this->return = FALSE;
    }
    // dd($this->return);
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state,) {
    if($this->return != FALSE) {
      $config = $this->config(static::CONFIGNAME);
      $config->set('tax_term', $form_state->getValue('tax_term'));
      $config->save();
      $string=[];
      $text ="";
      for($i = 0; $i<count($this->return[2]);$i++){
        $string [] = "Node Title = " .  $this->return[2][$i] . ", Corresponding URL = " .  $this->return[3][$i];
      }

      foreach($string as $str){
        $text = $text . $str . " | ";
      }
      $this->messenger()->addStatus($this->t('Your Id of the term is @ID, UUID of the Term is @UUID, @text',[
        '@ID'=>$this->return[0],
        '@UUID' =>$this->return[1],
        '@text' => $text
      ]));
      parent::submitForm($form, $form_state);
    }
    else{
      $this->messenger()->addStatus($this->t('Either the taxonomy term does not exist or there is  no content with that taxonomy'));
    }
  }
}