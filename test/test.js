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
  #updateBrand {
    margin-top:40px;
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
  <a href="http://hypertester.ir/index.php?option=com_rsform&view=rsform&formId=72" class="btn btn-primary">
    اظافه کردن فروشگاه جدید
  </a>


  <!-- start show modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateBrand" data-whatever="@mdo">Open modal for @mdo</button>

  <div class="modal fade" id="updateBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">New message</h4>
        </div>
        <div class="modal-body" id="updateModalBody">
          <!-- start modal body -->
          <div class="row">
            <div id="sp-component" class="col-sm-12 col-md-12">
              <div class="sp-column ">
                <div id="system-message-container" id="statusTextUpdateBrand"></div>
                <form method="post" id="userForm" onsubmit="updateBrand(event,this)" class="formResponsive" action="http://hypertester.ir/index.php?option=com_rsform&amp;view=rsform&amp;formId=62">
                  <h2>اصلاح پروفایل شرکت</h2>

                  <!-- Do not remove this ID, it is used to identify the page so that the pagination script can work correctly -->
                  <fieldset class="formHorizontal formContainer" id="rsform_62_page_0">
                    <div class="rsform-block rsform-block-companyname">
                      <div class="formControlLabel">نام شرکت<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody">
                          <input class="form-control" type="text" value="" size="20" name="CompanyName" id="CompanyName" class="rsform-input-box"><span class="formValidation"><span id="component130" class="formNoError">Invalid Input</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-brandname">
                      <div class="formControlLabel">نام برند<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody">
                          <input class="form-control" type="text" value="" maxlength="30" placeholder="نام برند را وارد کنید" name="brandname" id="brandname" class="rsform-input-box"><span class="formValidation"><span id="component131" class="formNoError">Invalid Input</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-ownername">
                      <div class="formControlLabel">نام و نام خانوادگی مدیر شرکت<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody">
                          <input class="form-control" type="text" value="" maxlength="30" name="OwnerName" id="OwnerName" class="rsform-input-box"><span class="formValidation"><span id="component128" class="formNoError">Invalid Input</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-mobilephone">
                      <div class="formControlLabel">تلفن همراه مدیر شرکت<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody">
                          <input class="form-control" type="tel" value="" maxlength="11" name="MobilePhone" id="MobilePhone" class="rsform-input-box"><span class="formValidation"><span id="component135" class="formNoError">شماره وارد شده صحیح نمی باشد</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-phone">
                      <div class="formControlLabel">تلفن شرکت</div>
                      <div class="formControls">
                        <div class="formBody">
                          <input class="form-control" type="tel" value="" maxlength="11" name="phone" id="phone" class="rsform-input-box"><span class="formValidation"><span id="component133" class="formNoError">شماره وارد شده صحیح نمی باشد</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    <div class="rsform-block rsform-block-address">
                      <div class="formControlLabel">آدرس شرکت<strong class="formRequired">(*)</strong></div>
                      <div class="formControls">
                        <div class="formBody">
                          <textarea  class="form-control" cols="50" rows="5" name="Address" id="Address" class="rsform-text-box"></textarea><span class="formValidation"><span id="component136" class="formNoError">Invalid Input</span></span></div>
                        <p class="formDescription"></p>
                      </div>
                    </div>
                    
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
          
          <!-- end modal body -->
        </div>
        <div class="modal-footer row justify-content-center">
          <div class="col-xs-12">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن</button>
            <button type="button" onclick="updateBrand(event,this)"  id="next" class="rsform-submit-button btn btn-primary">بعدی </button>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end show modal -->


  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerStores">

  </div>
</div>

<div id="brands" class="tabcontent">

  <!--add new brand  -->
  <!-- Button trigger modal -->
  <a href="http://hypertester.ir/index.php?option=com_rsform&view=rsform&formId=65" class="btn btn-primary">
    اظافه کردن شرکت جدید
  </a>

  <!-- end add new brand -->

  <div style="display: flex;flex-direction: row;flex-wrap: wrap;" id="containerBrands">
  </div>
</div>

