function mainJSONVendorParser(vendorList) {
    var obj = {};
    // var vendorList = newMainJSON['vendorList'];
    for (var i = 0; i < vendorList.length; i++) {
                var category = vendorList[i]['category']
                var vendArr = vendorList[i]['value'];
                //console.log(vendArr);
                for (var j = 0; j < vendArr.length; j++) {
                    var vid = vendArr[j]['vid'];
                    //console.log(vid);
                    var details = {};
                    //details['category'] = [];
                    var name = vendArr[j]['name'];
                    details['name'] = name;
                    //console.log(name);
                    var gender = vendArr[j]['gender'];
                    if (gender == null) {
                        details['gender'] = 'Not Specified'
                    }
                    else {
                        details['gender'] = gender;
                    }
                    var available = vendArr[j]['available'];
                    //console.log(gender);
                    details['available'] = available;
                    //console.log(available);
                    var picURL = vendArr[j]['pic'];
                    details['picURL'] = picURL;
                    //console.log(picURL);
                    details['category'] = categoryOfVendor(vid,vendorList);
                    obj[vid] = details;
                }
        }
    //console.log(obj);
    localStorage.setItem("vendorList",JSON.stringify(obj));
    vendorInjector();
}

function categoryOfVendor(vid,vendorList){
    categories = [];
    // var vendorList = newMainJSON['vendorList'];
    for (var i = 0; i < vendorList.length; i++) {
                var category = vendorList[i]['category'];
                //console.log(category);
                var vendArr = vendorList[i]['value'];
                for (var j = 0; j < vendArr.length; j++) {
                    var vidx = vendArr[j]['vid'];
                    if(vidx == vid){
                        categories.push(category);
                    }
                }
    }
    return (categories);

}
