<?php
include "connection.php";
$region_id = $_POST['area'];
$brand_id = $_POST['brand_id'];
$offset = isset($_POST['offset'])? $_POST['offset'] :  -1;

$sql = "";
if($offset == -1){
  $sql = "select hikaUser.user_cms_id as storeid, m.id, m.user_id, m.ShopName, m.MobilePhone, m.RegionID, m.OwnerName, m.latitude, m.longitude, count(orderProducts.order_product_id) as qty from pish_phocamaps_marker_store as m 
  left join pish_hikashop_user as hikaUser on hikaUser.user_cms_id = m.user_id
  left join pish_hikashop_order as orderTable on hikaUser.user_id = orderTable.order_user_id and orderTable.order_status = 'created' and orderTable.order_vendor_id = '$brand_id'
  left join pish_hikashop_order_product as orderProducts on orderProducts.order_id = orderTable.order_id 
  where m.RegionID='$region_id' GROUP BY orderTable.order_user_id, m.ShopName, m.MobilePhone ORDER BY orderTable.order_id DESC, m.id DESC";
}else{
  $sql = "select hikaUser.user_cms_id as storeid, m.id, m.user_id, m.ShopName, m.MobilePhone, m.RegionID, m.OwnerName, m.latitude, m.longitude, count(orderProducts.order_product_id) as qty from pish_phocamaps_marker_store as m 
  left join pish_hikashop_user as hikaUser on hikaUser.user_cms_id = m.user_id
  left join pish_hikashop_order as orderTable on hikaUser.user_id = orderTable.order_user_id and orderTable.order_status = 'created' and orderTable.order_vendor_id = '$brand_id'
  left join pish_hikashop_order_product as orderProducts on orderProducts.order_id = orderTable.order_id 
  where m.RegionID='$region_id' GROUP BY orderTable.order_user_id, m.ShopName, m.MobilePhone ORDER BY orderTable.order_id DESC, m.id DESC limit $offset,20";
}

$result = $conn->query($sql);

$output = array();
$fetch_data = array();

while ($row = mysqli_fetch_array($result)){
  $fetch_data['storeid'] = $row['storeid'];
  $fetch_data['user_id'] = $row['user_id'];
  $fetch_data['markerid'] = $row['id'];
  $fetch_data['ShopName'] = $row['ShopName'];
  $fetch_data['MobilePhone'] = $row['MobilePhone'];
  $fetch_data['RegionID'] = $row['RegionID'];
  $fetch_data['OwnerName'] = $row['OwnerName'];
  $fetch_data['latitude'] = $row['latitude'];
  $fetch_data['longitude'] = $row['longitude'];
  $fetch_data['qty'] = $row['qty'];

 $output[] = $fetch_data;
}

$jsonEncode = json_encode($output, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
 
echo $jsonEncode;

mysqli_close($con);