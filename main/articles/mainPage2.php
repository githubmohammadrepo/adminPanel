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

  .card-flex{
    flex: 25%;
    display: flex;
     flex-direction: column;
    align-items:center;
    justify-content: center;
    text-align: center;
    padding:10px;
    background:brown;
    border: 3px solid white;
  }
  .card-link{
    text-decoration: none;
     border: 1px solid #eeeeee;
    display:block;
    height:45px;
    padding: 5px 10px;
    background:crimson;
    color:white;
    width:90%;
  }
    /* $document->addStyleDeclaration($style); */
</style>

<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
?>

<!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="showTab(event, 'brands')">برندها</button>
  <!-- <button class="tablinks" onclick="showTab(event, 'categories')">دسته بندی ها</button> -->
  <button class="tablinks" onclick="showTab(event, 'regions')">فروشگاه ها</button>
</div>

<!-- Tab content -->
<div id="brands" class="tabcontent">
  <?php
  //call all brands list
  //http://fishopping.ir/serverHypernetShowUnion/GetAllBrandsWithDetail.php

  // $url = "http://hypertester.ir/serverHypernetShowUnion/GetAllBrandsWithDetail.php";
  // $ch = curl_init();
  // curl_setopt($ch, CURLOPT_URL, $url);
  // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // $contents = curl_exec($ch);
  // if (curl_errno($ch)) {
  //   echo curl_error($ch);
  //   echo "\n<br />";
  //   $contents = '';
  // } else {
  //   curl_close($ch);
  // }

  // $contents = json_decode($contents, true);
  $contents = [];
  ?>

  <div style="display: flex;flex-direction: row;flex-wrap: wrap;">

    <?php
    foreach ($contents as $item) {



      $canAccess = $item['user_id'] == null ? 0 : 1;

    ?>
      <div style="flex: 15%;display: flex; flex-direction: column;align-items:center;justify-content: center;text-align: center;margin-top: 10px;margin-bottom: 35px;">
        <a href="<?php if (count($item["sub_cat"]) > 0) {
                    echo "http://hypertester.ir/index.php?option=com_content&view=article&id=34&selected_category={$item["category_id"]}&canAccess={$canAccess}";
                  } else {
                    echo "http://hypertester.ir/index.php?option=com_content&view=article&id=5&cat_id={$item["category_id"]}&canAccess={$canAccess}";
                  } ?>">
          <img src="<?= $item["brand_image"] ?>" alt="<?= $item["category_name"] ?>" style="max-width:100px;max-height:100px;">
        </a>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<div id="categories" class="tabcontent">
  <h3>Paris</h3>
  <p>Paris is the capital of France.</p>
</div>

<div id="regions" class="tabcontent">
  <?php
  //call all regions list
  //http://hypertester.ir/serverHypernetShowUnion/GetAreaList.php

  // $url_1 = "http://hypertester.ir/serverHypernetShowUnion/GetAreaList.php";
  // $ch1 = curl_init();
  // curl_setopt($ch1, CURLOPT_URL, $url_1);
  // curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 5);
  // curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
  // $regions = curl_exec($ch1);
  // if (curl_errno($ch1)) {
  //   echo curl_error($ch1);
  //   echo "\n<br />";
  //   $regions = '';
  // } else {
  //   curl_close($ch1);
  // }

  // $regions = json_decode($regions, true);
  $regions =[];
  ?>

  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerContent">

    <!-- <?php
    foreach ($regions as $item) {
    ?>
      <div style="flex: 25%;display: flex; flex-direction: column;align-items:center;justify-content: center;text-align: center;margin-top: 10px;margin-bottom: 35px;">
        <a href="http://hypertester.ir/index.php?option=com_content&view=article&id=6&area=<?= $item["alias"] ?>" style="text-decoration: none; border: 1px solid #eeeeee;padding: 5px 10px;">
          <p><?= $item["title"] ?></p>
        </a>
      </div>
    <?php
    }
    ?> -->
  </div>
</div>

<script>
  showTab(event, 'brands')

  function showTab(evt, cityName) {
    if(cityName=='regions'){
      //get all stroes
      getAllStores();
    }
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
</script>



<!-- get all brands -->
<script>
  var storeCount =0;
  function getAllStores(type=null){
      if(type==null){
          jQuery('.store').remove()
        storeCount=0
      }
    // sent ajax request
    var data = {
      offset:storeCount
    };
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/showStores.php",
      method: "POST",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        
        data.forEach (function(item,index){
          let store =` <div class="card-flex store">
          <a class="card-link" href="http://hypertester.ir/index.php?option=com_content&view=article&id=6&area=${item["alias"]}" class="">
            <p> ${item["title"]} </p>
          </a>
        </div>`;
        jQuery('#containerContent').append(store)

        })
        //add button moreStore
        let moreStore = `<div class="row justify-content-center store moreButton">
          <div class="col-xs-12 text-center">
            <button onclick="getAllStores('more')" class="btn btn-primary">پیشنهاد فروشگاه بیشتر</button>
          </div>
        </div>`;
        if(type !="more" && storeCount==0){
          jQuery('#containerContent').after(moreStore)
        }
        if(data.length==0){
          jQuery('.moreButton').remove()
        }

        storeCount +=10;
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }
</script>

{/source}