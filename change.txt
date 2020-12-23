{source}
  <style>
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
      max-width: 29.3rem  !important;
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
      margin-top: 40px;
    }

    .modal-header {
      display: flex;
    }

    .modal-header .close {
      margin-right: auto;
    }

    .text-light,.text-white{
      color:white;
    }
    .icons {
      position: relative;
      z-index: 1;
    }
    #myModal {
      margin-top:40px;
      width:100% !important;
    }
    #myModal  .modal-dialog {
      width:100% !important;
    }

    #myModal  .modal-body {
      display: flex;
      flex-wrap: wrap;
    }
    .img-brand,.img-product,.img-subbrand {
      height: 250px;
      width: 100%;
    }
    .card-link{
      margin-top: -45px;
    }
    .editProductModal {
      top: 42px;
      display: block;
      margin-top: 50px;
      justify-content: center;
      width: 80%;
      margin: auto;
      z-index: 1024;
    }
    .w-75 {
      width:75% !important;
    }
    .w-100{
      width:100%;
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
            <h4 class="modal-title text-center" id="exampleModalLabel">New message</h4>
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
                            <textarea class="form-control" cols="50" rows="5" name="Address" id="Address" class="rsform-text-box"></textarea><span class="formValidation"><span id="component136" class="formNoError">Invalid Input</span></span></div>
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
              <button type="button" onclick="updateBrand(event,this)" id="next" class="rsform-submit-button btn btn-primary">بعدی </button>
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
    var subbrandCount = 0;
    var beforeCategoryId= {before:0,current:0};
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
        getAllBrands();
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
    function getAllBrands(type = null) {
      jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, 400);

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
            <img src="http://www.hypertester.ir/images/com_hikashop/upload/${item['brand_image']}" class="img-brand" >
            </div>
            <a class="card-link" onclick="getSubBrands(event,${item['category_id']},'subbrand')" class="">
              <p> ${item["category_name"]} </p>
            </a>
            <ul class="nav justify-content-end " style="display:flex">
          <li class="nav-item" >
            <a class="nav-link active" href="#">ویرایش</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">حذف</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  onclick="showProducts(event,${item['category_id']})"> محصولات</a>
          </li>
          
        </ul>
          </div>`;
            jQuery('#containerBrands').append(brand)


          })
          //add button moreStore
          let moreStore = `<div class="row justify-content-center moreShow brand moreBrnadButton">
            <div class="col-xs-12 text-center">
              <button onclick="getAllBrands('more')" class="btn btn-primary">پیشنهاد فروشگاه بیشتر</button>
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
    function updateBrand(e, button) {
      e.preventDefault();

      let data = {
        'CompanyName': document.querySelector('input[name="CompanyName"]').value,
        'brandname': document.querySelector('input[name="brandname"]').value,
        'OwnerName': document.querySelector('input[name="OwnerName"]').value,
        'MobilePhone': document.querySelector('input[name="MobilePhone"]').value,
        'phone': document.querySelector('input[name="phone"]').value,
        'Address': document.querySelector('textarea[name="Address"]').value
      };

      console.log(data)
      // sent ajax request
      jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/EditInfoBrand.php",
        method: "POST",
        // data: JSON.stringify(data),
        // dataType: "json",
        // contentType: "application/json",
        data: data,
        success: function(data) {
          console.log('result')
          console.log(data)
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
          jQuery('#updateModalBody').html("");
          jQuery('#updateModalBody').append(alert)
          jQuery('#updateModalBody').append(newModalBody)


        },
        error: function(xhr) {
          console.log('error', xhr);

        }
      })
    }

    /**
     * update one brand
     */
    function getSubBrands(e, category_id,brandType, type = null) {
      jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, 400);

      e.preventDefault();
      if(brandType=='brand'){
        jQuery('.brand').remove()
        jQuery('.subbrand').remove()
        getAllBrands();
        return;
      }
      if (type == null) {
        jQuery('.brand').remove()
        jQuery('.subbrand').remove()
        subbrandCount = 0;
        if(beforeCategoryId.current ==0){
          beforeCategoryId.current = category_id;
        }
        beforeCategoryId.before = beforeCategoryId.current;
        beforeCategoryId.current = category_id;
        
       

      }
      // sent ajax request
      var data = {
        offset: subbrandCount,
        typeAction: "subSelect",
        category_parent_id: category_id
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
          if (data.length) {
            data.forEach(function(item, index) {
              let subbrand = '';
              subbrand += ` <div class="card-flex subbrand" >
              <div class="brandImage">
              <img src="http://www.hypertester.ir/images/com_hikashop/upload/${item['brand_image']}" class="img-subbrand">
              </div>
              <a class="card-link" onclick="getSubBrands(event,${item['category_id']},'subbrand')" class="">
                <p> ${item["category_name"]} </p>
              </a>
              <ul class="nav justify-content-end " style="display:flex">
          <li class="nav-item" >
            <a class="nav-link active" href="#">ویرایش</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">حذف</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="showProducts(event,${item['category_id']})" href="#"> محصولات</a>
          </li>
          
        </ul>
            </div>`;
              jQuery('#containerBrands').append(subbrand)

            })
          } else {
            jQuery('.subBrandBack').remove();
            let subbrand = '';
            subbrand += `<div class="card-flex subbrand brand subBrandBack" >
          <div class="brandImage">
            <p class="text-light">برندی یافت نشد</p>
          </div>
            <a class="card-link" onclick="getSubBrands(event,${beforeCategoryId.before},'brand')" class="">
              <p class="text-light"> برگشت به عقب </p>
            </a>
          </div>`;
          if(jQuery('#containerBrands').children().length){

          }else{
            jQuery('#containerBrands').append(subbrand)

          }

          }
          //add button moreStore
          let moreStore = `<div class="row justify-content-center moreShow subbrand brand moresubBrnadButton">
            <div class="col-xs-12 text-center">
              <button onclick="getSubBrands(event,${category_id},'subbrand','more')" class="btn btn-primary">پیشنهاد فروشگاه بیشتر</button>
            </div>
          </div>`;
          
          if (type != "more" && subbrandCount == 0) {
            jQuery('#containerBrands').after(moreStore)
          }
          if (data.length == 0) {
            jQuery('.moresubBrnadButton').remove()
          }

          subbrandCount += 10;
        },
        error: function(xhr) {
          console.log('error', xhr);

        }
      })
    }


  /**
   * show brands product
   */
  function showProducts(e,category_id,type=null){
    e.preventDefault();
    //hide all
    // brandcontianer

    let modal = `
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn btn-primary m-auto productBrands">اظافه کردن محصول جدید</button>

                    <h5 class="modal-title w-100 text-center">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="productModalBody">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
              `;

      if(document.querySelectorAll('#myModal').length){
        jQuery('#productModalBody').html('')

      }else{
        jQuery('body').append(modal)
      }
      jQuery('#myModal').modal('show');

      // sent ajax request
    var data = {
      category_id: category_id
    };
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/GetBrandsProductsWhenClickedBrandsName1.php",
      method: "POST",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        console.log(data)
        if (data.length) {
          data.forEach(function(item, index) {
            let subbrand = '';
            
            subbrand += ` <div class="card-flex subbrand productBrands" style="max-width:270px" data-productId="${item['product_id']}">
            <div class="brandImage">
            <img src="${item['product_image']}" class="img-product">
            </div>
            <a class="card-link" onclick="getSubBrands(event,${item['product_id']},'subbrand')" class="">
              <p> ${item["product_name"]} </p>
            </a>

              <table class="table" style="color:white">
                <tbody>
                  <tr>
                    <td>قسمت محصول</td>
                    <td>${item['product_price_percentage']}</td>
                  </tr>
                  <tr>
                    <td>کد محصول</td>
                    <td>${item['product_code']}</td>
                  </tr>
                  <tr>
                    <td>آخرین بازدید</td>
                    <td>${item['product_last_seen_date']}</td>
                  <tr>
                  <tr>  
                    <td>شرکت سازنده</td>
                    <td>${item['category_name']}</td>
                  </tr>
                  <tr>
                    <td>واحد شمارش محصول</td>
                    <td>${item['product_counting_unit']}</td>
                  </tr>
                  <tr>
                    <td colspan="2">توضیحات محصول: ${item['product_description']}</td>
                  </tr>
                </tbody>
              </table>
            <ul class="nav justify-content-end " style="display:flex">
              <li class="nav-item" >
                <a class="nav-link active" 
                href="#" 
                onclick="editOneProduct(event,${item['product_id']},
                '${item['product_name'] ? item['product_name'] : -11}',
                '${item['product_counting_unit'] ? item['product_counting_unit'] : -11}',
                '${item['product_package_type'] ? item['product_package_type'] : -11}',
                '${item['product_weight'] ? item['product_weight'] : -11}',
                '${item['product_number_in_package'] ? item['product_number_in_package'] : -11}',
                '${item['product_delivery_time'] ? item['product_delivery_time'] : -11}',
                '${item['product_msrp'] ? item['product_msrp'] : -11}',
                '${item['product_sort_price'] ? item['product_sort_price'] : -11}',
                '${item['product_price_percentage'] ? item['product_price_percentage'] : -11}',
                '${item['product_sale_type'] ? item['product_sale_type'] : -11 }')" 
                 data-productId="${item['product_id']}"  >ویرایش</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="removeOneProduct(event,${item['product_id']})">حذف</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"  onclick="showProducts(event,${item['category_id']})" > محصولات</a>
                <a data-dismiss="modal" data-toggle="modal" href="#editProductModal">Click</a>

              </li>
              
            </ul>
          </div>`;
            jQuery('#productModalBody').append(subbrand)

          })
        } else {
          jQuery('.subBrandBack').remove();
          let subbrand = '';
          subbrand += `<div class="card-flex subbrand brand subBrandBack" >
        <div class="brandImage">
          <p class="text-light">برندی یافت نشد</p>
        </div>
          <a class="card-link" onclick="getSubBrands(event,${beforeCategoryId.before},'brand')" class="">
            <p class="text-light"> برگشت به عقب </p>
          </a>
        </div>`;
        if(jQuery('#productModalBody').children().length){

        }else{
          jQuery('#productModalBody').append(subbrand)

        }

        }
        //add button moreStore
        let moreStore = `<div class="row justify-content-center moreShow subbrand brand moresubBrnadButton">
          <div class="col-xs-12 text-center">
            <button onclick="getSubBrands(event,${category_id},'subbrand','more')" class="btn btn-primary">پیشنهاد فروشگاه بیشتر</button>
          </div>
        </div>`;
        
        if (type != "more" && subbrandCount == 0) {
          jQuery('#containerBrands').after(moreStore)
        }
        if (data.length == 0) {
          jQuery('.moresubBrnadButton').remove()
        }

        subbrandCount += 10;
      removeSlasheImageSrc('.img-product')

      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })

  }

  /**
   * function remove slashes from subbrand src image
   */
  function removeSlasheImageSrc(className){
    let el = document.querySelectorAll(className);
    if(el.length){
      el.forEach(function(value,index){
        value.src = value.src.replace('http://hypertester.ir/','')
      })
    }
  }


  /**
   * editOneProduct(event,54323)
   */
  function editOneProduct(
    e,
    product_id,
    productName,
    productUnit,
    productPackageType,
    productWeight,
    productCountInPackage,
    productDeliverTime,
    productConsumerRate,
    productMarketRate,
    productSaleType) {
    e.preventDefault();
    let productBrands = document.querySelectorAll('.modal-body .productBrands');
    if(productBrands.length){
      productBrands.forEach(function(value,index){
        value.style.display = 'none';
      })
    }
    //hide all
    if(document.querySelectorAll('.editProductModal').length){
      document.querySelector('.editProductModal').remove();
    }
    // add new modal product
    let editModal = `
      <form method="post" id="insert_form" onsubmit ="editOneProductSentAjax(event,'${product_id}','${productName}','${productUnit}','${productPackageType}','${productWeight}','${productCountInPackage}','${productDeliverTime}','${productConsumerRate}','${productMarketRate}','${productSaleType}')" class="editProductModal">
          <label>نام محصول را وارد نمایید</label>
          <input type="text" name="name" value="${productName}" id="name" class="form-control">
          
          <label>واحد شمارش محصول چیست؟</label>
          <textarea type="text" name="counting" id="counting" class="form-control"> ${productUnit}</textarea>
          
          <label>نوع بسته بندی</label>
          <input type="text" name="packagetype" value="${productPackageType}" id="packagetype" class="form-control">
          
          <label>وزن بسته</label>
          <input type="text" name="weight" value="${productWeight}" id="weight" class="form-control">
          
          <label>تعداد در بسته</label>
          <input type="text" name="numberinpackage" value="${productCountInPackage}" id="numberinpackage" class="form-control">
          
          <label>مدت زمان تحویل</label>
          <input type="text" name="deliverytime" value="${productDeliverTime}" id="deliverytime" class="form-control">
          
          <label>نرخ مصرف کننده</label>
          <input type="text" name="msrp" id="msrp" value="${productConsumerRate}" class="form-control">
          
          <label>نرخ سوپرمارکت</label>
          <input type="text" name="sortprice" id="sortprice" value="${productMarketRate}" class="form-control">
          
          <label>نحوه تسویه حساب</label>
          <input type="text" name="saletype" value="${productSaleType}" id="saletype" class="form-control">
          
          <input type="hidden" name="product_id"  id="product_id" value="${product_id}">
          <input type="submit" name="insert" id="insert" value="Update" onclick="editOneProductSentAjax(event,'${product_id}','${productName}','${productUnit}','${productPackageType}','${productWeight}','${productCountInPackage}','${productDeliverTime}','${productConsumerRate}','${productMarketRate}','${productSaleType}')" class="btn btn-success">
      </form>
    `;


    jQuery('#myModal .modal-dialog .modal-content .modal-body').append(editModal)
    jQuery('#myModal').modal('show')
    
  }


  /**
   * save update product info
   */
  function editOneProductSentAjax(e,
    product_id,  
    productName,
    productUnit,
    productPackageType,
    productWeight,
    productCountInPackage,
    productDeliverTime,
    productConsumerRate,
    productMarketRate,
    productSaleType
    ) {
      e.preventDefault();
      jQuery('.updateProductINfo').remove();
    // sent ajax request
    var data = {
      product_id: product_id,
      name:document.querySelector('input[name="name"]').value,
      counting :document.querySelector('textarea[name="counting"]').value,
      packagetype :document.querySelector('input[name="packagetype"]').value,
      weight :document.querySelector('input[name="weight"]').value,
      numberinpackage :document.querySelector('input[name="numberinpackage"]').value,
      deliverytime :document.querySelector('input[name="deliverytime"]').value,
      msrp :document.querySelector('input[name="msrp"]').value,
      sortprice :document.querySelector('input[name="sortprice"]').value,
      saletype :document.querySelector('input[name="saletype"]').value,
      typeAction:'edit'
    };
    console.log(data)
    
    // display alert
    let alert= `<div class="alert alert-danger updateProductINfo modal-brand text-center" role="alert">
    اطلاعات شما از قبل موجود هست
    </div>`;
    if(data.product_id=='-11' || data.name=='-11' || data.counting=='-11' || data.packagetype=='-11' || data.weight=='-11' || data.numberinpackage=='-11' || data.deliverytime=='-11' || data.msrp=='-11' || data.saletype=='-11') {
      jQuery('.modal-header').after(alert);
    }
    
    // let product_id = document.querySelector('input[name="product_id"]').value;
    
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/productShow.php",
      method: "POST",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        if(data[0]){
          jQuery('.editProductModal').html(`<div class="alert alert-success updateProductINfo modal-brand text-center" role="alert">محصول شما با موفقیت اپدیت شد</div>`)
          setTimeout(() => {
              
              let productBrands = document.querySelectorAll('.modal-body .productBrands');
              if(productBrands.length){
                productBrands.forEach(function(value,index){
                  value.style.display = 'block';
                })
              }
              //hide all
              if(document.querySelectorAll('.editProductModal').length){
                document.querySelector('.editProductModal').remove();
              }
              jQuery('#myModal').modal('show')

            }, 3000);
        }else{
          jQuery('.modal-header').after(`<div class="alert alert-danger updateProductINfo modal-brand text-center" role="alert">
    اطلاعات شما از قبل موجود هست
    </div>`);

        }
        
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }

  /**
   * removeOneProduct(event,54323)
   */
  function removeOneProduct(e,product_id) {
    e.preventDefault();
    //hide all
    // brandcontianer

    // sent ajax request
    var data = {
      product_id: product_id,
      typeAction:'delete'
    };
    // sent ajax request
    jQuery.ajax({
      url: "http://hypertester.ir/serverHypernetShowUnion/productShow.php",
      method: "POST",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        if(data[0]==true){
          let el =document.querySelector('div[data-productId="'+product_id+'"]');
          el.innerHTML = `<h2>محصول مورد نظر حذف شد</h2>`
          el.style.color = "white"
          setTimeout(() => {
            document.querySelector('div[data-productId="'+product_id+'"]').remove()
            
          }, 3500);
          //append alert to modal header
        }
        
      },
      error: function(xhr) {
        console.log('error', xhr);

      }
    })
  }
  </script>

  {/source}