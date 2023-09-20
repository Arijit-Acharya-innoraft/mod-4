<?php

namespace Drupal\myservice\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * A multifunctional class.
 *
 * It is used for changing the route mentioned in the routing.yml file
 * to a different route. It is also used for redirecting a user to a specified
 * route on user login.
 */
class RedirectRoute implements EventSubscriberInterface {

  /**
   * Used to manage and access the current Request object.
   *
   * @var Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Constructor used for storing the requests.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   Used to manage and access the current Request object.
   */
  public function __construct(RequestStack $requestStack) {
    $this->requestStack = $requestStack;
  }

  /**
   * Events to trigger when user logs in.
   *
   * @param \Symfony\Component\HttpKernel\Event\RequestEvent $request
   *   It allows to interact with the HTTP request and perform operations at
   *   different stages of the request processing within the Drupal system.
   */
  public function onUserLogin(RequestEvent $request) {
    $request = $this->requestStack->getCurrentRequest();
    $destination = $request->query->get('destination');
    if ($destination != '/custom-welcome-page') {
      $request->query->set('destination', '/custom-welcome-page');
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::REQUEST => ['onUserLogin'],
    ];
  }

}
