{source}<style>
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
display: flex;
justify-content: center;
flex-direction: row-reverse;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: right;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
direction: rtl;
}
</style>

<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
?>

<!-- Tab links -->
<div class="tab">
<button class="tablinks" onclick="showTab(event, 'brands')">برندها</button>
</div>

<!-- Tab content -->
<div id="brands" class="tabcontent">
<?php
//call all brands list
//http://hypernetshow.com/serverHypernetShowUnion/GetAllBrandsWithDetail.php

$url = "http://hypernetshow.com/serverHypernetShowUnion/GetAllBrandsWithDetail.php";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
echo curl_error($ch);
echo "\n<br />";
$contents = '';
} else {
curl_close($ch);
}

$contents = json_decode($contents, true);
?>

<div style="display: flex;flex-direction: row;flex-wrap: wrap;">
 
<?php
foreach($contents as $main_item) {

   if($main_item["category_id"] != $_GET["selected_category"]) {

      continue;

   }

   foreach($main_item["sub_cat"] as $item) {
?>
<div style="flex: 15%;display: flex; flex-direction: column;align-items:center;justify-content: center;text-align: center;margin-top: 10px;margin-bottom: 35px;">
<a href="http://hypernetshow.com/index.php?option=com_content&view=article&id=5&cat_id=<?=$item["category_id"]?>&canAccess=<?=$_GET['canAccess']?>">
<img src="<?=$item["brand_image"]?>" alt="<?=$item["category_name"]?>" style="max-width:100px;max-height:100px;" >
</a>
</div>
<?php
}

   }
?>
</div>
</div>

<script>
showTab(event, 'brands')
function showTab(evt, cityName) {
// Declare all variables
var i, tabcontent, tablinks;

// Get all elements with class="tabcontent" and hide them
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}

// Get all elements with class="tablinks" and remove the class "active"
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}

// Show the current tab, and add an "active" class to the button that opened the tab
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
</script>{/source}