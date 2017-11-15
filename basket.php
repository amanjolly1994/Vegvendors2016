<?php
	//Include Database configuration File dbConfig.php
	session_start();
	include('dbConfig.php');

	// Checking whether a location cookie is set or not
	$shownArea = "";

	if( isset($_COOKIE["subareacode"]) )
	{
		$shownArea = $_COOKIE["subareacode"];
	}

	else
	{
		redirect("login.php");
	}

	//Getting the name of subarea using subarea code
	 $query = $db->query("SELECT * FROM subareas WHERE sno = '$shownArea'");

	 $rowCount = $query->num_rows;

	 if( $rowCount > 0 )
	 {
	 	$row = $query->fetch_assoc();
	 	$subareaName = $row['subareas'];
	 }

	 else
	 	redirect("login.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />

	<!-- SEO SECTION -->

	<?php

		include("seo.php");


		?>
	<title>Online Vegetable Store to Order from Local Vendors - Veg Vendors</title>
	<link rel="shortcut icon" href="favicon.png" />



	<!-- Style Links -->

	<link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

	<!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
	<script type="text/javascript" src="/lang/js/h-basket.vvg.js" ></script>
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>

	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/registration_ajax.js"></script>
	<script type="text/javascript" src="/lang/ajax/login_ajax_script.js"></script>

	<!-- AJAX CONFIGURATION FOR AREA SECTION -->
	<script type="text/javascript">
	$(document).ready(function(){

		var check_cart = [];
		check_cart = JSON.parse(localStorage.getItem("shoppingCart"));
		if( check_cart.length > 0 )
		{
			//its Cool
		}
		else {
			messageBox("Your cart is Empty! Start Shopping.", "#e74c3c");
		}

	// Select Location Loading
		$(".tunnel-row-1").on("change", "#areaSelect", function(){
			var area = $(this).val();
			if(area){
				$.ajax({
					type: 'POST',
					url: '/lang/ajax/ajaxAreaSelector.php',
					data: 'area='+area,
					success:function(html){
						$("#subAreaSelect").html(html);
						$("#subAreaSelect").selectpicker('refresh');
					}
				});
			}
			else{
				$("#subAreaSelect").html('<option value="">Select Area First</option>');
			}
		});

		$(".checkout-button").click(function(event){
			event.preventDefault();
			if( check_cart.length > 0 )
				window.location.href="/delivery";
			else {
				console.log("empty cart");
				messageBox("Your cart is Empty! Start Shopping.", "#e74c3c");
			}
		});

	});
	</script>

	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>

</head>

<body class="no-class common">

<div class="mainPage">
	<?php
		include('header.php');

		//MESSAGE FOR LOGIN FIRST

		if( isset($_GET['bto']) )
		{
			if( $_GET['bto'] == 0 && !isset($_SESSION['uid']) )
			{
				?>
				<script type="text/javascript">
				messageBox("Please login first to checkout.", "#e74c3c");
				</script>
				<?php
			}
		}

	?>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->
		<div class="fullBasketDiv">
			<div id="basket">

				<div class="cartToAdd hidden">
				<div class="cart-item">

					<!-- Getting Default or Selected Vendors -->



					<div class="item-image-holder">
						<img src="/theme/images/vegetables/potato.png" class="item-image" />
					</div>

					<div class="item-name-holder">
						<span class="item-name">Potato</span>
						<br/>
						₹<span class="item-price">15</span>/kg
					</div>

					<div class="size-wrapper">

						<button class="size-minus subtract-item">-</button>

						<input type="text" name="weight" disabled class="size-weight" />

						<button class="size-add plus-item">+</button>
					</div>

					<div class="sub-price-wrapper">
						₹<span class="sub-price"></span>
					</div>

					<div class="sub-item-remove">
						X REMOVE
					</div>

					<div class="vendor-wrapper">
						<img title="Aman Jolly | AJ047" src="/theme/images/pictures/AAEAAQAAAAAAAAXkAAAAJGI0Y2JjNmEwLTdkMDMtNDkzMy04ZGM3LTQ0OGMxNTI5NzA0NQ.jpg" class="vendor-photo changeVendorBasket" />
						<div class='appendVendorDetail'><span class="av-name">Aman Jolly</span><br><span class="av-id">Id: VT98YI02</span></div>
					</div>

					<div class="clear"></div>
				</div>
				</div>

				<div class="basketTopLayer">

					<div class="your-basket-text">
						<span class="icon-basket"></span>
						<span class="mls">Your Basket</span>
					</div>

					<div id="clear-cart" class="basket-clear">
						<span class="mls">Clear</span>
					</div>

					<div class="clear"></div>

				</div>

				<div class="cart all-items">


				</div>

				<div class="items-vendors-num">
					<p class="vendor-numbers"><span class="totalItems">0</span> item(s)</p>

					<p class="total-price">Total- ₹<span class="totalCost"></span></p>

					<div class="clear"></div>
				</div>

				<div class="checkout-wrapper">
					<button style="cursor: pointer" class="checkout-button">Checkout</button>
				</div>

				<div class="clear"></div>

			</div>
		</div>

		<!-- NEW PAGE ENDS -->

	</section>

	<?php
	include_once("footer.php");
	?>

</div>

<!-- SIDE TUNNEL STARTS HERE -->

<div class="tunnel">

	<div class="tunnelPage">

		<div class="tunnel-arrow">
			<span class="icon-arrow-left"></span>
		</div>

		<div class="tunnel-row-1">

		</div>

		<div class="tunnel-row-2">

		</div>

	</div>

</div>

<!-- SIDE TUNNEL ENDS -->

<div class="clear"></div>

<div class="cart-item hidden">
	<div class="item-image-holder">
		<img src="/theme/images/vegetables/potato.png" class="item-image" />
	</div>

	<div class="item-name-holder">
		<span class="item-name">Potato</span>
		<br/>
		₹<span class="item-price">15</span>/kg
	</div>

	<div class="size-wrapper">

		<button class="size-minus subtract-item">-</button>

		<input type="text" name="weight" disabled class="size-weight" />

		<button class="size-add plus-item">+</button>
	</div>

	<div class="sub-price-wrapper">
		₹<span class="sub-price"></span>
	</div>

	<div class="vendor-wrapper">
		<img title="Aman Jolly | AJ047" src="/theme/images/pictures/AAEAAQAAAAAAAAXkAAAAJGI0Y2JjNmEwLTdkMDMtNDkzMy04ZGM3LTQ0OGMxNTI5NzA0NQ.jpg" class="vendor-photo changeVendorBasket" />
	</div>

	<div class="clear"></div>
</div>

</body>

</html>
