<?php

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

      echo "ok";
    } else {

      echo "notok";
    }
  }
}

$conn->close();
