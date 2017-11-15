function makeVegArray(catItem,flag) {
  var baseURI = "localhost/" + mainJSON['sabziImgurl'];
  var names = [];
  var sids = [];
  var urls = [];
  var prices = [];
  var incrementRates = [];

  if (flag == 1) {  //inject in quickbuy
    var items = catItem['1'];
    for (var sid in items) {
      if (items.hasOwnProperty(sid)) {
        sids.push(sid);
        prices.push(items[sid][2]);  //price index
        incrementRates.push(items[sid][1]); //incrementRates index
        names.push(items[sid][0]); //names index
        urls.push(baseURI + '/' + sid + '.gif');
        itemInjector1(1,sids,names,prices,incrementRates,urls);
      }
    }
  }
}

function itemInjector1(categoryID,itemIds,vegNames,prices,incrementRates,urls) {   //type argument to be passed

    // var category = $("#category").clone(true);
    // category.attr({
    //     'id': ("category" + categoryName.replace(/\s/g,"")),
    //     'name': categoryName,
    //     'categoryID' : "category" + categoryID
    // });
    // category.find('#categoryName').text(categoryName);

    // for (var i = 0; i < itemIds.length; i++) {
    //     //console.log("injecting New values");
    //     var item = $("#item").clone(true);
    //     if( localStorage.getItem(itemIds[i]) == null){
    //         totalWeight = 0;
    //     }
    //     else {
    //         totalWeight = localStorage.getItem(itemIds[i]).split(",")[1];
    //     }

        //console.log(totalWeight);
        //console.log(vegNames[i]);
        //console.log(itemIds[i]);
        //console.log(prices[i]);
        //console.log(incrementRates[i]);
        //totalweight = localStorage.getItem(itemIds[i]).split(",")[1] || 0;

        // item.attr({
        //     "id": ("item" + itemIds[i]),
        //     "name": vegNames[i],
        //     "sid": itemIds[i],
        //     "value":incrementRates[i],
        //     "price":prices[i],
        //     "totalweight":totalWeight,
        //     "categoryID": "item" + categoryID
        // });
        item.find('#add-to-cart').attr({
          id : ('add-to-cart' + itemIds[i]),
          data-image : urls[i],
          data-name : vegNames[i],
          data-rate : incrementRates[i],
          data-price : prices[i],
          data-category : categoryID
        });
        item.find('img').attr({
            "id": ("img" + itemIds[i]),
            "src": urls[i]
        });
        item.find('#offer-box-div').addClass(vegNames[i]).attr('id', ('offer-box-div' + itemIds[i]));

        item.find('#name-item').attr("id", (("name-item") + itemIds[i])).text(vegNames[i]);
        item.find('#price-item').attr("id", (("price-item") + itemIds[i])).text(prices[i]);
        // item.find('#details').attr('id',('details' + itemIds[i]));
        // item.find('#show-value').attr('id',('show-value' + itemIds[i]));
        // item.find('#add-finally').attr('id',('add-finally' + itemIds[i]));
        // item.find('#add-item').attr('id',('add-item' + itemIds[i]));
        // item.find('#subtract-item').attr('id',('subtract-item' + itemIds[i]));

        item.removeClass('dummy');

        // var stamp = $("#stamp").clone(true);
        // stamp.attr("id",("stamp" + itemIds[i]));
        // stamp.removeClass('dummy')
        // stamp.insertBefore(item.find("#insert-stamp-before-here"));

        // if ($('#item' + itemIds[i]).length != 0) {
        //     //console.log(item);
        //     //console.log($('#item' + itemIds[i]));
        //     item.replaceWith(category.find('#item' + itemIds[i]));
        //
        // }
        //  else {
        //      item.appendTo(category.find('#items-container'));
        // }
        item.appendTo(category.find('#items-container')); //to be changed
    }
    // category.removeClass('dummy');
    // if ($('#category' + categoryName.replace(/\s/g,"")).length == 0) {
    //     category.insertBefore('#category-before-here');
    // }
    // else {
    //
    //     //console.log($('#category' + categoryName.replace(/\s/g,"")));
    //     //category.attr('id',"hi");
    //     //console.log(category.attr('id'));
    //     //category.replaceWith($('#category' + categoryName.replace(/\s/g,"")));
    //     $('#category' + categoryName.replace(/\s/g,"")).replaceWith(category);
    // }
// loadFromStorage();         //INfinite LOOP
}
