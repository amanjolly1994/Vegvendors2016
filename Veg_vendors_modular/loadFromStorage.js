function loadFromStorage() {
    //console.log("hi");
    try {
        var location = JSON.parse(localStorage.getItem('location'));
        var subArea = location[0];
        var area = location[1];
        var placeCode = location[2];
        //console.log("placecode");
        postPlaceCode(placeCode);
        $("#deliveryAt").text(location[0] + ", " + location[1]);
    } catch (e) {

    }

    // try {
    //     var cart = JSON.parse(localStorage.getItem('cart'));
    //     //console.log(cart.length);
    //     for (var key in cart) {
    //         //console.log(key);
    //         if (cart.hasOwnProperty(key)) {
    //             //var key = cart.key(i)
    //             //console.log(key);
    //
    //             stamp(1,key);
    //             var totalWeight = cart[key][1];
    //             var nameItem = $("#name-item"+key);
    //             nameItem.siblings("#details" + key).find('#show-value' + key).text(totalWeight + " Kgs in cart");
    //             //console.log(("item" + key));
    //             nameItem.parents("#item" + key).attr('totalWeight',totalWeight);
    //         }
    //     }
    // } catch (e) {
    //     console.log("does not have cart property");
    // }
}

function loadStamps() {
    try {
        var cart = JSON.parse(localStorage.getItem('cart'));
        //console.log(cart.length);
        for (var key in cart) {
            //console.log(key);
            if (cart.hasOwnProperty(key)) {
                //var key = cart.key(i)
                //console.log(key);

                stamp(1,key);
                var totalWeight = cart[key][1];
                var nameItem = $("#name-item"+key);
                nameItem.siblings("#details" + key).find('#show-value' + key).text(totalWeight + " Kgs in cart");
                //console.log(("item" + key));
                nameItem.parents("#item" + key).attr('totalWeight',totalWeight);
            }
        }
    } catch (e) {
        console.log("does not have cart property");
    }
}
