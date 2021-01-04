<?php
// Start the session
session_start();
// if user is admi
function getInput($input)
{
  $result = htmlspecialchars(strip_tags($input));
  if (preg_match('/<>;:\$^/', $result)) {
    return;
  } else {
    return $result;
  }
}
/**
 * Created by PhpStorm.
 * User: androiddev
 * Date: 7/17/17
 * Time: 10:49 PM
 */


include "connection.php";

$brandname = $_POST["brandname"];
$brandconame = $_POST["brandconame"];
$brandbranchname = $_POST["brandbranchname"];
$brandcophone = $_POST["brandcophone"];
$brandmobile = $_POST["brandmobile"];
$brandfax = $_POST["brandfax"];
$brandemail = $_POST["brandemail"];
$branusername = $_POST["brandusername"];
$brandpass = $_POST["brandpassword"];
$idusername = $_POST["idusername"];
$marketerid = $_POST["marketerid"];
$brandSelectedId = $_POST['brandSelectedId'];


//check if user admin?
function checkIfUserAdmin($idusername,&$conn){
  $idusername = getInput($idusername);
  $sql = "SELECT pish_user_usergroup_map.group_id FROM pish_user_usergroup_map WHERE 
  pish_user_usergroup_map.user_id = (SELECT pish_users.id FROM pish_users WHERE pish_users.id=$idusername)";
  $result = $conn->query($sql);
  if($result){
    $count = mysqli_num_rows($result);
    if($count>1){
      $dev_array = Array();
      while($row = mysqli_fetch_assoc($result)){
        if($row['group_id']==2 && $row['group_id']==8){
          $dev_array[]=true;
        }
      }
      if(count($dev_array)==2 && !in_array(false,$dev_array,true)){
        return true;
      }
    }
  }
  return false;
}
// $sql = "SELECT title FROM pish_phocamaps_marker_company WHERE user_id IS NOT NULL AND MobilePhone = '$brandmobile'";

$sql = "SELECT title FROM pish_phocamaps_marker_company INNER JOIN pish_users ON pish_phocamaps_marker_company.user_id=pish_users.id 
WHERE pish_phocamaps_marker_company.MobilePhone = '$brandmobile' AND pish_phocamaps_marker_company.user_id IS NOT NULL AND pish_users.block= 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "exist";
} else {
  $sql2 = "DELETE FROM pish_phocamaps_marker_fake WHERE user_id='$idusername'";
  $result2 = $conn->query($sql2);

  if ($marketerid == "") {  
    $sql1 = "INSERT INTO pish_phocamaps_marker_fake (brandSelectedname, user_id, title, ShopName, OwnerName, phone, MobilePhone, Fax, Email)
VALUES ('$brandSelectedId', '$idusername', '$brandname', '$brandconame', '$brandbranchname', '$brandcophone', '$brandmobile', '$brandfax', '$brandemail')";

    if ($conn->query($sql1) === TRUE) {

      echo "ok";
    } else {
      echo "notok";
    }
  } else {

    $sql1 = "INSERT INTO pish_phocamaps_marker_fake (brandSelectedname, user_id, title, ShopName, OwnerName, phone, MobilePhone, Fax, Email, marketer_user_id)
VALUES ('$brandSelectedId','$idusername', '$brandname', '$brandconame', '$brandbranchname', '$brandcophone', '$brandmobile', '$brandfax', '$brandemail', '$marketerid')";

    if ($conn->query($sql1) === TRUE) {

      /*
$sql2 = "SELECT * FROM pish_hikashop_category where category_parent_id = 10 ORDER BY category_ordering DESC LIMIT 1
";
$result1 = $conn->query($sql2);

$dev = array();
if ($result1->num_rows > 0) {
 
 for ($i = 0; $i < $result1-> num_rows; $i++)
    {
        $dev[$i] = $result1->fetch_assoc();
    }

$catOrdering = $dev[0]['category_ordering'] + 1;
$catLeft = $dev[0]['category_right'] + 1;
$catRight = $catLeft + 1;

 $sql3 = "INSERT INTO pish_hikashop_category (user_id, category_parent_id, category_type, category_name, category_published, category_ordering, category_left, category_right, category_depth)
VALUES ('$idusername', 10, 'manufacturer', '$brandname', 1, '$catOrdering', '$catLeft', '$catRight', 2)";

    if ($conn->query($sql3) === TRUE) 
    {
        echo "ok";
        
    } else {
        echo "notok";
    }

    } else {
        echo "notok";
    }
    
   */
    if(checkIfUserAdmin($idusername,$conn)){
      //redirecto to final webservice
      
      $sql1 = "SELECT * FROM pish_phocamaps_marker_fake WHERE user_id = '$userId'";
        
      $result = $conn->query($sql1);
      
      
      $dev = array();
      
      if ($result->num_rows > 0) {
         
         
         
         for ($i = 0; $i < $result-> num_rows; $i++)
          {
              $dev[$i] = $result->fetch_assoc();
          }
          
      
      $myUserId = $dev[0]['user_id'];
      $title = $dev[0]['title'];
      $ShopName = $dev[0]['ShopName'];
      $phone = $dev[0]['phone'];
      $MobilePhone = $dev[0]['MobilePhone'];
      $OwnerName = $dev[0]['OwnerName'];
      $Fax = $dev[0]['Fax'];
      $Email = $dev[0]['Email'];
      $ShopKind = $dev[0]['ShopKind'];
      $sms_confirmed = $dev[0]['sms_confirmed'];
      $marketer_user_id = $dev[0]['marketer_user_id'];
      
          
          if($marketer_user_id == ""){
              
               
          $sql2 = "INSERT INTO pish_phocamaps_marker_company (user_id, title, ShopName, phone, MobilePhone, OwnerName, Fax, Email)
      VALUES ('$myUserId', '$title', '$ShopName', '$phone', '$MobilePhone', '$OwnerName', '$Fax', '$Email')";
      
          if ($conn->query($sql2) === TRUE) {
      
          $inserted_marker_id = $conn->insert_id;
          $sql_vendor = "INSERT INTO pish_hikamarket_vendor (vendor_id, vendor_name, vendor_alias, vendor_canonical, vendor_image, vendor_template_id, vendor_site_id) VALUES ('$inserted_marker_id', '$title', '$ShopName', '', '', '', '')";
          $conn->query($sql_vendor);
      
      $sql3 = "SELECT * FROM pish_hikashop_category where category_parent_id = 10 ORDER BY category_ordering DESC LIMIT 1
      ";
      $result1 = $conn->query($sql3);
      
      $dev = array();
      if ($result1->num_rows > 0) {
       
       for ($i = 0; $i < $result1-> num_rows; $i++)
          {
              $dev[$i] = $result1->fetch_assoc();
          }
      
      $catOrdering = $dev[0]['category_ordering'] + 1;
      $catLeft = $dev[0]['category_right'] + 1;
      $catRight = $catLeft + 1;
      
      $time = time();
      $random = rand(1000000,10000000);
      $category_namekey = "manufacturer_${time}_${random}";
      
       $sql3 = "INSERT INTO pish_hikashop_category (user_id, category_parent_id, category_type, category_name, category_published, category_ordering, category_left, category_right, category_depth, category_namekey)
      VALUES ('$myUserId', 10, 'manufacturer', '$title', 1, '$catOrdering', '$catLeft', '$catRight', 2, '$category_namekey')";
      
      
      if ($conn->query($sql3) === TRUE) {

      }
    }

      echo "ok";
    } else {

      echo "notok";
    }
  }
}

$conn->close();
