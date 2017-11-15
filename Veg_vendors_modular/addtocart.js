function moduleAddToCart(){
    //console.log("add to cart");
    $(".add").click(function() {
        //console.log("hi");
        var sid = parseInt($(this).attr('id').match(/(\d+)$/)[0], 10);
        console.log(sid);
        var parent = $('#item' + sid);
        //console.log(parent);
        //console.log(parent);
        value = parent.attr("value");
        //console.log("value = " + value);
        prev = $("#show-value" + sid);
        //console.log(prev);
        totalWeight = parent.attr("totalWeight");
        totalWeight = Number(totalWeight);
        //console.log("initial tw " + totalWeight);
        totalWeight += Number(value);
        totalWeight = totalWeight.toFixed(2);
        //console.log(toString(totalWeight));
        prev.text(totalWeight+" Kgs in cart")
        parent.attr("totalWeight",totalWeight);
    });
}

function cartAddToCart() {
    $('.addtocart-cart').click(function(event) {
        var arr = [];
        var sid = parseInt($(this).attr('id').match(/(\d+)$/)[0], 10);
        console.log(sid);
        var parent = $(this).parents('#cart-item' + sid);
        console.log(parent);
        var price = parent.attr('price');
        var totalWeight = parent.attr('totalWeight')
        var value = parent.attr('value');
        var name = parent.attr('name');

        console.log(price + ' ' + totalWeight +  ' ' + value );
        totalWeight = Number(totalWeight);
        totalWeight += Number(value);
        totalWeight = totalWeight.toFixed(2);
        totalPrice = (price*totalWeight).toFixed(2);
        Array.prototype.push.apply(arr, [name,totalWeight,price,value,totalPrice]);
        console.log(arr);
        saveToLocalVar(sid,arr);
        loadStamps();
        fillCart();

    });
}
