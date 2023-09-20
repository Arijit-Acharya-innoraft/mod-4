<?php

namespace Drupal\dependency\Services;

use Drupal\Core\Session\AccountProxyInterface;

/**
 * A service class for getting the user role.
 */
class WithService {

  /**
   * @var [type]
   */
  protected $user;

  public function __construct(AccountProxyInterface $user) {
    $this->user = $user;
  }

  public function getRole() {
    $role = $this->user->getRoles();
    return $role;
  }

}
