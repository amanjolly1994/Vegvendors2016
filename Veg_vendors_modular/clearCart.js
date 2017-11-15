function clearCart() {
    $("#clear").click(function(event) {
        //alert("hi");
        $("#basket").empty();
        try {
            var cart = JSON.parse(localStorage.getItem('cart'));
            //console.log(cart);
            for (var id in cart) {
                if (cart.hasOwnProperty(id)) {
                    $("#item" + id).attr('totalWeight','0.00');
                    totalWeight = $("#item" + id).attr('totalWeight');
                    $('#show-value' + id).text(totalWeight + " Kgs in cart");
                    removeStamp(id);
                }
            }
        } catch (e) {
            //console.log("does not have cart property");
        }
        // for (var i = 0; i < localStorage.length; i++) {
        //
        //     var key = localStorage.key(i)
        //     //console.log(key+":"+localStorage.getItem(key));
        //
        //     var temp = localStorage.getItem(key).split(",")[1];
        //     var nameItem = $("#name-item"+key)
        //     nameItem.parent().parent().attr("totalWeight","0.0");
        //     nameItem.next().next().find('span:nth-child(2)').text("0.00 Kgs in cart");



        //}
        localStorage.removeItem('cart');

    });
}