<script>
  //default brand offset
  var brandCount = 0;

  //default store offset
  var storeCount = 0;

  showTab(event, 'brands', document.querySelector('#brands'))

  var saveBeforeTabElement = null;
  //old method
  function showTab(evt, cityName, button) {
    if (saveBeforeTabElement) {
      saveBeforeTabElement.classList.remove('active')
    }
    if (button) {
      button.classList.add('active')
      saveBeforeTabElement = button;
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
   * update one brand
   */
  function updateBrand(e,button){
    alert('is working')
    e.preventDefault();
    
    let data ={
      'CompanyName': document.querySelector('input[name="CompanyName"]').value,
      'brandname': document.querySelector('input[name="brandname"]').value,
      'OwnerName': document.querySelector('input[name="OwnerName"]').value,
      'MobilePhone': document.querySelector('input[name="MobilePhone"]').value,
      'phone': document.querySelector('input[name="phone"]').value,
      'Address': document.querySelector('textarea[name="Address"]').value
    };
        
    
    // let data = {
    //   'CompanyName': document.querySelector('input[name="CompanyName"]').value,
    //   'brandname': document.querySelector('input[name="brandname"]').value,
    //   'OwnerName': document.querySelector('input[name="OwnerName"]').value,
    //   'MobilePhone': document.querySelector('input[name="MobilePhone"]').value,
    //   'phone': document.querySelector('input[name="phone"]').value,
    //   'Address': document.querySelector('input[name="Address"]').value
    // };
    console.log(data)
    return;
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/index.php?option=com_rsform&view=rsform&formId=62",
      method: "POST",
      // data: JSON.stringify(data),
      // dataType: "json",
      // contentType: "application/json",
      data: data,
      success: function(data) {
        let alert;
         let newModalBody = `
          <div class="row"><div id="sp-component" class="col-sm-12 col-md-12"><div class="sp-column "><div id="system-message-container">
            </div>
          <form method="post" id="userForm" class="formResponsive" action="http://hypertester.ir/index.php?option=com_rsform&amp;view=rsform&amp;formId=82"><h2>تایید پیامکی اطلاعات شرکت</h2>

          <!-- Do not remove this ID, it is used to identify the page so that the pagination script can work correctly -->
          <fieldset class="formHorizontal formContainer" id="rsform_82_page_0">
            <div class="rsform-block rsform-block-header5">
                <div class="formBody">اطلاعات شما در سامانه درج گردید . برای تایید نهایی کد رهگیری ارسال شده به تلفن همراه خود را در کادر زیر وارد نمایید</div>
            </div>
            <div class="rsform-block rsform-block-regcode">
            <div class="formControlLabel">کد رهگیری</div>
              <div class="formControls">
                <div class="formBody"><input type="number" value="" placeholder="کد رهگیری خود را وارد نمایید" min="10000" max="99999" name="form[Regcode]" id="Regcode" class="rsform-input-box"><span class="formValidation"><span id="component81" class="formNoError">شماره وارد شده صحیح نمی باشد</span></span></div>
                <p class="formDescription"></p>
              </div>
            </div>
            <div class="rsform-block rsform-block-finish">
            <div class="formControlLabel"></div>
              <div class="formControls">
                <div class="formBody"><button type="submit" name="form[finish]" id="finish" class="rsform-submit-button">پایان</button><span class="formValidation"></span></div>
                <p class="formDescription"></p>
              </div>
            </div>
            <input type="hidden" name="form[checkRegcode]" id="checkRegcode" value="16241">
            <input type="hidden" name="form[UserId]" id="UserId" value="961">
            <input type="hidden" name="form[latitude]" id="latitude" value="">
            <input type="hidden" name="form[longitude]" id="longitude" value="">
            <input type="hidden" name="form[CompanyName]" id="CompanyName" value="برند 1 ">
            <input type="hidden" name="form[brandname]" id="brandname" value="برند 1 ">
            <input type="hidden" name="form[OwnerName]" id="OwnerName" value="بثشبثشبث">
            <input type="hidden" name="form[MobilePhone]" id="MobilePhone" value="24591681">
            <input type="hidden" name="form[map]" id="map" value="">
            <input type="hidden" name="form[phone]" id="phone" value="0">
            <input type="hidden" name="form[Address]" id="Address" value="بثشبثشبث">
            <input type="hidden" name="form[brandSelectedId]" id="brandSelectedId" value="129810">
          </fieldset>
          <input type="hidden" name="form[formId]" value="82"></form></div></div></div>
         `;

        if (data == 'notok') {
          //password is dublicate
          alert = `<div class="alert alert-danger modal-brand" role="alert">
           اطلاعات شما با خطا مواجه شد
          </div>`;
        } else if (data == 'exist') {
          //company is exist
          alert = `<div class="alert alert-danger modal-brand" role="alert">
           اطلاعات شما از قبل موجود هست
          </div>`;
        } else if ('ok') {
          // company registered
          alert = `<div class="alert alert-success modal-brand" role="alert">
           شرکت با موفقیت ثبت شد!
          </div>`;
        } else {
          //error accured on the server
          alert = `<div class="alert alert-danger modal-brand" role="alert">
            خطا در ذخیره ی اطلاعات!
          </div>`;
        }
        jQuery('#updateModalBody').remove();
        jQuery('#updateModalBody').append(alert)


      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }
</script>

{/source}