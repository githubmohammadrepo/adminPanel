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
  public function removeOneStore(int $store_id):void{
    $store_id = $this->getInput($store_id);
    $sql = "DELETE FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.id = $store_id";
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_affected_rows($this->conn);
      if($count){
        $this->resultJsonEncode(true);
        return;
      }
    }
    $this->resultJsonEncode(false);
  }

 
  /**
  * show product stroe with offset
  */
  public function showProductStoreWithOffset(int $store_id,int $offset) {
    $store_id = $this->getInput($store_id);
    $offset = $this->getInput($offset);
    $sql = "SELECT Store.id,pish_product_store.id,pish_product_store.product_id,pish_product_store.store_id,pish_hikashop_product.*,pish_hikashop_file.file_path,pish_hikashop_file.file_ref_id
    FROM (SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.id = 129308) AS Store
    INNER JOIN pish_product_store ON Store.id = pish_product_store.store_id
    LEFT JOIN pish_hikashop_product ON pish_product_store.product_id = pish_hikashop_product.product_id
    LEFT JOIN pish_hikashop_file ON pish_hikashop_product.product_manufacturer_id = pish_hikashop_file.file_ref_id LIMIT $offset,20";
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_num_rows($result);
      if($count){
        $dev_array = Array();
        while($row = $result->fetch_assoc()){
          $dev_array[] =$row;
        }
        $this->resultJsonEncode($dev_array);
      }else{
        $this->resultJsonEncode([]);
      }
    }else{
      $this->resultJsonEncode([]);
    }
  }


   /**
  * show product stroe with offset
  */
  public function getOneStoreForUpdate(int $store_id,$sql=null,&$result_dev,$type=null):void {
    $store_id = $this->getInput($store_id);
    if($sql==null){
      $sql = "SELECT Store.*,pish_province.id,pish_province.name,pish_city.id,pish_city.name FROM (SELECT pish_phocamaps_marker_store.ShopName,pish_phocamaps_marker_store.OwnerName,pish_phocamaps_marker_store.phone,pish_phocamaps_marker_store.province,pish_phocamaps_marker_store.city,pish_phocamaps_marker_store.MobilePhone,pish_phocamaps_marker_store.description,pish_phocamaps_marker_store.published FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.id = $store_id )AS Store LEFT JOIN pish_province ON Store.province = pish_province.id LEFT JOIN pish_city ON Store.city = pish_city.id";
    }
    
    $result = $this->conn->query($sql);
    if($result){
      $count = mysqli_num_rows($result);
      if($count){
        $dev_array = Array();
        while($row = $result->fetch_assoc()){
          $dev_array[] =$row;
        }
        if($type==null){
          $type='store';
        }
        $result_dev[$type]=$dev_array;
        
        if($type=='store'){
          $sql = "SELECT * FROM pish_province";
          $this->getOneStoreForUpdate($store_id,$sql,$result_dev,'province');
        }else if($type =='province'){
          $sql = "SELECT * FROM pish_city";
          $this->getOneStoreForUpdate($store_id,$sql,$result_dev,'city');
        }else{
          $this->resultJsonEncode($result_dev);
          return;
        }
      }else{
        $this->resultJsonEncode([]);
      }
    }else{
      $this->resultJsonEncode([]);
    }
  }
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

  /**
   * update one store and save it on database
   */
  /**
  * show product stroe with offset
  */
  public function upateStore(
    int $store_id,
    string $ShopName,
    string $OwnerName,
    string $phone,
    string $province,
    string $city,
    string $MobilePhone,
    string $description,
    bool $published,
    string $lat,
    string $lng
    ):void {

    $store_id = $this->getInput($store_id);
    $ShopName = $this->getInput($ShopName);
    $OwnerName = $this->getInput($OwnerName);
    $phone = $this->getInput($phone);
    $province = $this->getInput($province);
    $city = $this->getInput($city);
    $MobilePhone = $this->getInput($MobilePhone);
    $description = $this->getInput($description);
    $published = $this->getInput($published);
    $lat = $this->getInput($lat);
    $lng = $this->getInput($lng);

    $sql = "UPDATE pish_phocamaps_marker_store SET ShopName = '$ShopName',OwnerName='$OwnerName',phone='$phone',province='$province',city='$city',MobilePhone='$MobilePhone',description='$description',published='$published',latitude='$lat',longitude='$lng' WHERE id=$store_id";
    
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
    }
  }
}


/**
 * this section get all post inputs
 */
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$offset = isset($post['offset']) ? $post['offset'] : null;
$typeAction = $post['typeAction'];

$storeAction = new StoreActions($conn);
if($typeAction=='select' && isset($offset)){
  //get all store with offset
  $storeAction->getAllStoreWithOffset($offset);
}else if($typeAction=='update'){
  echo $store_id = $post['store_id,'];
  echo $ShopName = $post['ShopName,'];
  echo $OwnerName = $post['OwnerName,'];
  echo $phone = $post['phone,'];
  echo $province = $post['province,'];
  echo $city = $post['city,'];
  echo $MobilePhone = $post['MobilePhone,'];
  echo $description = $post['description,'];
  echo $published = $post['published,'];
  echo $lat = $post['latCusLocation,'];
  echo $lng = $post['lngCusLocation'];
  die();
  //update one store
  $storeAction->upateStore(
    $store_id,
    $ShopName,
    $OwnerName,
    $phone,
    $province,
    $city,
    $MobilePhone,
    $description,
    $published,
    $lat,
    $lng
  );
}else if($typeAction =='delete'){
  $store_id = (int)$post['store_id'];
  //delete one store
  $storeAction->removeOneStore($store_id);
}else if($typeAction =='storeProduct'){
  $store_id = $post['store_id'];
  $offset = $post['offset'];
  //return store products
  $storeAction->showProductStoreWithOffset($store_id,$offset);
}else if($typeAction =='getOneStoreForUpdate'){
  $store_id = $post['store_id'];
  //return store products
  $result = [];
  $storeAction->getOneStoreForUpdate($store_id,null,$result);
}else{

}

