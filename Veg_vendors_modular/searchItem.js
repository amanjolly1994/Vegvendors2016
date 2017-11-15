function searchItem(value) {
    //console.log("######################");
    value = value.toLowerCase();
    $('#search-items-here').empty();
    var obj = vegnmListParser();
    var sabziImgurl = "http://vegvendors.in/" + newMainJSON['sabziImgurl'];
    var productList = newMainJSON['ProductList'];
    for (var i = 0; i < productList.length; i++) {
        var values = productList[i]['values'];
        var type = productList[i]['productList'];
        for (var j = 0; j < values.length; j++) {
            var category = values[j]['categoryName'];
            var categoryID = values[j]['categoryID'];
            var subcat = values[j]['subcat'];


            for (var k = 0; k < subcat.length; k++) {
                var name;
                var vegId;
                var incrementRates;
                var price;
                var url;
                var sid = subcat[k]['sid'];
                //console.log('******************');
                //searchString.search
                //console.log(name);
                var incrementRate = subcat[k]['IncrimentRate'];
                //console.log(incrimentRate);
                var price = subcat[k]['price'];
                //console.log(price);
                var url = sabziImgurl + '/' + sid + '.gif';
                //console.log(sid);
                var name = obj[sid][0];
                var hinglish = obj[sid][1];
                var hindiName = obj[sid][2].join(' ');
                var searchString = name + ' ' + hinglish + ' ' + hindiName;
                searchString = searchString.toLowerCase();
                //console.log("*************");

                var re = new RegExp(value,'g');
                try {
                    if (searchString.match(re) != null || searchString.match(re).length > 0) {
                        //console.log(searchString);
                        insertSearchDiv(categoryID,sid,name,price,incrementRate,url);
                        if (value == '') {
                            $('#search-items-here').empty();
                        }
                    }
                } catch (e) {

                } finally {

                }

            }
        }
    }
}
