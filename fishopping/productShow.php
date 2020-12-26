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
class Product
{
  private $conn;
  public function __construct(mysqli $conn)
  {
    $this->conn = $conn;
  }
  

   /**
   * get All brands with offset
   * @param int $offset offset for get brands
   * @return Array array of Objects
   */
  public function deleteOneProduct(int $product_id): void
  {
    $status = false;
    $product_id = $this->getInput($product_id);

    try {
      // run your code here
      $sql = "DELETE FROM pish_hikashop_product WHERE pish_hikashop_product.product_id = $product_id";
      $result = $this->conn->query($sql);
      if ($result) {
        $rowcount = mysqli_affected_rows($this->conn);
        $status = $rowcount ? true : false;
      }else{
        $status = false;
      }
    } catch (exception $e) {
      //code to handle the exception
      $this->resultJsonEncode($status);
    }
    //output data
    $this->resultJsonEncode($status);
  }


  /**
   * update one product
   */
  public function updateProduct(
    int $product_id,
    string $product_name,
    string $product_counting_unit,
    string $product_package_type,
    float $product_weight,
    int $product_number_in_package,
    string $product_delivery_time,
    float $product_msrp,
    float $product_sort_price,
    string $product_sale_type,
    stdClass &$object
    )
  { 
      $message = '';  
      $product_name=$this->getInput($product_name);
      $product_counting_unit=$this->getInput($product_counting_unit);
      $product_package_type=$this->getInput($product_package_type);
      $product_weight=$this->getInput($product_weight);
      $product_number_in_package=$this->getInput($product_number_in_package);
      $product_delivery_time=$this->getInput($product_delivery_time);
      $product_msrp=$this->getInput($product_msrp);
      $product_sort_price=$this->getInput($product_sort_price);
      $product_sale_type=$this->getInput($product_sale_type);
      $product_id=$this->getInput($product_id);
      $sql = "  
      UPDATE pish_hikashop_product   
      SET product_name ='$product_name',   
      product_counting_unit ='$product_counting_unit',   
      product_package_type ='$product_package_type',   
      product_weight = '$product_weight',   
      product_number_in_package = '$product_number_in_package',
      product_delivery_time='$product_delivery_time',
      product_msrp='$product_msrp',
      product_sort_price='$product_sort_price',
      product_sale_type='$product_sale_type'
      WHERE product_id='$product_id'";  
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

 
}


/**
 * this section get all post inputs
 */
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$product_id = $post['product_id'];
$typeAction = $post['typeAction'];

$product = new Product($conn);
if ($typeAction == 'delete' && isset($product_id)) {
  //delete one product
  $product_id = (int)$product_id;
  $product->deleteOneProduct($product_id);
} elseif($typeAction =='edit'){
  $name = $post["name"];  
  $counting = $post["counting"];  
  $packagetype = $post["packagetype"];  
  $weight = $post["weight"];  
  $numberinpackage = $post["numberinpackage"]; 
  $deliverytime = $post["deliverytime"];  
  $msrp = $post["msrp"];  
  $sortprice = $post["sortprice"];  
  $saletype = $post["saletype"]; 
  $product_id = $post["product_id"];
  $product->updateProduct(
    $product_id,
    $name,
    $counting,
    $packagetype,
    $weight,
    $numberinpackage,
    $deliverytime,
    $msrp,
    $sortprice,
    $saletype,
    $object
  );
} else {
  //do some thing else
}