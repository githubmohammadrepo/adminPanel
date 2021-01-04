{source}
<script src="http://tabatabaee.info/scripts/map.js"></script>
<link href="http://tabatabaee.info/scripts/mapbox-gl.css" rel="stylesheet" />
<style>
  body { margin: 0; padding: 0; }
  #map{position: absolut;top:0;bottom:0;
   margin: auto !important;
   height: 300px;
    width: 80%;}

   .d-flex {
      display: flex !important;
   }

   .bg-danger {
      background-color: #ed146eb8 !important;
      color: white;
   }

   .bg-danger:hover {
      background-color: #ed146ed4 !important;
      color: white !important;
   }

   .p-0 {
      padding: 0 !important;
   }

   .p-0 i {
      font-size: 2rem !important;
   }

   .py-1 {
      padding-top: 4px !important;
      padding-bottom: 4px !important;
   }

   .storeAction {
      background-color: wheat;
   }

   .storeAction:hover {
      background-color: lightseagreen;
   }

   #MainModal {
      margin-top: 5px;
      z-index: 212;
      width: 100% !important;
      padding: 0 !important;
   }

   #MainModal .modal-dialog {
      width: 100%;
   }

   #MainModal .modal-dialog .modal-content {
      width: 100%;
   }

   .icons * {
      z-index: 1 !important;
   }
   .modal-header {
      display:flex;
      width:100%;
   }
   .mr-auto {
      margin-right: auto;
   }

   .m-auto{
      margin-left: auto;
      margin-right: auto;
   }

   .ml-auto{
      margin-left: auto;
   }
   .close {
      color: red !important;
      opacity: 1;
   }
   #formEditStore{
      direction: rtl;
   }

   #formEditStore .col-sm-10 {
      float: left !important;
   }
   .none {
      visibility: hidden !important;
      position: absolute;
   }
   .float-none{
      float:none;
   }
