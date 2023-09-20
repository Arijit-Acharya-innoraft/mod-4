<?php

namespace Drupal\mymodule\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountProxyInterface;
/**
 * It is a multipurpose utility class, testing simple markups.
 */
class FirstController extends ControllerBase {

  protected $account;
  protected $entityTypeManager;
  public function __construct(AccountInterface $account,EntityTypeManager $entityTypeManager) { 
    $this->account = $account;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * A render array to display the hello message.
   *
   * @return array
   *   The form cotent.
   */
  public function simpleContent() {
    return [
      '#type' => 'markup',
      '#markup' => 'hello world',
    ];
  }

  /**
   * A simple method for displaying the Hello @Username.
   *
   * @param string $name
   *   It takes the name from the url.
   *
   * @return array
   *   A render array to display the hello message
   */
  public function greetings($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('HELLO @name !', [
        '@name' => $name,
      ]),
    ];
  }


  public static function create(ContainerInterface $container) {

    return new static (
      $container->get('current_user'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * A simple method for displaying the Hello @Username.
   *
   * @return array
   *   A render array to display the hello message with cache tags applied.
   */
  public function showName() {
    $user_name = $this->account->getDisplayName();
    $user = $this->entityTypeManager()->getStorage('user')->load($this->account->id());
    return [
      '#type' => 'markup',
      '#markup' => ('Hello ' . $user_name),
      '#cache' => [
        'tags' => $user->getCacheTags(),
      ],
    ];
  }

}
