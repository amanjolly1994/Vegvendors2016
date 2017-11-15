function reOrder(order)
{
  $.ajax({
    type : 'POST',
    url : '/lang/ajax/makeReorder.php',
    data : 'order_id='+order,

    beforeSend : function(){
      console.log("Sending to reorder: "+order);
    },

    success : function(value)
    {
      //console.log(value);
      var dd = JSON.parse(value);
      localStorage.setItem("shoppingCart", JSON.stringify(dd));
      window.location.href="/basket"
    }

  });

}
