function mainJSONParser() {
  console.log("hi");
    var productList = mainJSON['ProductList'];
    var products = {};
    for (var i = 0; i < productList.length; i++) {
        //var productId = productId[i]['productID'];
        var product = productList[i]['product'];
        var values = productList[i]['values'];
        var catItem = {};

        for (var j = 0; j < values.length; j++) {
            //if (categoryId == values[j]['categoryId']) {
                var categoryName = values[j]['categoryName'];
                var categoryId = values[j]['categoryId'];
                //console.log(categoryName);
                var subCat = values[j]['subcat'];
                var item = {};
                var names = [];
                var sids = [];
                for (var k = 0; k < subCat.length; k++) {
                    var sid = subCat[k]['sid'];
                    sids.push(sid);
                    var obj = vegnmListParser();
                    var name = obj[sid][0];
                    var IncrimentRate = subCat[k]['IncrimentRate'];
                    var price = subCat[k]['price'];
                    names.push(name);
                    item[sid] = [];
                    Array.prototype.push.apply(item[sid], [name,IncrimentRate,price]);
                    //console.log(name);
                    catItem[categoryId] = item;
                }
                //console.log(names);
            //}
        }
        var catVendors = {};
        var vendors = productList[i]['vendorList'];
        mainJSONVendorParser(vendors);
        for (var l = 0; l < vendors.length; l++) {
            // if (categoryId == vendors[l]['categoryId']) {
                var categoryName = vendors[l]['categoryName'];
                var categoryId = vendors[l]['categoryId'];
                var vend = vendors[l]['value'];
                var vendorDet = {};
                for (var m = 0; m < vend.length; m++) {
                    var vid = vend[m]['vid'];
                    var vname = vend[m]['name'];
                    var vgender = vend[m]['gender'] || 'Not Specified';
                    var vpicURL = vend[m]['pic'];
                    //console.log(vname);
                    vendorDet[vid] = [];

                    Array.prototype.push.apply(vendorDet[vid], [vname,vgender,vpicURL]);
                    catVendors[categoryId] = vendorDet;
                }

            // }
        }
        //console.log(catVendors);
        localStorage.setItem('catVendors',JSON.stringify(catVendors));
        //console.log(catItem);

    }
    randomVendorSelector();
}
