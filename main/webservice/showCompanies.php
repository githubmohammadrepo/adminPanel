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
  public function getCompanyStatus(array $companyUserIds)
  {
    if (count($companyUserIds)) {
      foreach ($companyUserIds as $key => $value) {
        $companyUserIds[$key] = $this->getInput($value);
      }
    }
    $companyUserIds = implode(',', $companyUserIds);
    $sql = "SELECT NewTable.user_id,count(product_id) as productCount from (SELECT Category.*,pish_hikashop_product.* FROM (SELECT pish_hikashop_category.category_id,pish_hikashop_category.user_id FROM pish_hikashop_category WHERE pish_hikashop_category.user_id IN ($companyUserIds) )AS Category
    LEFT JOIN pish_hikashop_product 
    ON Category.category_id = pish_hikashop_product.product_manufacturer_id) as NewTable
    GROUP BY user_id";
    $result = $this->conn->query($sql);
    if ($result) {
      $count = mysqli_num_rows($result);
      if ($count) {
        $dev_array = array();
        while ($row = $result->fetch_assoc()) {
          $dev_array[] = $row;
        }
        $this->resultJsonEncode($dev_array);
        return;
      } else {
        $this->resultJsonEncode([]);
      }
    } else {
      $this->resultJsonEncode([]);
    }
  }




  /**
   * get All products company with offset
   * @param int $offset offset for get companies
   * @return Array array of Objects
   */
  public function getAllProductsCompanyWithOffset(int $offset, int $company_id): void
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
    if ($company_id < 0) {
      $this->resultJsonEncode(false);
    }
    $sql = "DELETE FROM pish_phocamaps_marker_company WHERE pish_phocamaps_marker_company.id = $company_id";
    $result = $this->conn->query($sql);
    if ($result) {
      $count = mysqli_affected_rows($this->conn);
      if ($count) {
        $this->resultJsonEncode(true);
      } else {
        $this->resultJsonEncode(false);
      }
    } else {
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
   * update company level two
   */
  public function updateCompanyLevelTwo(int $userId, int $company_id, string $ShopName, string $title, string $OwnerName, string $MobilePhone, string $phone, string $Address): void
  {
    $userId = $this->getInput($userId);
    // main infos
    $ShopName = $this->getInput($ShopName);
    $title = $this->getInput($title);
    $OwnerName = $this->getInput($OwnerName);
    $MobilePhone = $this->getInput($MobilePhone);
    $phone = $this->getInput($phone);
    $Address = $this->getInput($Address);
    $company_id = $this->getInput($company_id);
    $RegCode  = rand(10000, 99999);
    //  delete trash data
    $sql = "DELETE FROM pish_phocamaps_marker_fake WHERE user_id = $userId";
    $sql = stripcslashes(mysqli_real_escape_string($this->conn, $sql));
    $result = $this->conn->query($sql);

    // insert new company fake
    $sql = "INSERT INTO  pish_phocamaps_marker_fake 
      (`brandSelectedname`,`user_id`,`title`,`ShopName`,`MobilePhone`,`phone`,`OwnerName`,`Address`,`RegCode`) 
      VALUES($company_id,$userId,'$title','$ShopName',$MobilePhone,$phone,'$OwnerName', '$Address','$RegCode')";
    $sql = stripcslashes(mysqli_real_escape_string($this->conn, $sql));
    $result = $this->conn->query($sql);
    if ($result) {
      $rowcount = (mysqli_affected_rows($this->conn));
      if ($rowcount) {
        //start send sms
        try {
          $user = "rjabrisham";
          $pass = "rj9354907433";
          if(strlen($MobilePhone)!=11){
            $this->resultJsonEncode(false,false);
            return;
          }
          $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
          $user = $user;
          $pass = $pass;
          $fromNum = "500010708120";
          $toNum = array($MobilePhone);
          $pattern_code = "3ahrlw9s7d";
          $input_data = array(
            "verification-code" => $RegCode
          );

          $res =  $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
          $this->resultJsonEncode([true, is_numeric($res) ? true : false]);
          return;
        } catch (SoapFault $ex) {
          echo "$ex->faultstring";
        }
        //end send sms
        $this->resultJsonEncode(true);
        return;
      }
    }
    $this->resultJsonEncode(false);
  }



  /**
   * update company finish level
   */
  public function updateCompanyFinish(int $userId, int $company_id, string $ShopName, string $title, string $OwnerName, string $MobilePhone, string $phone, string $Address, string $type, string $RegCode): void
  {
    $userId = $this->getInput($userId);
    // main infos
    $ShopName = $this->getInput($ShopName);
    $title = $this->getInput($title);
    $OwnerName = $this->getInput($OwnerName);
    $MobilePhone = $this->getInput($MobilePhone);
    $phone = $this->getInput($phone);
    $Address = $this->getInput($Address);
    $company_id = $this->getInput($company_id);
    $RegCode = $this->getInput($RegCode);
    $type = $this->getInput($type);

    //confirm sms
    $sql = "SELECT id FROM pish_phocamaps_marker_fake WHERE `RegCode`=$RegCode AND `user_id`=$userId";
    $result = $this->conn->query($sql);
    if ($result) {
      $count = mysqli_num_rows($result);
      if($count<=0){
        $this->resultJsonEncode([-1]);
        return;
      }
    } else {
      $this->resultJsonEncode(false);
      return;
    }
    // insert new company fake
    $sql = "UPDATE pish_phocamaps_marker_company 
      SET
     `title`='$title',
     `ShopName`='$ShopName',
     `phone`=$phone,
     `ManagerName`='$OwnerName',
     `MobilePhone`=$MobilePhone,
     `OwnerName`='$OwnerName',
     `Address`= '$Address',
     `sms_confirmed`='1'
     WHERE `id`=$company_id
     ";
    $sql = stripcslashes(mysqli_real_escape_string($this->conn, $sql));
    $result = $this->conn->query($sql);
    if ($result) {
      $count = mysqli_affected_rows($this->conn);
      //update user and make it active
      $sql = "UPDATE `pish_users` SET `name`='$OwnerName' WHERE id=$userId";
      $result = $this->conn->query($sql);
      if ($result) {
        $this->resultJsonEncode([true,true]);
        return;
      }
      
    }
    $this->resultJsonEncode(false);
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
} else if ($typeAction == 'delete') {
  $company_id = (int)$post['company_id'];
  $companyAction->deleteOneCompany($company_id);
} else if ($typeAction == 'productCompany') {
  $offset = (int)$post['offset'];
  $company_id = (int)$post['company_id'];
  $companyAction->getAllProductsCompanyWithOffset($offset, $company_id);
} else if ($typeAction == 'getStatusCompanies') {
  $companyUserIds = $post['companyUserIds'];
  $companyAction->getCompanyStatus($companyUserIds);
} else if ($typeAction == 'updateOneRealCompany') {
  $userId = (int)$post['userId'];
  $company_id = (int)$post['company_id'];
  $ShopName = $post['ShopName'];
  $title = $post['title'];
  $OwnerName = $post['OwnerName'];
  $MobilePhone = $post['MobilePhone'];
  $phone = $post['phone'];
  $Address = $post['Address'];

  $type = $post['type'];
  $RegCode = $post['RegCode'];
  if ($type == 'finish') {
    $companyAction->updateCompanyFinish($userId, $company_id, $ShopName, $title, $OwnerName, $MobilePhone, $phone, $Address, $type, $RegCode);
  }
  if($type=='next'){
    $companyAction->updateCompanyLevelTwo($userId, $company_id, $ShopName, $title, $OwnerName, $MobilePhone, $phone, $Address);
  }
} else {
}
