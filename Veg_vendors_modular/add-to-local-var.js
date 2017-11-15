cartGlobal = {};
function saveToLocalVar(id,arr) {
        //console.log(id,arr);
        var obj = JSON.parse(localStorage.getItem('cart'))
        if (obj != null) {
            cartGlobal = obj;
        }
        cartGlobal[id] = arr;
        //console.log(cartGlobal);
        localStorage.setItem("cart",JSON.stringify(cartGlobal));
}
