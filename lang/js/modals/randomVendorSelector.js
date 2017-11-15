function randomVendorSelector() {
  var catVendors = JSON.parse(localStorage.getItem('catVendors'));
  var randVend = {};
  for (var catID in catVendors) {
    //console.log("catID");
    if (catVendors.hasOwnProperty(catID)) {

      var vendors = catVendors[catID];
      var prop = pickRandomProperty(vendors);
      //console.log(prop);
      var randVend = vendors[prop];
      //console.log(randVend);
    }
  }

}


function pickRandomProperty(obj) {
    var result;
    var count = 0;
    for (var prop in obj)
        if (obj.hasOwnProperty(prop)) {
          if (Math.random() < 1/++count)
             result = prop;
        }
    return result;
}
