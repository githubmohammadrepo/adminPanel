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
class CompanyActions
{
  private $conn;
  public function __construct(mysqli $conn)
  {
    $this->conn = $conn;
  }
  /**
   * insert new Company
   */
  public function addNewCompany(String $userName, String $password)
  {
    // webservice is exist before in some where    
  }

  /**
   * get All companies with offset
   * @param int $offset offset for get companies
   * @return Array array of Objects
   */
  public function getAllCompanyWithOffset(int $offset): void
  {
    $offset = $this->getInput($offset);
    $resultArray = array();

    try {
      // run your code here
      $sql = "SELECT 
      pish_users.id,
      pish_users.name,
      pish_hikashop_category.category_id,
      pish_hikashop_category.user_id,
      pish_hikashop_category.category_name,
      company.* FROM (SELECT pish_phocamaps_marker_company.id,
      pish_phocamaps_marker_company.user_id,
      pish_phocamaps_marker_company.RegionID,
      pish_phocamaps_marker_company.catid,
      pish_phocamaps_marker_company.title,
      pish_phocamaps_marker_company.ShopName,
      pish_phocamaps_marker_company.phone,
      pish_phocamaps_marker_company.alias,
      pish_phocamaps_marker_company.ManagerName,
      pish_phocamaps_marker_company.MobilePhone,
      pish_phocamaps_marker_company.OwnerName,
      pish_phocamaps_marker_company.Address,
      pish_phocamaps_marker_company.description,
      pish_phocamaps_marker_company.published
      FROM `pish_phocamaps_marker_company` limit $offset,10) AS company
      LEFT JOIN pish_users ON company.user_id = pish_users.id
      LEFT JOIN pish_hikashop_category ON company.catid = pish_hikashop_category.category_id";

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
   * get company status
   */
  public function getCompanyStatus(array $companyUserIds){
    if(count($companyUserIds)){
      foreach ($companyUserIds as $key => $value) {
        $companyUserIds[$key] = $this->getInput($value);
      }
    }
    $companyUserIds = implode(',',$companyUserIds);
    $sql = "SELECT NewTable.user_id,count(product_id) as productCount from (SELECT Category.*,pish_hikashop_product.* FROM (SELECT pish_hikashop_category.category_id,pish_hikashop_category.user_id FROM pish_hikashop_category WHERE pish_hikashop_category.user_id IN ($companyUserIds) )AS Category
    LEFT JOIN pish_hikashop_product 
    ON Category.category_id = pish_hikashop_product.product_manufacturer_id) as NewTable
    GROUP BY user_id";
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_num_rows($result);
      if($count){
        $dev_array = Array();
        while($row = $result->fetch_assoc()){
          $dev_array[] = $row;
        }
        $this->resultJsonEncode($dev_array);
        return;
      }else{
        $this->resultJsonEncode([]);
      }
    }else{
      $this->resultJsonEncode([]);
    }
    
  }




 /**
   * get All products company with offset
   * @param int $offset offset for get companies
   * @return Array array of Objects
   */
  public function getAllProductsCompanyWithOffset(int $offset,int $company_id): void
  {
    $offset = $this->getInput($offset);
    $company_id = $this->getInput($company_id);
    $resultArray = array();

    try {
      // run your code here
      $sql = "SELECT Company.*,pish_hikashop_product.*
      FROM (SELECT  pish_phocamaps_marker_company.id
             ,pish_phocamaps_marker_company.catid
      FROM pish_phocamaps_marker_company
      WHERE pish_phocamaps_marker_company.id = $company_id limit $offset,10)as Company
      
      INNER JOIN pish_hikashop_product
      ON Company.catid = pish_hikashop_product.product_manufacturer_id";

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
   * update one Company
   */

  /**
   * delete one company
   */
    public function deleteOneCompany(int $company_id)
    {
      $company_id = $this->getInput($company_id);
      if($company_id < 0){
        $this->resultJsonEncode(false);
      }
      $sql = "DELETE FROM pish_phocamaps_marker_company WHERE pish_phocamaps_marker_company.id = $company_id";
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
   * update company
   */
  private function updateCompanyLevelTwo(int $userId,string $owner,string $companyname,string $MobilePhone,string $phone,string $CompanyName, String $email,string $Address):bool
  {
    $userId= $this->getInput($userId);
    // main infos
    $Address= $this->getInput($Address);
    $CompanyName= $this->getInput($CompanyName);
    $MobilePhone= $this->getInput($MobilePhone);
    $OwnerName= $this->getInput($owner);
    $companyname= $this->getInput($companyname);
    $phone= $this->getInput($phone);

    //insert into fake
    
    // insert into  pish_phocamaps_marker_fake set
    // companySelectedname = companySelectedId,
    // user_id = userid,
    // title = companyname,
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
    $sql = "INSERT INTO  pish_phocamaps_marker_fake SET companySelectedname = companySelectedId, user_id = userid, title = $companyname, ShopName = $CompanyName, phone = $phone, MobilePhone = $MobilePhone, OwnerName = $OwnerName, Address = $Address, RegCode = RegCode";
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
  
}


/**
 * this section get all post inputs
 */
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$typeAction = $post['typeAction'];

$companyAction = new CompanyActions($conn);
if ($typeAction == 'select') {
  $offset = (int)$post['offset'];
  //get all company with offset
  $companyAction->getAllCompanyWithOffset($offset);
}else if($typeAction =='delete'){
  $company_id = (int)$post['company_id'];
  $companyAction->deleteOneCompany($company_id);
}else if($typeAction =='productCompany'){
  $offset = (int)$post['offset'];
  $company_id = (int)$post['company_id'];
  $companyAction->getAllProductsCompanyWithOffset($offset,$company_id);
}else if($typeAction =='getStatusCompanies'){
  $companyUserIds = $post['companyUserIds'];
  $companyAction-> getCompanyStatus($companyUserIds);
}else{

}
