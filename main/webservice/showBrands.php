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
class BrandActions
{
  private $conn;
  public function __construct(mysqli $conn)
  {
    $this->conn = $conn;
  }
  /**
   * insert new Brand
   */
  public function addNewBrand(String $userName, String $password)
  {
    // webservice is exist before in some where    
  }

  /**
   * get All brands with offset
   * @param int $offset offset for get brands
   * @return Array array of Objects
   */
  public function getAllBrandWithOffset(int $offset): void
  {
    $offset = $this->getInput($offset);
    $resultArray = array();

    try {
      // run your code here
      $sql = "SELECT pish_hikashop_category.category_id,pish_hikashop_category.category_name, pish_hikashop_category.user_id, pish_hikashop_file.file_path as brand_image FROM pish_hikashop_category 
      INNER JOIN pish_hikashop_file ON pish_hikashop_file.file_ref_id = pish_hikashop_category.category_id 
      WHERE pish_hikashop_category.category_type='manufacturer' AND pish_hikashop_category.category_parent_id = 10 GROUP BY pish_hikashop_category.category_id limit $offset,10";

      $result = $this->conn->query($sql);
      if ($result) {
        $rowcount = $result->num_rows;
        if ($rowcount > 0) {
          while ($row = $result->fetch_assoc()) {
            $resultArray[] = $row;
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
   * update one Brand
   */

  /**
   * delete one brand
   */


  /**
   * get input and make sure it secure
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
    if (gettype($data) == 'array') {
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else {
      echo json_encode([$data], JSON_UNESCAPED_UNICODE);
    }
  }

  /**
   * get one brand info for update
   */
  public function getBrandInfo(int $id)
  {
    $id = $this->getInput($id);
    
    $sql = "SELECT `pish_phocamaps_marker_company`.title
    FROM `pish_phocamaps_marker_company` 
    INNER JOIN `pish_users` ON `pish_phocamaps_marker_company`.user_id = $id";
  }
}


/**
 * this section get all post inputs
 */
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$offset = $post['offset'];
$typeAction = $post['typeAction'];

$brandAction = new BrandActions($conn);
if ($typeAction == 'select' && isset($offset)) {
  //get all brand with offset
  $brandAction->getAllBrandWithOffset($offset);
} else if ($typeAction == 'update') {
  //update one brand
} else if ($typeAction == 'delete') {
  //delete one brand
} else {
}
