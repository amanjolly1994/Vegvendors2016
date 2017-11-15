//function mainProductParser() {
function JSONparserFromSabziListCumCombiner() {
    //console.log(newMainJSON);
    var sabziImgurl = "http://vegvendors.in/" + newMainJSON['sabziImgurl'];
    var obj = vegnmListParser();
    // var productObj = {};
    var productList = newMainJSON['ProductList'];
    for (var i = 0; i < productList.length; i++) {
        var productID = i + 1;                       //product id to be extracted from json
        var values = productList[i]['values'];
        var type = productList[i]['productList'];
        var vendorList = productList[i]['vendorList'];
        mainJSONVendorParser(vendorList);
        // catObj = {};
        for (var j = 0; j < values.length; j++) {
            var category = values[j]['categoryName'];
            var categoryID = values[j]['categoryId'];
            /*****************Injecting category name***************************/
                               categoryInjector(category);       //categoryInjector(type,category);
            /******************************************************************/
            var subcat = values[j]['subcat'];

            /***********var itemDetails = {};***********/

            var names = [];
            var urls = [];
            var incrementRates = [];
            var prices = [];
            var sids = [];
            for (var k = 0; k < subcat.length; k++) {
                var name;
                var vegId;
                var incrementRates;
                var price;
                var url;
                var sid = subcat[k]['sid'];
                //console.log(sid);
                var name = obj[sid][0];
                //console.log(name);
                var incrementRate = subcat[k]['IncrimentRate'];
                //console.log(incrimentRate);
                var price = subcat[k]['price'];
                //console.log(price);
                var url = sabziImgurl + '/' + sid + '.gif';

                names.push(name);
                urls.push(url);
                prices.push(price);
                incrementRates.push(incrementRate);
                sids.push(sid);
            }
            //console.log(incrementRates);
            //console.log(categoryID);
            hoverItemsInjector(category,categoryID,names,sids); //hoverItemsInjector(type,category,names);                   //inject items in sub menu
            itemInjector(category,sids,names,prices,incrementRates,urls);  //itemInjector(type,category,sids,names,prices,incrementRates,urls); //inject vegetables in main page
        }
    }
}


// function JSONparserFromSabziListCumCombiner() {                  //main function
//
//m
//
//
//     var sz1 = sabziList['sabziList'];
//     //console.log(sz1);
//     for (var i = 0; i < sz1.length; i++) {
//         //console.log(sz1[i]);
//         //console.log(i);
//          var sz2 = sz1[i];
//         for (var prop2 in sz2) {
//             if (sz2.hasOwnProperty(prop2)) {
//                 //console.log(prop2);
//                 var category;
//                 category = prop2;
//
//                 /*****************Injecting category name***************************/
//                     categoryInjector(category);
//                 /******************************************************************/
//
//
//                 //console.log(sz2[prop2]);
//                 var sz3 = sz2[prop2];
//
//
//
//                 var names = [];
//                 var urls = [];
//                 var incrementRates = [];
//                 var prices = [];
//                 var sids = [];
//                 for (var j = 0; j < sz3.length; j++) {
                    // var name;
                    // var vegId;
                    // var incrementRate;
                    // var price;
//                     var url = "http://vegvendors.in/android/sabzi-pics/";
//                     //console.log(sz3[j]);
//                     //console.log(j);
//                     //console.log(category);
//
//                     sid = sz3[j]['sid'];
//                     //console.log(sid);
//                     name = JSONparserFromVegnmList(sid);              //getting name by sid
//                     //console.log(name);
//                     incrementRate = sz3[j]['IncrimentRate'];
//                     //console.log(incrementRate);
//                     price = sz3[j]['price'];
//                     //console.log(price);
//                     url = url + sid + ".gif";
//
                    // names.push(name);
                    // urls.push(url);
                    // prices.push(price);
                    // incrementRates.push(incrementRate);
                    // sids.push(sid);
//
//
//                     //console.log(url);
//                     //listItemsInjector(category,name)                 //important
//                 }
                // hoverItemsInjector(category,names);                   //inject items in sub menu
                // vegInjector(category,sids,names,prices,incrementRates,urls); //inject vegetablesin main page
//             }
//         }
//     }
// }
//
// function JSONparserFromVegnmList(x) {
//     //var mark = false;
//
//     for (var vegnmListItems in vegnmList['vegnmlist']){
//          var level1 = vegnmList['vegnmlist']
//          for (key1 in level1){                                                         //key1 is index of array
//              //console.log(key1);
//              //console.log(level1[key1]);
//              level2 = level1[key1]
//              for (key2 in level2){                                                    //object with key of object id
//                  if (level2.hasOwnProperty(key2)){
//                      //console.log("key2 = "+key2);
//                     // vegId = key2;
//                      /*sz1 = sabziList['sabziList'];
//                      for (var prop1 in sz1) {                       //going inside second json file
//                          //console.log(sz1[prop1]);
//                          var sz2 = sz1[prop1];
//                          for (var prop2 in sz2) {
//                              if (sz2.hasOwnProperty(prop2)) {
//                                  //console.log(prop2);
//                                  //console.log(sz2[prop2]);
//                                  category = prop2;
//                                  sz3 = sz2[prop2];                 //
//                                  for (var i = 0; i < sz3.length; i++) {
//                                      if(vegId == sz3[i]['sid']){
//                                          incrimentRate = sz3[i]['IncrimentRate'];
//                                          price = sz3[i]['price'];
//                                          mark = true;
//                                          break;
//                                      }
//                                  }
//                                  if (mark) {
//                                      break;
//                                  }
//                              }
//                              if (mark) {
//                                  break;
//                              }
//                          }
//                          if (mark) {
//                              break;
//                          }
//                      }*/
//                      //console.log(level2[key2]);
//                      if (x == key2) {
//                          level3 = level2[key2];                                           //inside the object[key2] which is an object 2
//                          for (var key3 in level3) {
//                              if (level3.hasOwnProperty(key3)) {
//                                  //console.log(key3);
//                                  //console.log(level3[key3]);
//                                  //console.log("name");
//                                  //console.log(level3[key3]['name']);
//                                  return(level3[key3]['name']);                    //key3 = 0;   //only one element array
//                                  }
//                              }
//                      }
//
//                      }
//                  }
//              }
//          }
// }
