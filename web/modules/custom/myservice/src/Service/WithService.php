<?php

namespace Drupal\myservice\Service;

use Drupal\Core\Session\AccountProxyInterface;

/**
 * To get the role of the current user.
 */
class WithService {

  /**
   * Storing the current user.
   *
   * @var Drupal\Core\Session\AccountProxyInterface
   */
  protected $user;

  /**
   * A constructor which stores the logged in user information.
   *
   * @param User $user
   *   Details of the logged in user.
   */
  public function __construct(AccountProxyInterface $user) {
    $this->user = $user;
  }

  /**
   * The roles of the current user.
   *
   * @return array
   *   Roles of the user.
   */
  public function getRole() {
    $role = $this->user->getRoles();
    return $role;
  }

}
