<?php

// namespace Drupal\my_event\EventSubscriber;

// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Drupal\Core\Entity\EntityInterface;
// use Drupal\Component\DependencyInjection\ContainerInterface;
// use Symfony\Component\HttpKernel\KernelEvents;

// class CalculateBudget implements EventSubscriberInterface {

//   protected $entityInterface;

//   public function __construct(EntityInterface $entityInterface) {
//     $this->entityInterface = $entityInterface;
//   }

//   public static function create(ContainerInterface $container ) {
//     return new static(
//       $container->get('my_event.calculate'),
//     );
//   }

//   public function getSubscribedEvents() {

//   }
// }




namespace Drupal\my_event\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\node\NodeInterface;

class CalculateBudget implements EventSubscriberInterface {

  protected $entityTypeManager;
  protected $configFactory;

  public function __construct(EntityTypeManagerInterface $entityTypeManager, ConfigFactoryInterface $configFactory) {
    $this->entityTypeManager = $entityTypeManager;
    $this->configFactory = $configFactory;
  }

  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['onEntitySave'];
    return $events;
  }

  public function onEntitySave(RequestEvent $event) {
    $request = $event->getRequest();
    $route_match = \Drupal::routeMatch();

    // Check if the current route is for viewing a node entity.
    if ($route_match->getRouteName() === 'entity.node.canonical') {
      $node = $route_match->getParameter('node');
      $output = "";
      // Ensure that the loaded entity is a node entity of type 'article'.
      if ($node instanceof NodeInterface && $node->getType() === 'article') {
        $movie_price = $node->get('field_price')->getValue()[0]['value'];
        $config = $this->configFactory->get('my_event.settings');
        $budget = $config->get('budget');
        $diff = $budget - $movie_price;
        if($diff >0)
          $output = "The movie is under budget";
        elseif($diff<0)
          $output = "The movie is over budget" ;
        else
          $output = "The movie is within budget";
      }
      $node->set('field_output',$output);
    }
  }

}
