<?php

/**
 * Created by PhpStorm.
 * User: androiddev
 * Date: 7/17/17
 * Time: 10:49 PM
 */


error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$object = new stdClass();
include "connection.php";
class StoreActions
{
  private $conn;
  public function __construct(mysqli $conn)
  {
    $this->conn=$conn;
  }
  /**
   * insert new Store
   */


  /**
   * get All stores with offset
   * @param int $offset offset for get stores
   * @return Array array of Objects
   */
  public function getAllStoreWithOffset(int $offset): void
  {
    $offset = $this->getInput($offset);
    $resultArray = Array();

    try {
      // run your code here
      $sql = "SELECT id, title, alias FROM pish_phocamaps_map ORDER BY CAST(alias AS UNSIGNED) ASC limit $offset,10";

      $result = $this->conn->query($sql);
      if ($result) {
        $rowcount = $result->num_rows;
        if ($rowcount > 0) {
          while($row =$result->fetch_assoc()){
            $resultArray[]=$row;
          }
        }
      }
    } catch (exception $e) {
      //code to handle the exception
      $this->resultJsonEncode($resultArray);
    }
    //output data
    $this->resultJsonEncode($resultArray);
  }

  /**
   * update one Store
   */

  /**
   * delete one store
   */


  /**
   * get input and ake sure it secure
   */
  private function getInput($input)
  {
    $result = htmlspecialchars(strip_tags($input));
    if (preg_match('/<>;:\$^/', $result)) {
      return;
    } else {
      return $result;
    }
  }


  /**
   * section just show output methods
   */
  public function resultJsonEncode($data)
  {
    if(gettype($data)=='array'){
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else{
      echo json_encode([$data], JSON_UNESCAPED_UNICODE);
    }
  }

}


/**
 * this section get all post inputs
 */
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$offset = $post['offset'];

$storeAction = new StoreActions($conn);

$storeAction->getAllStoreWithOffset($offset);

