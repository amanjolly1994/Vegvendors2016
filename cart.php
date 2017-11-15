<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Cart Module</title>
		<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
	</head>

	<body>

		<h1>Shopping Cart</h1>

		<div>
			<ul>
				<li><a class="add-to-cart" href="#" data-name="Apple" data-price="1.22">Apple $1.22</a></li>
				<li><a class="add-to-cart" href="#" data-name="Banana" data-price="1.33">Banana $1.33</a></li>
				<li><a class="add-to-cart" href="#" data-name="Shoe" data-price="22.33">Shoe $22.33</a></li>
				<li><a class="add-to-cart" href="#" data-name="Frisbee" data-price="5.22">Frisbee $5.22</a></li>

			</ul>
			<button id="clear-cart">Clear Cart</button>
		</div>

		<div>
			<ul id="show-cart">
				<!-- -->
			</ul>
		</div>

		<div>Total Cart: $<span id="total-cart"></span></div>


		<script type="text/javascript">

			$(".add-to-cart").click(function(event){				
				event.preventDefault();
				var name = $(this).attr("data-name");
				var price = Number($(this).attr("data-price"));

				addItemToCart(name, price, 1);
				displayCart();
			});

			$("#clear-cart").click(function(event){
				clearCart();
				displayCart();
			});

			function displayCart()
			{
				var cartArray = listCart();
				var output = ""	;
				for( var i in cartArray )
				{
					output += "<li>"
							+cartArray[i].name
							+" "+cartArray[i].count
							+"x "+cartArray[i].price
							+" = "+cartArray[i].total
							+" <button class='plus-item' data-name='"
							+cartArray[i].name+"'>+</button>"
							+" <button class='subtract-item' data-name='"
							+cartArray[i].name+"'>-</button>"
							+" <button class='delete-item' data-name='"
							+cartArray[i].name+"'>X</button>" 
							+"</li>";
				}
				$("#show-cart").html(output);
				$("#total-cart").html( totalCart() );
			}

			$("#show-cart").on("click", ".delete-item", function(event){
				var name = $(this).attr("data-name");
				removeItemFromCartAll(name);
				displayCart();
			});

			$("#show-cart").on("click", ".subtract-item", function(event){
				var name = $(this).attr("data-name");
				removeItemFromCart(name);
				displayCart();
			});

			$("#show-cart").on("click", ".plus-item", function(event){
				var name = $(this).attr("data-name");
				addItemToCart(name, 0, 1);
				displayCart();
			});


			// ******************************
			// Shopping Cart

			var cart = [];

			var Item = function(name, price, count) {
				this.name = name;
				this.price = price;
				this.count = count;
			};

			function addItemToCart(name, price, count)
			{
				for( var i in cart )
				{
					if( cart[i].name === name )
					{
						cart[i].count += count;
						saveCart();
						return;
					}
				}
				var item = new Item(name, price, count);
				cart.push(item);
				saveCart();
			}
			

			function removeItemFromCart(name)	//removes 1 item
			{
				for(var i in cart) 
				{
					if( cart[i].name === name )
					{
						cart[i].count--;
						if( cart[i].count === 0 )
						{
							cart.splice(i,1);
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
						break;
					}
				}
				saveCart();
			}

			function clearCart(){
				cart = [];
				saveCart();
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
				localStorage.setItem("shoppingCart", JSON.stringify(cart));
			}

			function loadCart()
			{
				cart = JSON.parse(localStorage.getItem("shoppingCart"));
			}

			loadCart();
			displayCart();

		</script>

	</body>
</html>