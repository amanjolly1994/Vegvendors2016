function moduleSubtractFromCart() {
    $(".subtract").click(function () {
        var sid = parseInt($(this).attr('id').match(/(\d+)$/)[0], 10);
        var parent = $('#item' + sid);
        value = parent.attr("value");
        next = $('#show-value' + sid);
        totalWeight = parent.attr("totalWeight");
        totalWeight = Number(totalWeight);
        if (totalWeight == 0) {
            moduleSnackbar(1);   //weight can't be negative
            return;
        }
        if (totalWeight == value) {
            removeStamp(sid);
        }
        totalWeight -= Number(value);
        totalWeight = totalWeight.toFixed(2);
        //console.log(totalWeight);
        next.text(totalWeight+" Kgs in cart")
        parent.attr("totalWeight",totalWeight);
    });

}

function cartSubtractFromCart() {
    $('.subtractfromcart-cart').click(function(event) {
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
        totalWeight -= Number(value);
        totalWeight = totalWeight.toFixed(2);
        totalPrice = (price*totalWeight).toFixed(2);
        if (totalWeight != value) {
            Array.prototype.push.apply(arr, [name,totalWeight,price,value,totalPrice]);
            console.log(arr);
            saveToLocalVar(sid,arr);
        }
        else {
            var temp = JSON.parse(localStorage.getItem('cart'));
            delete temp[sid];
            localStorage.setItem('cart',temp);
        }
        loadStamps();
        fillCart();
    });
}
