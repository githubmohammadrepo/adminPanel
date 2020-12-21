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

  .card-flex {
    flex: 25%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 10px;
    background: brown;
    border: 3px solid white;
  }

  .card-link {
    text-decoration: none;
    border: 1px solid #eeeeee;
    display: block;
    height: 45px;
    padding: 5px 10px;
    background: crimson;
    color: white;
    width: 90%;
  }

  .none {
    display: none;
  }

  .show {
    display: block;
  }

  #showAddNewBrand {
    margin-top: 40px;
  }
  .modal-header {
    display: flex;
  }
  .modal-header .close {
    margin-right: auto;
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
  <button class="tablinks" onclick="showTab(event, 'brands',this)">برندها</button>
  <!-- <button class="tablinks" onclick="showTab(event, 'categories')">دسته بندی ها</button> -->
  <button class="tablinks" onclick="showTab(event, 'regions',this)">فروشگاه ها</button>
</div>

<!-- Tab content -->
<div id="regions" class="tabcontent">

 <!--add new store  -->
  <!-- Button trigger modal -->
  <a href="http://hypertester.ir/index.php?option=com_rsform&view=rsform&formId=72" class="btn btn-primary" >
    اظافه کردن فروشگاه جدید
</a>

  
  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerStores">

  </div>
</div>

<div id="brands" class="tabcontent">

  <!--add new brand  -->
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showAddNewBrand">
    اظافه کردن شرکت جدید
  </button>

  <!-- Modal -->
  <div class="modal fade" id="showAddNewBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">ثبت نام شرکت</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" >
          <!-- modal body -->
          <div class="row">
            <div id="sp-component" class="col-sm-12 col-md-12">
              <div class="sp-column ">
                <div id="system-message-container">
                </div>
                <form method="post" id="addCompany" onsubmit="addNewBrand(event)" class="formResponsive form">
                  

                  <!-- Do not remove this ID, it is used to identify the page so that the pagination script can work correctly -->
                  <fieldset class="formHorizontal formContainer" id="rsform_65_page_0">
                    <div class="rsform-block rsform-block-brandusername">
                      <div class="formControlLabel">نام کاربری<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody"><input class="form-control" type="text" value="" maxlength="30" placeholder="نام کاربری" name="brandusername" id="brandusername" class="rsform-input-box"><span class="formValidation"><span id="component643" class="formNoError">این نام کاربری قبلاً ثبت شده است!</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-brandpassword">
                      <div class="formControlLabel">رمز عبور شرکت<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody"><input class="form-control" type="text" value="" placeholder="رمز عبور شرکت" name="brandpassword" id="brandpassword" class="rsform-input-box"><span class="formValidation"><span id="component465" class="formNoError"></span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-confirmed-password">
                      <div class="formControlLabel">تکرار رمز عبور شرکت<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody"><input class="form-control" type="text" value="" placeholder="تکرار رمز عبور شرکت" name="confirmed_password" id="confirmed_password" class="rsform-input-box"><span class="formValidation"><span id="component466" class="formNoError"></span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <!-- <div class="rsform-block rsform-block-submit">
                      <div class="formControlLabel"></div>
                      <div class="formControls">
                        <div class="formBody"><button type="submit" name="form[Submit]" id="Submit" class="rsform-submit-button">تایید</button><span class="formValidation"></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div> -->
                    <input type="hidden" name="form[userid]" id="userid" value="0">
                  </fieldset>
                  <input type="hidden" name="form[formId]" value="65">
                </form>
              </div>
            </div>
          </div>
          <!-- endmodal body -->
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-danger" data-dismiss="modal">بستن</button>
          <button type="button" onclick="addNewBrand(event)"  class="btn btn-primary">ذخیره کردن</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end add new brand -->

  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerBrands">
  </div>
</div>

<script>
  //default brand offset
  var brandCount = 0;

  //default store offset
  var storeCount = 0;

  showTab(event, 'brands',document.querySelector('#brands'))

  var saveBeforeTabElement=null;
  //old method
  function showTab(evt, cityName,button) {
    if(saveBeforeTabElement){
      saveBeforeTabElement.classList.remove('active')
    }
    if(button){
      button.classList.add('active')
      saveBeforeTabElement=button;
    }
    if (cityName == 'regions') {
      //get all stroes
      hide('#brands')
      show('#regions')
      getAllStores();
    }
    if (cityName == 'brands') {
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
    if (el) {
      if (!el.classList.contains('none')) {
        el.classList.add('none')
      }
    }
  }

  /**
   * show all elements by class name
   */
  function show(className) {
    let el = document.querySelector(className);
    console.log('el show')
    console.log(el)
    if (el) {
      if (el.classList.contains('none')) {
        el.classList.remove('none')
      }
    }
  }

  /**
   * section actions on stores
   */
  function getAllStores(type = null) {
    if (type == null) {
      jQuery('.store').remove()
      storeCount = 0
    }
    // sent ajax request
    var data = {
      offset: storeCount,
      typAction: "select"
    };
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/showStores.php",
      method: "POST",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function(data) {

        data.forEach(function(item, index) {
          let store = ` <div class="card-flex store">
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
        if (type != "more" && storeCount == 0) {
          jQuery('#containerStores').after(moreStore)
        }
        if (data.length == 0) {
          jQuery('.moreButton').remove()
        }

        storeCount += 10;
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }


  /**
   * section actions on brands
   */
  function getAllCompanies(type = null) {
    if (type == null) {
      jQuery('.brand').remove()
      brandCount = 0
    }
    // sent ajax request
    var data = {
      offset: brandCount,
      typeAction: "select"
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
        data.forEach(function(item, index) {
          console.log(`${item['brand_image']}`)
          let brand = ` <div class="card-flex brand" >
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
        if (type != "more" && brandCount == 0) {
          jQuery('#containerBrands').after(moreStore)
        }
        if (data.length == 0) {
          jQuery('.moreBrnadButton').remove()
        }

        brandCount += 10;
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }

  /**
   * add new brand
   */
  function addNewBrand(e){
    e.preventDefault();
    let data = {
      'brandusername': document.querySelector('input[name="brandusername"]').value,
      'brandpassword': document.querySelector('input[name="brandpassword"]').value,
      'confirmed_password': document.querySelector('input[name="confirmed_password"]').value
    };
    console.log(data)
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/RegisterBrandUP.php",
      method: "POST",
      // data: JSON.stringify(data),
      // dataType: "json",
      // contentType: "application/json",
      data:data,
      success: function(data) {
        let alert;
        if(data=='passError'){
          //password is dublicate
          alert = `<div class="alert alert-danger modal-brand" role="alert">
           رمزعبور ها یکی نیستند!
          </div>`;
        }else if(data=='exist'){
          //company is exist
          alert = `<div class="alert alert-danger modal-brand" role="alert">
           نام کاربری شما وجود دارد!
          </div>`;
        }else if(data){
          // company registered
          alert = `<div class="alert alert-success modal-brand" role="alert">
           شرکت با موفقیت ثبت شد!
          </div>`;
        }else{  
          //error accured on the server
          alert = `<div class="alert alert-danger modal-brand" role="alert">
            خطا در ذخیره ی اطلاعات!
          </div>`;
        }
        jQuery('.modal-brand').remove();
        jQuery('#addCompany').before(alert)

        
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }
</script>

{/source}