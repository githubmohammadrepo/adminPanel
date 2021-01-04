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
      $sql = "SELECT pish_hikashop_category.category_id,
      pish_hikashop_category.user_id,
      pish_hikashop_category.category_parent_id,
      pish_hikashop_category.category_type,
      pish_hikashop_category.category_description,
      pish_hikashop_category.category_name,
      pish_hikashop_category.category_published,
        pish_hikashop_file.file_path as brand_image FROM pish_hikashop_category 
      left JOIN pish_hikashop_file ON pish_hikashop_file.file_ref_id = pish_hikashop_category.category_id 
      WHERE pish_hikashop_category.category_type='manufacturer' AND pish_hikashop_category.category_parent_id = 10  limit $offset,10";

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
   * get All brands with offset
   * @param int $offset offset for get brands
   * @return Array array of Objects
   */
  public function getAllSubBrandWithOffset(int $offset,int $category_parent_id): void
  {
    $offset = $this->getInput($offset);
    $category_parent_id = $this->getInput($category_parent_id);
    $resultArray = array();


    try {
      // run your code here
      $sql = "SELECT pish_hikashop_category.category_id,pish_hikashop_category.category_published,pish_hikashop_category.category_name, pish_hikashop_category.user_id, pish_hikashop_file.file_path as brand_image  FROM pish_hikashop_category 
      LEFT JOIN pish_hikashop_file ON pish_hikashop_file.file_ref_id = pish_hikashop_category.category_id 
      WHERE pish_hikashop_category.category_type='manufacturer' AND pish_hikashop_category.category_parent_id = $category_parent_id
       limit $offset,10";

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
    public function deleteOneBrand(int $category_id)
    {
      $category_id = $this->getInput($category_id);
      if($category_id < 0){
        $this->resultJsonEncode(false);
      }
      $sql = "DELETE FROM pish_hikashop_category WHERE pish_hikashop_category.category_id = $category_id";
      $result = $this->conn->query($sql);
      if($result){
        $count = mysqli_affected_rows($this->conn);
        if($count){
          $this->resultJsonEncode(true);
        } else{
          $this->resultJsonEncode(false);
        }
      }else{
        $this->resultJsonEncode(false);
      }

    }


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
   * update brand
   */
  private function updateBrandLevelTwo(int $userId,string $owner,string $brandname,string $MobilePhone,string $phone,string $CompanyName, String $email,string $Address):bool
  {
    $userId= $this->getInput($userId);
    // main infos
    $Address= $this->getInput($Address);
    $CompanyName= $this->getInput($CompanyName);
    $MobilePhone= $this->getInput($MobilePhone);
    $OwnerName= $this->getInput($owner);
    $brandname= $this->getInput($brandname);
    $phone= $this->getInput($phone);

    //insert into fake
    
    // insert into  pish_phocamaps_marker_fake set
    // brandSelectedname = brandSelectedId,
    // user_id = userid,
    // title = brandname,
    // ShopName = CompanyName,
    // phone = phone,
    // MobilePhone = MobilePhone,
    // OwnerName = OwnerName,
    // Address = Address,
    // RegCode = RegCode
    // delete trash data



     //  delete trash data
    $sql = "DELETE FROM pish_phocamaps_marker_fake WHERE user_id = $userId";
    $sql =stripcslashes(mysqli_real_escape_string($this->conn, $sql));
    $result = $this->conn->query($sql);

    // insert new company fake
    $sql = "INSERT INTO  pish_phocamaps_marker_fake SET brandSelectedname = brandSelectedId, user_id = userid, title = $brandname, ShopName = $CompanyName, phone = $phone, MobilePhone = $MobilePhone, OwnerName = $OwnerName, Address = $Address, RegCode = RegCode";
    $sql = stripcslashes(mysqli_real_escape_string($this->conn, $sql));
    $result = $this->conn->query($sql);
    if ($result) {
        $rowcount =(mysqli_affected_rows($this->conn));
        if ($rowcount) {
          return true;
        }
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

  /***
   * public function update one brand
   */
  public function updateOneBrand(
    $category_id,
    $user_id,
    $category_parent_id,
    $category_name,
    $category_description,
    $category_published,
    $typeAction
    )
  {
    $category_id = $this->getInput($category_id);
    $user_id = $this->getInput($user_id);
    $category_parent_id = $this->getInput($category_parent_id);
    $category_name = $this->getInput($category_name);
    $category_description = $this->getInput($category_description);
    $category_published = $this->getInput($category_published);
    $typeAction = $this->getInput($typeAction);
    
    $sql = "UPDATE pish_hikashop_category SET `user_id` =$user_id,`category_parent_id`=$category_parent_id,`category_name`='$category_name',`category_description`='$category_description',`category_published`=$category_published WHERE `category_id` =$category_id";
    
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_affected_rows($this->conn);
      if($count){
        $this->resultJsonEncode(true);
      }else{
        $this->resultJsonEncode(false);
      }
    }else{
      $this->resultJsonEncode(false);
      die($sql);
    }
  }

  /**
   * show all users
   */
  public function shwoAllUsers()
  {
    $sql = "SELECT id,name FROM pish_users WHERE name IS NOT NULL AND length(name)";
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_num_rows($result);
      $devArray = Array();
      while($row = $result->fetch_assoc()){
        $devArray[]=$row;
      }
      $this->resultJsonEncode($devArray);
    }else{
      $this->resultJsonEncode([]);
    }
  }
  /**
   * show all users
   */
  public function getAllCategoryParent($category_id)
  {
    $category_id = $this->getInput($category_id);
    $sql = "SELECT category_id,category_name,category_parent_id FROM pish_hikashop_category WHERE category_parent_id=(SELECT category_parent_id from pish_hikashop_category WHERE category_id = 10) AND pish_hikashop_category.category_name is not null And length(category_name)";
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_num_rows($result);
      $devArray = Array();
      while($row = $result->fetch_assoc()){
        $devArray[]=$row;
      }
      $this->resultJsonEncode($devArray);
    }else{
      $this->resultJsonEncode([]);
    }
  }
  
}


/**
 * this section get all post inputs
 */
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$typeAction = $post['typeAction'];

$brandAction = new BrandActions($conn);
if ($typeAction == 'select') {
  $offset = $post['offset'];
  //get all brand with offset
  $brandAction->getAllBrandWithOffset($offset);
}else if($typeAction == 'subSelect'){
  $offset = $post['offset'];
  $category_parent_id = $post['category_parent_id'];
  
  $brandAction->getAllSubBrandWithOffset($offset,$category_parent_id);
} else if ($typeAction == 'getAllUsers') {
  $brandAction->shwoAllUsers();
} else if ($typeAction == 'getAllCategoryParent') {
  $category_id = $post['category_id'];
  $brandAction->getAllCategoryParent($category_id);
}else if ($typeAction == 'updateOneBrand') {
  $category_id=$post['category_id'];
  $user_id=$post['user_id'];
  $category_parent_id=$post['category_parent_id'];
  $category_name=$post['category_name'];
  $category_description=$post['category_description'];
  $category_published=$post['category_published'];
  $typeAction=$post['typeAction'];
  
  //update one brand
  $brandAction->updateOneBrand(
    $category_id,
    $user_id,
    $category_parent_id,
    $category_name,
    $category_description,
    $category_published,
    $typeAction
  );
}else if ($typeAction == 'delete') {
  //delete one brand
  $category_id = $post['category_id'];
  $category_id = $category_id ? $category_id : -1;
  $brandAction->deleteOneBrand($category_id);
  
} else {
}
