function vendorInjector() {
    var obj = JSON.parse(localStorage.getItem("vendorList"));
    //console.log(obj);
    for (var vendorID in obj) {
        if (obj.hasOwnProperty(vendorID)) {
            element = $("#vendor").clone(true);
            var name = obj[vendorID]['name'];
            var avail;
            //console.log(name);
            if (obj[vendorID]['available'] == 1) {
                avail = 'Available';
            }
            else {
                avail = 'Not Available';
            }
            //console.log(avail);
            var url = "http://vegvendors.in/" + obj[vendorID]['picURL'];
            //console.log(url);
            var categories = obj[vendorID].category.join(", ");
            //var gender = obj[vendorID]['gender'] || 'Not Specified';    To be not shown

            //Now adding to webpage
            element.find('#vendor-img').attr('src',url).attr('id',('vendor-img' + vendorID));
            element.find('#vendor-name').text(name).attr('id',('vendor-name' + vendorID));
            element.find('#vendor-id').attr('id',('vendor-id' + vendorID)).text('ID:' + vendorID);
            element.find('#vendor-categories').text(categories).attr('id',('vendor-categories' + vendorID));

            element.attr({
                id: "vendor" + vendorID,
            });
            element.removeClass('dummy');
            if ($('#vendor' + vendorID).length == 0) {
                element.appendTo('#vendorList');
            }

        }
    }


}
