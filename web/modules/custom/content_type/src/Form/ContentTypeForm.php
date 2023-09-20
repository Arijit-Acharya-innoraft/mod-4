<?php

namespace Drupal\content_type\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContentTypeForm extends EntityForm {

  /**
   * Constructs an ContentTypeForm object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entityTypeManager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $form_entity = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $form_entity->label(),
      '#description' => $this->t("Label for the Example."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $form_entity->id(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
      '#disabled' => !$form_entity->isNew(),
    ];

    // You will need additional form elements for your custom properties.
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $form_entity = $this->entity;
    $status = $form_entity->save();

    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage($this->t('The %label Example created.', [
        '%label' => $form_entity->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %label Example updated.', [
        '%label' => $form_entity->label(),
      ]));
    }

    $form_state->setRedirect('entity.content_type.collection');
  }

  /**
   * Helper function to check whether configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityTypeManager->getStorage('example')->getQuery()
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }
}