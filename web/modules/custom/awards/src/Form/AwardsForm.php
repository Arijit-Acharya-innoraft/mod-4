<?php

namespace Drupal\awards\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form handler for the Example add and edit forms.
 */
class AwardsForm extends EntityForm {

 
  protected $entityTypeManager;
  protected $entityStorage;
  /**
   * Constructs an AwardsForm object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entityTypeManager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, EntityStorageInterface $entityStorage) {
    $this->entityTypeManager = $entityTypeManager;
    $this->entityStorage = $entityStorage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('entity_type.manager')->getStorage('node')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $awards = $this->entity;

    if($awards->get('movies')) {
      $node_id = $awards->get('movies')[0]['target_id'];
      $default_movie = $this->entityStorage->load($node_id);
      // $movie_name = ($node->getTitle());
    }

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $awards->label(),
      '#description' => $this->t("Label for the Awards."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $awards->id(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
      '#disabled' => !$awards->isNew(),
    ];
    $form['year'] = [
      '#type' => 'date',
      '#title' => $this->t('Year'),
      '#default_value' =>  $awards->get('year') ,
      '#description' => $this->t("Year of the Awards."),
    ];
    $form['movies'] = [
      '#type' =>'entity_autocomplete',
      '#title' => 'Movie Name',
      '#target_type' => 'node',
      '#default_value' => isset($default_movie) ? $default_movie : NULL ,
      '#selection_settings' => ['target_bundle' => ['movies']],
      '#tags' => TRUE,
    ];
    
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $awards = $this->entity;
    $status = $awards->save();

    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage($this->t('The %label Example created.', [
        '%label' => $awards->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %label Example updated.', [
        '%label' => $awards->label(),
      ]));
    }

    $form_state->setRedirect('entity.awards.collection');
  }

  /**
   * Helper function to check whether an Example configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityTypeManager->getStorage('awards')->getQuery()
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }

}