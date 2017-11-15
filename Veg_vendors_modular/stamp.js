function stamp(flag,id = -1) {
    //1 - to stamp veg image

    var element = $("#stamp" + id);

    if (flag === 1) {
        try {
            cart = JSON.parse(localStorage.getItem('cart'));
            var totalWeight = cart[id][1];
            element.text(totalWeight + "Kg already in Cart");
        } catch (e) {
            //console.log("does not have cart property");
        }
    }

    //console.log(element);
    element.attr("class","stamp-show");

}

function removeStamp(id) {
    var element = $("#stamp" + id);
    element.attr("class","stamp");
}