</style>
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

         <div class="prodBox" data-storeid = "<?php echo $store['markerid']; ?>" style="flex: 30%;text-decoration: none;margin: 5px;border: 1px solid #eeeeee;padding: 5px;border-radius: 5px">

            <div style="display: flex; flex-direction: column;justify-content: center;align-items: center;">
               <table class="table">
                  <tr>
                     <td>
                        <p style="display: inline;">نام فروشگاه:</p>
                     </td>
                     <td>
                        <p style="display: inline;font-weight: bold"><?= $store["ShopName"] ?></p>
                     </td>
                  </tr>

                  <tr>
                     <td>
                        <p style="display: inline;">مالک :</p>
                     </td>
                     <td>
                        <p style="display: inline;font-weight: bold"><?= $store["OwnerName"] ?></p>
                     </td>
                  </tr>

                  <?php if ($user->id != 0) { ?>
                     <tr>
                        <td>
                           <p style="display: inline;">تلفن:</p>
                        </td>
                        <td>
                           <p style="display: inline;font-weight: bold"><?= $store["MobilePhone"] ?></p>
                        </td>
                     </tr>
                  <?php } ?>

                  <tfoot>
                     <tr>
                        <td colspan="2">
                           <div class="btn-group d-flex" role="group" aria-label="Basic example" style="width:100%">
                              <a type="button" class="btn p-0 py-1 storeAction" title="نمایش روی نقشه" href="http://hypertester.ir/index.php?option=com_content&view=article&id=49&lat=<?= $store["latitude"] ?>&lng=<?= $store["longitude"] ?>&name=<?= $store["ShopName"] ?>" style="flex-grow: 1;">
                                 <i class="fa fa-map-marker " style="color:red"></i>
                              </a>
                              <button type="button" class="btn p-0 py-1 storeAction" title="ویرایش فروشگاه" onclick="editStore(event,<?php echo $store['markerid']; ?>)" style="flex-grow: 1;">
                                 <i class="fas fa-edit " style="color:lightskyblue"></i>
                              </button>

                              <button type="button" class="btn p-0 py-1 storeAction " title="نمایش محصولات" onclick="showProductsStore(event,<?php echo $store['markerid']; ?>)" style="flex-grow: 1;">
                                 <i class="fa fa-product-hunt teal-color "></i>
                              </button>
                              <button type="button" class="btn p-0 py-1 storeAction " title="حذف فروشگاه" onclick="removeOneStore(event,<?php echo $store['markerid']; ?>)" style="flex-grow: 1;">
                                 <i class="fa fa-remove " style="color:red"></i>
                              </button>
                           </div>
                        </td>
                     </tr>
                  </tfoot>
               </table>

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

   <!-- Large modal -->

   <div class="modal fade" id="MainModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="btn btn-primary ml-auto productBrands ml-auto">اظافه کردن محصول جدید</button>
               <h5 class="modal-title modal-title-text text-center m-auto">مصحولات برند</h5>
               <button type="button" class="mr-auto btn" style="color:red" onclick="closeModal('#MainModal')">×</button>
            </div>
            <div class="modal-body">
               <div class="row justify-content-center" id="modalbody">

               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" onclick="closeModal('#MainModal')">Close</button>
            </div>
         </div>
      </div>
   </div>
   <br>
   <br>
      <div id="map" class="map bg-secondary"/>
   <script>
      /**
       * define global valriables
       */
      var productStoreOffset = 0;

      /**
       * show detail store
       */
      function showMoreDetails(e, marketId) {
         e.preventDefault();
         console.log(marketId)
      }

      /**
       * show all product store with offset
       */
      function showProductsStore(e, store_id, type = null) {
         e.preventDefault()

         if (type == null) {
            productStoreOffset = 0;
         }
         jQuery('#MainModal').modal('show')
         //prepare data to send ajax
         var data = {
            store_id: store_id,
            offset: productStoreOffset,
            typeAction: "storeProduct"
         };

         //send ajax
         jQuery.ajax({
            url: "http://hypertester.ir/serverHypernetShowUnion/showStores.php",
            method: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
               console.log(data)
               //   start get product
               if (data.length) {
                  data.forEach(function(item, index) {
                     let product = '';

                     product += ` <div class="col-xs-6 col-md-4 col-lg-3 card-flex subbrand productBrands" data-productid="${item['product_id']}">
                     <div class="brandImage">
                     <img src="http://www.hypertester.ir/images/com_hikashop/upload/${item['file_path']}" class="img-product">
                     </div>
                     <a class="card-link" onclick="getSubBrands(event,${item['product_id']},'subbrand')" class="">
                     <p> ${item["product_name"]} </p>
                     </a>
                     
                     <table class="table">
                     <tbody>
                     <tr>
                    <td>قیمت محصول</td>
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
                
                </li>
                
                </ul>
                </div>`;
                     // jQuery('#modalbody').append(product)
                  if(index==0){
                     insertIntoModal(product,'محصولات فروشگاه',false);
                  }
                  insertIntoModal(product,'محصولات فروشگاه',true);
                  })
               } else {
                  alert('null');
               }
               // end get product
            },
            error: function(xhr) {
               console.log('error', xhr);

            }
         })
      }

      /**
       * remove on store 
       */
      function removeOneStore(event,store_id){
         var data = {
            store_id: store_id,
            typeAction: "delete"
         };

         //send ajax
         jQuery.ajax({
            url: "http://hypertester.ir/serverHypernetShowUnion/showStores.php",
            method: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
               console.log(data)
               if(data[0]==true){
                  removeOneElementFromDom(`div[data-storeid="${store_id}"`,'<h4 style="color:green;margin-top:30%">فروشگاه مورد نظر شما حذف شد</h4>')
               }else{
                  shwoFailAlert('.sp-column','<div class="alert alert-danger" role="alert">خظا در حذف فروشگاه مورد نظر</div>',null,true)
               }
            },
            error: function(xhr) {
               shwoFailAlert('.sp-column','<div class="alert alert-danger" role="alert">خظا در حذف فروشگاه مورد نظر</div>',null,true)
               console.log('error', xhr);
            }
         })
      }

      /**
       * insert into modal
       */
      function insertIntoModal(dataHtml,modalTitleText,append=false) {
         //remove before
         if(append==false){
            //append data html
            jQuery('#modalbody').html('')
         }
         jQuery('.modal-title-text').text('')
         jQuery('#modalbody').append(dataHtml)
         jQuery('.modal-title-text').text(modalTitleText)
         
         //show modal 
         jQuery('#MainModal').modal('show')
      }


      /**
       * edit one store
       */
      function editStore(event,store_id){
         //get store informations
         var data = {
            store_id: store_id,
            typeAction: "getOneStoreForUpdate"
         };

         //send ajax
         jQuery.ajax({
            url: "http://hypertester.ir/serverHypernetShowUnion/showStores.php",
            method: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
               console.log(data)
               if(data.store.length && data.province.length && data.city.length){
                  alert('yes')
                  //inject al data
                  //create modal form
                  let formModal = `
                     <div class="row justify-content-center">
                        <div class="col-sm-10 m-auto float-none">
                           <form class="form-horizontal" id="formEditStore">
                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ShopName" value="${data.store[0]['ShopName']}" id="ShopName" placeholder="نام فروشگاه">
                                 </div>
                                 <label for="ShopName" class="col-sm-2 control-label">نام فروشگاه</label>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="OwnerName" value="${data.store[0]['OwnerName']}" id="OwnerName" placeholder="نام صاحب فروشگاه">
                                 </div>
                                 <label for="OwnerName" class="col-sm-2 control-label">نام صاحب فروشگاه</label>

                              </div>

                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" value="${data.store[0]['phone']}" id="phone" name="phone" placeholder="نام صاحب فروشگاه">
                                 </div>
                                 <label for="phone" class="col-sm-2 control-label"> تلفن فروشگاه </label>

                              </div>

                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <select class="form-control" name="province" id="province" placeholder="نام استان">`;
                                       data.province.forEach(function(value,index){
                                          formModal+=`<option value="${value.id}" ${value.id==data.store[0].province ? 'selected' : ''}>${value.name}</option>`
                                       })
                                    formModal +=`</select>
                                 </div>
                                 <label for="province" class="col-sm-2 control-label">نام استان</label>

                              </div>
                              
                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <select class="form-control" name="city" id="city" placeholder="نام شهر">`;
                                       data.city.forEach(function(value,index){
                                          formModal+=`<option value="${value.id}" ${value.id==data.store[0].city ? 'selected' : ''}>${value['name']}</option>`
                                       })
                                    formModal+=`</select>
                                 </div>
                                 <label for="city" class="col-sm-2 control-label">نام شهر</label>

                              </div>

                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" name="MobilePhone" value="${data.store[0]['MobilePhone']}" id="MobilePhone" placeholder="نام صاحب فروشگاه">
                                 </div>
                                 <label for="MobilePhone" class="col-sm-2 control-label">شماره صاحب فروشگاه</label>
                              </div>
                              
                              
                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <textarea type="text" class="form-control" nmae="description" id="description" placeholder="توضیحات">${data.store[0]['description']}</textarea>
                                 </div>
                                 <label for="description" class="col-sm-2 control-label">شماره صاحب فروشگاه</label>
                              </div>
                              
                              
                              <div class="form-group">
                                 <div class="col-sm-offset-2 col-sm-10">
                                    <div>
                                    <label for="published">
                                       وضعیت فعال بودن فروشگاه
                                       </label>
                                       <input id="published" style="width:22px;height:22px" name="published" type="checkbox" ${data.store[0].published ? 'checked' : ''} class="form-control">
                                    </div>
                                 </div>
                              </div>


                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" id="lngCusLocation" name="lngCusLocation" value="51.39178988" placeholder="عرض جغرافیایی">
                                 </div>
                                 <label for="lngCusLocation" class="col-sm-2 control-label">طول جغرافیایی</label>
                              </div>



                              <div class="form-group">
                                 <div class="col-sm-10">
                                    <input type="text" class="form-control" id="latCusLocation" name="latCusLocation" value="51.39178988" placeholder="طول جغرافیایی">
                                 </div>
                                 <label for="latCusLocation" class="col-sm-2 control-label">عرض جغرافیایی</label>
                              </div>
                              
                              
                           </form>
                        </div>
                        <button type="button" onclick="updateStore(event,${store_id})" class="btn btn-primary">ذخیره</button>
                     </div>
                  `;
                  let modalTitleText = `اطلاح اطلاعات فروشگاه`
                  //show in modal
                  insertIntoModal(formModal,modalTitleText);
                  jQuery('#modalbody').append(jQuery('#map'));
                  document.querySelector('.map').classList.remove('none');
                  // document.querySelector('.mapboxgl-canvas').style.width="80%";
                  // document.querySelector('.mapboxgl-canvas').style.height="300px";


               }else{
                  alert('no')
                  shwoFailAlert('.sp-column','<div class="alert alert-danger" role="alert">خظا در حذف فروشگاه مورد نظر</div>',null,true)
               }
            },
            error: function(xhr) {
               alert('error')
               shwoFailAlert('.sp-column','<div class="alert alert-danger" role="alert">خظا در حذف فروشگاه مورد نظر</div>',null,true)
               console.log('error', xhr);
            }
         })

      }

      /**
       * remove one element by selector from dom
       */
      function removeOneElementFromDom(selector,htmlStatus=null,typeSelector=null){
         if(htmlStatus !=null){
            jQuery(selector).html(htmlStatus)
         }

         setTimeout(() => {
            jQuery(selector).remove()
         }, 2300);

      }

      /**
       * show fail alert
       */
      function shwoFailAlert(selector,message,before=null,after=null){
         if(before != null){
            jQuery(selector).before(message)
         }else if(after != null) {
            jQuery(selector).after(message)
         }else{
            jQuery(selector).html(message)
         }
      }


      /**
       * start show map on the page
       */
         function showMap(){
            var map = initMap('map');
            
            // Change Center
            map.setCenter([51.39, 35.70]); 
            
            //Add Custom Marker
            var icon = createIcon('http://tabatabaee.info/images/marker/marker-48.png',48,48);
            var marker = AddMarker(map,[51.39178988, 35.70056027],icon,true);
            function onDragEnd() 
            {
               var lngLat = marker.getLngLat();
               document.getElementById("lngCusLocation").value = lngLat.lng;
               document.getElementById("latCusLocation").value = lngLat.lat;
            }
            marker.on('dragend', onDragEnd);

            // make map to hide
            document.querySelector('#map').classList.add('none');
            alert('feafeyes')
         }
         showMap()
       /**
        * end show map on the page
        */


        /**
         * close modal by selector and append map to body
         */
        function closeModal(selector){
           jQuery(selector).modal('hide')
           jQuery('body').append(jQuery('#map'))
           document.querySelector('.map').classList.add('none');

        }

        /**
         * saved form update one store
         */
        function updateStore(e,store_id) {
           e.preventDefault();

           //remove from dom
           removeAllElementWithSelector('.spanError');
           //get data
            var data = {
               ShopName: document.querySelector('input[name="ShopName"]'),
               OwnerName: document.querySelector('input[name="OwnerName"]'),
               phone: document.querySelector('input[name="phone"]'),
               province: document.querySelector('input[name="province"]'),
               city: document.querySelector('input[name="city"]'),
               MobilePhone: document.querySelector('input[name="MobilePhone"]'),
               description: document.querySelector('input[name="description"]'),
               lngCusLocation: document.querySelector('input[name="lngCusLocation"]'),
               latCusLocation: document.querySelector('input[name="latCusLocation"]'),
               typeAction:'update'
            }
            console.log(data)

           //validate
            for (const key in data) {
               if (Object.hasOwnProperty.call(data, key)) {
                  const element = data[key];
                  if(element==null  || element.length==0){
                     jQuery('input[name="latCusLocation"]').parent().append('<span class="spanError" style="color:red">این فیلد نباید خالی باشد</span>')
                  }
               }
            }

           //send to save
             //send ajax
         jQuery.ajax({
            url: "http://hypertester.ir/serverHypernetShowUnion/showStores.php",
            method: "POST",
            data: JSON.stringify(data),
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
               console.log(data)
               //   start get product
               if (data[0]==true) {
                  let product = '<h5 style="color:green">محصول با موفقیت اطلاح شد</h5>';
                  // jQuery('#modalbody').append(product)
                  insertIntoModal(product,'',false);
               } else {
                  alert('null');
               }
               // end get product
            },
            error: function(xhr) {
               console.log('error', xhr);

            }
         })
           //show message or status message

           //update dom to updated data
        }

      /**
       * remove all element with selector
       */
      function removeAllElementWithSelector(selector){
         jQuery(selector).remove();
      }

        

   </script>
   {/source}