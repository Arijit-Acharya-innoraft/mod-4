<?php

namespace Drupal\config_entity\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
/**
 * Ce form.
 *
 * @property \Drupal\config_entity\CeInterface $entity
 */
class CeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Award name'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(), 
      '#description' => $this->t('Name of the movie.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\config_entity\Entity\Ce::load',
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['movie'] = [
      '#type' => 'entity_autocomplete',
      '#title' => 'Movie Name',
      '#target_type' => 'node',
      '#selection_settings' => ['target_bundle' => ['movies']],
      // '#default_value'=> $this->entity->get('movies'),
      '#tags' => TRUE,
    ];


  //   $id = $this->entity->get('movies')[0]['target_id'];
  //  dd($this->entityTypeManager->getStorage('node')->load($id));
    // $form['status'] = [
    //   '#type' => 'checkbox', 
    //   '#title' => $this->t('Enabled'),
    //   '#default_value' => $this->entity->status(),
    // ];

    // $form['description'] = [
    //   '#type' => 'textarea',
    //   '#title' => $this->t('Description'),
    //   '#default_value' => $this->entity->get('description'),
    //   '#description' => $this->t('Description of the ce.'),
    // ];

    // $form['name'] = [
    //   '#type' => 'textarea',
    //   '#title' => $this->t('Movie Name'),
    //   '#default_value' => $this->entity->get('name'),
    //   '#description' => $this->t('Name of the movie')
    // ];
    $form['year'] = [
      '#type' => 'date',
      '#title' => $this->t('Year'),
      '#default_value' => $this->entity->get('year'),
      '#description' => $this->t('Year in which the movie is launched .'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $id =$this->entity->get('movie')[0]['target_id']; 
    $node = Node::load($id);
    $movie_name = $node->getTitle();
    $result = parent::save($form, $form_state);
    // $message_args = ['%label' => $this->entity->label()];
    $message_args = ['%label' => $this->entity->get('name')];
    $message = $result == SAVED_NEW
      ? $this->t('Created new ce %label.', $message_args)
      : $this->t('Updated ce %label.', $message_args);
    $this->messenger()->addStatus($message);
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $result;
  }

}
