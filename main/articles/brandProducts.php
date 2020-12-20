{source}<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$user = JFactory::getUser();
$canAccess = false;
$groups = JAccess::getGroupsByUser($user->id);
foreach($groups as $g) {
if($g == 10 || $g == 16) {
$canAccess = true;
}
}

if($_GET['canAccess'] == "0") {
$canAccess = false;
}
$basket_updated = false;

$session = JFactory::getSession();

if (isset($_POST) && isset($_POST["product_id"]) && $_POST["count"] != "") {
   $basket = $session->get("store_basket");

   if($basket) {

      $found = false;

      for($i=0; $i < count($basket); $i++) {

         if($basket[$i]["product_id"] == $_POST["product_id"]) {

             $basket[$i]['count'] += $_POST["count"];

             $found = true;

              break;

         }

      }

 

      if(!$found) {

         $basket[] = array('product_id'=> $_POST["product_id"], 'count' => $_POST["count"], 'product_name' => $_POST["product_name"], 'product_price' => $_POST["product_price"], 'vendor_id' => $_POST["product_vendor"]);

      }

   } else {

     $basket = [];

     $basket[] = array('product_id'=> $_POST["product_id"], 'count' => $_POST["count"], 'product_name' => $_POST["product_name"], 'product_price' => $_POST["product_price"], 'vendor_id' => $_POST["product_vendor"]);

   }

   $session->set('store_basket', $basket);

   $basket_updated = true;

}


//call brand products list webservice
//http://hypernetshow.com/serverHypernetShowUnion/GetBrandsProductsWhenClickedBrandsName1.php

$url = "http://hypernetshow.com/serverHypernetShowUnion/GetBrandsProductsWhenClickedBrandsName1.php";

$post = [
'category_id' => $_GET["cat_id"]
];
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
if (curl_errno($ch)) {
$error_msg = curl_error($ch);
}
curl_close($ch);
$contents = json_decode($output, true);

?>
<style>
/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
background-color: #fefefe;
margin: 5% auto; /* 15% from the top and centered */
padding: 20px;
border: 1px solid #888;
width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
color: black;
float: right;
font-size: 20px;

border: 1px solid #343434;
font-weight: bold;

padding: 5px;
}

.close:hover,
.close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}
</style>

<?php

if($basket_updated) {

?>

<div style="text-align: center; background-color: #a7dea7; color: white; padding: 5px; font-size: 17px;">

<p>محصول با موفقیت به سبد خرید اضافه شد</p>

</div>

<?php

}

?>


<div style="display: flex;flex-direction: row;flex-wrap: wrap;direction: rtl">

<?php

if($contents && count($contents) > 0){
$index = 0;
foreach($contents as $product) {
?>
<div class="prodBox"  style="flex: 30%;text-decoration: none;margin: 5px;padding: 0px;border: none;background-color: white;padding: 5px;border: 1px solid #eeeeee;min-height: 100px;">

<div style="display: flex; flex-direction: row;justify-content: flex-start;">
<img src="<?=$product["product_image"]?>" style="max-width:100px;max-height:140px;margin-right: 10px;margin-left: 10px;" />
<div style="display: flex; flex-direction: column;justify-content: center;">
<div style="margin-bottom: 5px;">
<p style="display: inline;">نام محصول:</p>
<p style="display: inline;font-weight: bold"><?=$product["product_name"]?></p>
</div>
<div style="margin-bottom: 5px;">
<p style="display: inline;">نام برند:</p>
<p style="display: inline;font-weight: bold"><?=$product["category_name"]?></p>
</div>
<div style="margin-bottom: 5px;">
<p style="display: inline;">قیمت واحد:</p>
<p style="display: inline;font-weight: bold"><?=$product["product_sort_price"]?></p>
</div>
</div>
</div>

<div style="display: flex; flex-direction: column;">

<button style="width: 100px;margin-bottom: 10px;" onclick="handleBoxClick(<?=$index?>)">جزئیات محصول</button>

<div style="display: flex; flex-direction: row;">

<form method="post">

<input type="hidden" value="<?=$product["product_id"]?>" name="product_id" />

<input type="hidden" value="<?=$product["product_name"]?>" name="product_name" />

<input type="hidden" value="<?=$product["product_sort_price"]?>" name="product_price" />

<input type="hidden" value="<?=$product["product_vendor_id"]?>" name="product_vendor" />

<?php if($canAccess) { ?>

<input placeholder="تعداد" name="count" type="number" min="0" />

<button type="submit">افزودن به سبد خرید</button>

<?php } ?>

</form>

</div>

</div>
</div>
<?php
$index++;
}
} else {
?>

<h4 style="text-align:center;width: 100%;"> موردی پیدا نشد. </h4>
<?php
}
?>

<!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
<div style="display: flex; flex-direction: column;">

<div style="display: flex; flex-direction: column;align-items: center">
<img id="prod_image" style="max-width:100px;max-height:140px;" />
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نام برند:</p>
<p id="prod_brand" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نام محصول:</p>
<p id="prod_name" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">واحد شمارش: </p>
<p id="prod_counter" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">وزن بسته بندی: </p>
<p id="prod_weight" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">تعداد در بسته بندی:</p>
<p id="prod_count" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نوع بسته بندی:</p>
<p id="prod_type" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">مدت زمان تحویل:</p>
<p id="prod_time" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نرخ مصرف کننده (تومان):</p>
<p id="prod_consumer" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نحوه تسویه حساب:</p>
<p id="prod_equal" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نرخ سوپرمارکت:</p>
<p id="prod_supermarket" style="font-weight: bold;"></p>
</div>

<div style="display: flex; flex-direction: row;">
<p class="close" >بستن</p>
</div>
</div>
</div>
</div>

</div>

</div>
<script>
var products = <?php echo json_encode($contents); ?>;
var selected_index = 0;
var selected_product = {};

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
//var productBoxs = document.getElementsByClassName("prodBox");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
function handleBoxClick(id) {
selected_index = id;
selected_product = products[id];

document.getElementById("prod_image").src = selected_product['product_image'];
document.getElementById("prod_brand").innerHTML = selected_product['category_name'];
document.getElementById("prod_name").innerHTML = selected_product['product_name'];
document.getElementById("prod_counter").innerHTML = 'عدد';
document.getElementById("prod_weight").innerHTML = selected_product['product_weight'];
document.getElementById("prod_count").innerHTML = selected_product['product_quantity'];
document.getElementById("prod_type").innerHTML = '';
document.getElementById("prod_time").innerHTML = '';
document.getElementById("prod_consumer").innerHTML = selected_product['product_msrp'];
document.getElementById("prod_equal").innerHTML = '';
document.getElementById("prod_supermarket").innerHTML = selected_product['product_sort_price'];

modal.style.display = "block";
}



// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}
</script>{/source}