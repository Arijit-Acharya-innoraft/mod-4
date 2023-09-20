<?php

namespace Drupal\my_database\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\Query\SelectInterface;

class DatabaseController extends ControllerBase {

  public function displayYear() {
    $database = \Drupal::database();
    $query = $database->select('node__field_date','nfd');
    $query->fields('nfd', ['field_date_value']);
    $result = $query->execute();
    $year=[];
    foreach($result as $r){
      array_push($year,substr($r->field_date_value,0,4));
    }
    $store = array_count_values($year);

    return [
      '#theme' => "yearly_dashboard",
      '#yearly_event' => $store,
      '#cache' => [
        'tags' => ['node_list:events'],
      ],
    ];
  }

  public function displayQtr() {
    
    $database = \Drupal::database();
    $query = $database->select('node__field_date', 'nfd');
    $query->fields('nfd', ['field_date_value']);
    $result = $query->execute()->fetchAll();

    // Grouping the results by quarter.
    $groupedResults = [];
    $groupKeyValue = [];
    foreach ($result as $row) {
      $date = $row->field_date_value;
      $year = date('Y', strtotime($date));

      // Calculate the quarter (1, 2, 3, or 4) based on the month.
      $quarter = ceil(date('n', strtotime($date)) / 3); 

      // Create a unique group key using the year and quarter.
      $groupKey = $year . 'Q' . $quarter;
      // Storing the quarters in an array
      if(!in_array($groupKey, $groupKeyValue)){
        array_push($groupKeyValue,$groupKey);
      }
      // Add the date to the corresponding quarter group in the $groupedResults array.
      $groupedResults[$groupKey][] = $date;
    }
    $count=[];
    foreach($groupedResults as $gr) {
      array_push($count,count($gr));
    }

    return [
      '#theme' => "quarterly_dashboard",
      '#quarters' => $groupKeyValue,
      '#event_no' => $count,
      '#cache' => [
        'tags' => ['node_list:events'],
      ],
    ];

  }

  public function displayType() {
    $database = \Drupal::database();
    $query = $database->select('node__field_type','nft');
    $query->fields('nft', [' field_type_value']);
    $result = $query->execute();
    $type = [];
    foreach($result as $r){
      array_push($type,$r->field_type_value);
    }
    $store = array_count_values($type);

    // $string ="";
    // foreach ($store as $s=>$key) {
    //   $string  = $string . " ". $s . "=>". $key;
    // }

    return [
      '#theme' => "type_dashboard",
      '#type_event' => $store,
      '#cache' => [
        'tags' => ['node_list:event'],
      ],
    ];
    // return[
    //   '#type'=>'markup',
    //   '#markup'=> $this->t('@content',[
    //     '@content'=>$string
    //   ])
    // ];
  }

}