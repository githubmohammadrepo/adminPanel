/**
   * section actions on stores
   */
  var storeCount =0;
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


  /**
   * section actions on brands
   */

  var brandCount =0;
  function getAllBrands(type=null){
      if(type==null){
        jQuery('.store').remove()
        storeCount=0
      }
    // sent ajax request
    var data = {
      offset:brandCount,
      typeAction:"select"
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