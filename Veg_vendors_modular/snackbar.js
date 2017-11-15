function moduleSnackbar(flag,id = -1){
    //0 - Nothing to show
    // 1 - Not negative
    // 2- Added to cart

    var element = $("#snackbar");

    if(flag === 1){
        element.text("Weight Cant Be Negative!");
    }

    if (flag === 2) {
        try {
            cart = JSON.parse(localStorage.getItem('cart'));
            //console.log(cart[id]);
            totalWeight = cart[id][1];
            name = cart[id][0];
            element.text(totalWeight+' Kg '+ name +' was added to cart.');
        } catch (e) {
            //console.log("does not have cart property");
        }
    }

    if (flag === 3){
        element.text("Please add some Weight");
    }

    element.addClass('show');
    setTimeout(function () {
        element.removeClass('show');
    }, 1500);
}
