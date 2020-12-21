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
    display: block;
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

  .none {
    display:none;
  }

  .show {
    display: block;
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
<div id="regions" class="tabcontent">

  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerStores">

  </div>
</div>

<div id="brands" class="tabcontent">

  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerBrands">

  </div>
</div>

<script>
  //default brand offset
  var brandCount =0;

  //default store offset
  var storeCount =0;

  showTab(event, 'brands')

  //old method
  function showTab(evt, cityName) {
    if(cityName=='regions'){
      //get all stroes
      hide('#brands')
      show('#regions')
      getAllStores();
    }
    if(cityName =='brands'){
      hide('#regions')
      show('#brands')
      getAllCompanies();
    }
    //hide all stores
  }

  /**
   * hide all elements by class name
   */
  function hide(className) {
    let el = document.querySelector(className);
    console.log('el show')
    console.log(el)
    if(el){
      if(!el.classList.contains('none')){
        el.classList.add('none')
      }
    }
  }

  /**
   * show all elements by class name
   */
  function show(className){
    let el = document.querySelector(className);
    console.log('el show')
    console.log(el)
    if(el){
      if(el.classList.contains('none')){
        el.classList.remove('none')
      }
    }
  }

  /**
   * section actions on stores
   */
  function getAllStores(type=null){
      if(type==null){
          jQuery('.store').remove()
          storeCount=0
      }
    // sent ajax request
    var data = {
      offset:storeCount,
      typAction:"select"
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
        jQuery('#containerStores').append(store)

        })
        //add button moreStore
        let moreStore = `<div class="row justify-content-center store moreButton">
          <div class="col-xs-12 text-center">
            <button onclick="getAllStores('more')" class="btn btn-primary">پیشنهاد فروشگاه بیشتر</button>
          </div>
        </div>`;
        if(type !="more" && storeCount==0){
          jQuery('#containerStores').after(moreStore)
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


  /**
   * section actions on brands
   */
  function getAllCompanies(type=null){
      if(type==null){
        jQuery('.brand').remove()
        brandCount=0
      }
    // sent ajax request
    var data = {
      offset:brandCount,
      typeAction:"select"
    };
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/showBrands.php",
      method: "POST",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        console.log(data)
        data.forEach (function(item,index){
          console.log(`${item['brand_image']}`)
          let brand =` <div class="card-flex brand" >
          <div class="brandImage">
          <img src="http:/${item['brand_image']}" >
          </div>
          <a class="card-link" href="http://hypertester.ir/index.php?option=com_content&view=article&id=6&area=${item["category_id"]}" class="">
            <p> ${item["category_name"]} </p>
          </a>
        </div>`;
        jQuery('#containerBrands').append(brand)

        })
        //add button moreStore
        let moreStore = `<div class="row justify-content-center brand moreBrnadButton">
          <div class="col-xs-12 text-center">
            <button onclick="getAllCompanies('more')" class="btn btn-primary">پیشنهاد فروشگاه بیشتر</button>
          </div>
        </div>`;
        if(type !="more" && brandCount==0){
          jQuery('#containerBrands').after(moreStore)
        }
        if(data.length==0){
          jQuery('.moreBrnadButton').remove()
        }

        brandCount +=10;
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }
</script>

{/source}