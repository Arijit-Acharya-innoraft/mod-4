<?php
namespace Drupal\practice\Services;

use Drupal\Core\Database\Connection;

/**
 * [Description DbInsert]
 */
class DbInsert{

  /**
   * @var [type]
   */
  protected $database;

  /**
   * @param Connection $database
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * @param mixed $form_state
   * 
   * @return [type]
   */
  public function setData($form_state) {
    $this->database->insert('practice_form')
      ->fields(array(
        'mail' => $form_state ->getValue('mail'),
        'name' =>$form_state->getValue('name'),
        'password' =>$form_state->getValue('password'),
      ))
      ->execute();
  }

  /**
   * @return [type]
   */
  public function getData() {
    $query = $this->database->select('practice_form','pf');
    $query->fields('pf');
    $result =$query->execute()->fetchAll();
    return $result; 
   }
}

?>
