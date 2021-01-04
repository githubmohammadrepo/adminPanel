{source}
<?php
function getInput($input)
{
  $result = htmlspecialchars(strip_tags($input));
  if (preg_match('/<>;:\$^/', $result)) {
    return;
  } else {
    return $result;
  }
}
error_reporting(E_ALL);

ini_set('error_reporting', E_ALL);

ini_set('display_errors', 1);

$user = JFactory::getUser();

//call region stores list webservice

//http://fishopping.ir/serverHypernetShowUnion/GetAreaStoresList_V2.php

$url = "http://hypertester.ir/serverHypernetShowUnion/GetAreaStoresList_V2.php";

$post = [
   'area' => getInput($_GET["area"]),
   'offset' => isset(($_GET["offset"])) ? getInput($_GET['offset']) :  0
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

      display: none;
      /* Hidden by default */

      position: fixed;
      /* Stay in place */

      z-index: 1;
      /* Sit on top */

      left: 0;

      top: 0;

      width: 100%;
      /* Full width */

      height: 100%;
      /* Full height */

      overflow: auto;
      /* Enable scroll if needed */

      background-color: rgb(0, 0, 0);
      /* Fallback color */

      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */

   }

   /* Modal Content/Box */

   .modal-content {

      background-color: #fefefe;

      margin: 5% auto;
      /* 15% from the top and centered */

      padding: 20px;

      border: 1px solid #888;

      width: 80%;
      /* Could be more or less, depending on screen size */

   }

   /* The Close Button */

   .close {

      color: #aaa;

      float: right;

      font-size: 28px;

      font-weight: bold;

   }

   .close:hover,

   .close:focus {

      color: black;

      text-decoration: none;

      cursor: pointer;

   }
</style>

<div style="display: flex;flex-direction: row;flex-wrap: wrap;direction: rtl">

   <?php

   if ($contents && count($contents) > 0) {

      $index = 0;

      foreach ($contents as $store) {
   ?>

         <div class="prodBox" style="flex: 30%;text-decoration: none;margin: 5px;border: 1px solid #eeeeee;padding: 5px;border-radius: 5px">

            <div style="display: flex; flex-direction: column;justify-content: center;align-items: center;">

               <div style="margin-bottom: 5px;">

                  <p style="display: inline;">نام فروشگاه:</p>

                  <p style="display: inline;font-weight: bold"><?= $store["ShopName"] ?></p>

               </div>

               <div style="margin-bottom: 5px;">

                  <p style="display: inline;">مالک :</p>

                  <p style="display: inline;font-weight: bold"><?= $store["OwnerName"] ?></p>

               </div>

               <?php if ($user->id != 0) { ?>

                  <div style="margin-bottom: 5px;">

                     <p style="display: inline;">تلفن:</p>

                     <p style="display: inline;font-weight: bold"><?= $store["MobilePhone"] ?></p>

                  </div>

               <?php } ?>

               <div>

                  <a href="http://hypertester.ir/index.php?option=com_content&view=article&id=49&lat=<?= $store["latitude"] ?>&lng=<?= $store["longitude"] ?>&name=<?= $store["ShopName"] ?>">

                     نمایش روی نقشه

                  </a>
                  <button class="btn btn-primary btn-sm" onclick="showMoreDetails(event,<?php echo $store['markerid']; ?>)">جزئیات بیشتر</button>

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

   <script>
      function showMoreDetails(e,marketId){
         e.preventDefault();
         console.log(marketId)
      }
   </script>
{/source}