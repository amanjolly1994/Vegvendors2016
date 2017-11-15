/*function createObj(id,name,price,totalWeight,totalPrice,incRate){
    this.id = id;
    this.name = name;
    this.price = price;
    this.totalWeight = totalWeight;
    this.totalPrice = totalPrice;
    this.incRate = incRate;
}*/



function addFinally() {
    $(".add-finally").click(function() {
        var arr = [];
        var sid = parseInt($(this).attr('id').match(/(\d+)$/)[0], 10);
        //console.log(sid);
        var parent = $('#item' + sid);
        //console.log(parent);
        var vegName = $(parent).attr("name");
        arr.push(vegName);                                       //name at 0 index    mapped at sid
        //console.log(vegName);
        var totalWeight = parent.attr("totalWeight");
        totalWeight = Number(totalWeight);
        totalWeight = totalWeight.toFixed(2);
        if( totalWeight == 0){
            moduleSnackbar(3);
            return;
        }
        arr.push(totalWeight);                             //totalWeight at 1
        //console.log(totalWeight);
        price = parent.attr("price");
        price = Number(price);
        arr.push(price);                                    //price at index 2  - price
        //console.log(price);
        value = parent.attr("value");
        arr.push(value);                                 //index 3 - increment rate
        //console.log(value);
        totalPrice = (price*totalWeight).toFixed(2);
        arr.push(totalPrice);                               //index 4 -totalPrice
        //console.log(totalPrice);
        id = parent.attr("sid")
        //console.log(id);
        //var item = new createObj(id,vegName,price,totalWeight,totalPrice,value);

        saveToLocalVar(id,arr);
        moduleSnackbar(2,id);
        stamp(1,id);
    });
}
