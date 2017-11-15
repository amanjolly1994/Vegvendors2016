//Basket Veg Vendors

//local tab add/minus module
var mass = 0;	// default value for add

$(document).ready(function(){

	$(".currentMass").html(mass);

	//Change Vendor JS

	$(".tunnel-row-1").on("click",".click2changeVendor",function(event){
		event.preventDefault();
		var vendid = $(this).attr("data-vendid");
		var category = $(this).attr("data-category");
		var v_image = $(this).find(".selectedVendorPic img").attr("src");
		var v_name = $(this).find(".selectedVendorInfo .selectedVendorName .mls").text();

		console.log(vendid);
		console.log(category);
		ajaxVendorChange(vendid, category);

		ven1name = v_name;
		ven1pic = v_image;
		ven1id = vendid;


		displayCart();

		$(".selectTick").removeClass("selected");
		$(".selectTick").removeClass("notSelected");
		$(this).find(".selectTick").addClass("selected");

		//$(".filterRow .selectedVendorBox .selectedVendorPic img").attr("src", v_image)
		//$(".filterRow .selectedVendorBox .selectedVendorInfo .selectedVendorName .mls").text(v_name);
	});

	function ajaxVendorChange(vendid, category)
	{

		var beta =  { 'id': vendid , 'cat': category};

		$.ajax({

			type : 'POST',
			url  : '/lang/phpFiles/vendorSession.php',
			data : { 'id': vendid , 'cat': category},

			beforeSend: function()
			{

			},
			success: function(response)
			{
				if(response=="ok")
				{
					messageBox("Vendor has been changed.","green");
					window.location.reload();
				}
				else{
					// alert("not changed");
					messageBox("Error Occured. Reload the page.","#e74c3c");
				}
			}

		});
	}

	$(".addToCart").on("click", ".addMass", function(event) {
	    var $mass = $(this).prev("button.addToCartButton").find(".currentMass");
	    var increment_rate = $(this).prev(".addToCartButton").data("rate");
	    console.log(increment_rate);
	    $mass.html(+(Number($mass.text()) + Number(increment_rate)).toFixed(2));
 	});

	$(".addToCart").on("click", ".minusMass", function(event) {
	    var $mass = $(this).next("button.addToCartButton").find(".currentMass");
	    var increment_rate = $(this).next(".addToCartButton").data("rate");
	    if( +$mass.text() != 0)
	    {
	    	$mass.html(+(Number($mass.text()) - Number(increment_rate)).toFixed(2));
	    }

 	});

 	$(".addToCartButton").click(function(event){
 		event.preventDefault();
 		var name = $(this).attr("data-name");
 		var price = Number($(this).attr("data-price"));
 		var rate = Number($(this).attr("data-rate"));
 		var image = $(this).attr("data-image");
 		var category = $(this).attr("data-category");

 		var $c = $(this).find(".currentMass");
 		var count = +$c.text();

 		if(Number(count) > 0)
 		{
	 		count = Number(count)/rate;

	 		addItemToCart(name, price, count, rate, image, category);
	 		messageBox((count*rate)+" Kg "+name+" added to your basket.", "#f39c12");
	 		displayCart();
	 		previewDisplay();
	 		$(this).find(".currentMass").text("0");
	 	}
	 	else
	 	{
	 		messageBox("Please add weight first.","#F70D1A");
	 	}
 	});

 	$("#clear-cart").click(function(event){
 		clearCart();
 		displayCart();
 		previewDisplay();
 	});

 // 	$(".tunnel-row-2").on("click","#clear-cart", function(event){
 // 		clearCart();
 // 		displayCart();
 // 		previewDisplay();
 // 	});

 	function displayCart()
 	{
 		var cartArray = listCart();
 		var output = "";
 		var venName = "";
 		var venPic = "";
 		var venId = "";

 		console.log(cartArray);
 		for( var i in cartArray )
 		{
	 		$(".item-name").html(cartArray[i].name);
	 		$(".item-price").html(cartArray[i].price);
	 		$(".item-image-holder img").attr('src', cartArray[i].image);
	 		var cartt = cartArray[i].category;
	 		console.log("THE VENDOR IS "+cartt);

	 		if( cartArray[i].category == 1 )
	 		{
	 			venName = ven1name;
	 			venPic = ven1pic;
	 			venId = ven1id;
	 		}
	 		else if( cartArray[i].category == 2 )
	 		{
	 			venName = ven2name;
	 			venPic = ven2pic;
	 			venId = ven2id;
	 		}
	 		else if( cartArray[i].category == 3 )
	 		{
	 			venName = ven3name;
	 			venPic = ven3pic;
	 			venId = ven3id;
	 		}
	 		else if( cartArray[i].category == 4 )
	 		{
	 			venName = ven4name;
	 			venPic = ven4pic;
	 			venId = ven4id;
	 		}

	 		$(".vendor-photo").attr("src", venPic);
	 		$(".vendor-photo").attr("title", venName+" | "+venId);
	 		$(".vendor-photo").attr("current-sabzi", cartArray[i].category);
	 		$(".av-name").text(venName);
	 		$(".av-id").text(venId);

	 		$(".size-weight").attr('value', cartArray[i].count+" KG");

	 		$(".subtract-item").attr('data-name', cartArray[i].name);
	 		$(".subtract-item").attr('data-rate', cartArray[i].rate);
	 		$(".plus-item").attr("data-name", cartArray[i].name);
	 		$(".plus-item").attr('data-rate', cartArray[i].rate);
			$(".sub-item-remove").attr('data-name', cartArray[i].name);
	 		$(".sub-price").html(cartArray[i].total);

	 		//already in cart

	 		var full_name = cartArray[i].name;

	 		var sabzi_name = full_name.split(" ", 1);


	 		$("."+sabzi_name+" .mls").text(cartArray[i].count);
	 		$("."+sabzi_name).fadeIn();

	 		output += $(".cartToAdd").html();

	 		//$(".cart .cartToAdd").removeClass("hidden");
		}

		$(".totalItems").html(cartArray.length);
		$(".totalCost").html(totalCart());

		//header basket number
		$(".cart-tab .item-number").html(cartArray.length);

		$(".cart").html(output);
		console.log(cartArray);
 	}

 	function previewDisplay()
	{
		var cartArray = listCart();
 		var output = "";


 		//if( cartArray != "" || cartArray != null )
 		$(".preview-item-tab").show();
 		for( var i in cartArray )
 		{
	 		$(".preview-item-name").html(cartArray[i].name);
	 		$(".preview-item-mass span").html(cartArray[i].count);

	 		$(".preview-item-cost span").html(cartArray[i].total);

	 		$(".preview-item-delete").attr("data-name", cartArray[i].name);
	 		output += $(".preview-tab").html();

		}

		// $(".totalItems").html(cartArray.length);

		$(".preview-basket-total span").html(totalCart());

		$("#hiddenTotal").val(totalCart());

		$(".preview-item-box").html(output);

	}

 	// Basket Change

 	$(".preview-item-box").on("click", ".preview-item-delete", function(event){
 		event.preventDefault();
 		var name = $(this).attr("data-name");
 		removeItemFromCartAll(name);
 		displayCart();
 		previewDisplay();

 		if( totalCart() == 0 || totalCart() == "" || totalCart() == null )
			window.location.href = "/basket";

 	});

	$(".cart").on("click", ".subtract-item", function(event){
		event.preventDefault();
		var name = $(this).attr("data-name");
		var rate = Number($(this).attr("data-rate"));
		console.log(name);
		removeItemFromCart(name, rate);
		displayCart();
		previewDisplay();
	});

	$(".cart").on("click", ".plus-item", function(event){
		event.preventDefault();
		var name = $(this).attr("data-name");
		var rate = Number($(this).attr("data-rate"));
		console.log(rate);
		addItemToCart(name, 0, 1, rate, "", 0);
		displayCart();
		previewDisplay();
	});

	$(".cart").on('click', '.sub-item-remove', function(event) {
		event.preventDefault();
		var name = $(this).attr("data-name");
		removeItemFromCartAll(name);
		console.log("Removing Item");
		displayCart();
 		previewDisplay();
	});

 	// ******************************
	// Shopping Cart


	var cart = [];

	var Item = function(name, price, count, rate, image, category) {
		this.name = name;
		this.price = price;
		this.count = count;
		this.rate = rate;
		this.image = image;
		this.category = category;
	};

	function addItemToCart(name, price, count, rate, image, category)
	{
		cart = cart || [];
		for( var i in cart )
		{
			if( cart[i].name === name )
			{
				cart[i].count = cart[i].count + (count*rate);
				saveCart();
				return;
			}
		}
		var item = new Item(name, price, (count*rate), rate, image, category);
		cart.push(item);
		saveCart();
	}


	function removeItemFromCart(name, rate)	//removes 1 item
	{
		for(var i in cart)
		{
			if( cart[i].name === name )
			{
				cart[i].count = cart[i].count - rate;
				if( cart[i].count <= 0 )
				{
					cart.splice(i,1);
					var full_name = cartArray[i].name;

	 				var sabzi_name = full_name.split(" ", 1);

					$("."+sabzi_name+" .mls").text("0.0");
					$("."+sabzi_name).fadeOut();
				}
				break;
			}
		}
		saveCart();
	}

	function removeItemFromCartAll(name) //removes all items
	{
		for( var i in cart )
		{
			if( cart[i].name === name )
			{
				cart.splice(i, 1);
				var full_name = cart[i].name;

	 			var sabzi_name = full_name.split(" ", 1);

				$("."+sabzi_name+" .mls").text("0.0");
				$("."+sabzi_name).fadeOut();
				break;
			}
		}
		saveCart();
	}

	function clearCart(){
		cart = [];
		saveCart();
		$(".already-in-cart .mls").text("0.0");
		$(".already-in-cart").fadeOut();
	}

	function countCart()	// -> return total cost
	{
		var totalCount = 0;
		for( var i in cart )
		{
			totalCount += cart[i].count;
		}

		return totalCount;
	}


	function totalCart()	// -> return total cost
	{
		var totalCost = 0;
		for( var i in cart )
		{
			totalCost += cart[i].price * cart[i].count;
		}
		return totalCost.toFixed(2);
	}

	function listCart() 	// -> array of item
	{
		cart = JSON.parse(localStorage.getItem("shoppingCart"));
		var cartCopy = [];
		for( var i in cart )
		{
			var item = cart[i];
			var itemCopy = {};
			for( var p in item )
			{
				itemCopy[p] = item[p];
			}
			itemCopy.total = (item.price * item.count).toFixed(2);
			cartCopy.push(itemCopy);
		}
		return cartCopy;
	}

	function saveCart()
	{
		var cartCopy = [];
		for( var i in cart )
		{
			var item = cart[i];
			var itemCopy = {};
			for( var p in item )
			{
				itemCopy[p] = item[p];
			}
			itemCopy.total = (item.price * item.count).toFixed(2);
			cartCopy.push(itemCopy);
		}
		localStorage.setItem("shoppingCart", JSON.stringify(cartCopy));
	}

	function loadCart()
	{
		cart = JSON.parse(localStorage.getItem("shoppingCart"));
	}

	loadCart();

	(function loadBasket(){

		displayCart();
		previewDisplay();

		// $(".tunnel-row-2").load("basket.php #basket", function(){
		// 	$(".tunnel-row-2").find(".cart-item").children(".item-image-holder").hide();
		// 	displayCart();
		// 	previewDisplay();
		// });

	}());


});
