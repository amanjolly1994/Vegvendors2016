<?php
	//Include Database configuration File dbConfig.php
	session_start();
	include('dbConfig.php');

	if( isset($_SESSION["discount"]) )
	{

	}

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

	if( !isset($_SESSION['uid']) )
	{
		redirect("basket.php?bto=0");
	}

	// CHECKING IF A USER IS LOGGED IN OR Not

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

	$slot = 0;

	 if( isset($_SESSION["slot"]) )
	 	$slot = $_SESSION["slot"];
	 else
	 	redirect("/basket");

	 if( $slot == 1 )
	 	$slot_value = "Today 07 AM - 10 AM";
	 if( $slot == 2 )
	 	$slot_value = "Today 01 PM - 02 PM";
	 if( $slot == 3 )
	 	$slot_value = "Today 06 PM - 09 PM";
	 if( $slot == 4 )
	 	$slot_value = "Tomorrow 07 AM - 10 AM";
	 if( $slot == 5 )
	 	$slot_value = "Tomorrow 01 PM - 02 PM";
	 if( $slot == 6 )
	 	$slot_value = "Tomorrow 06 PM - 09 PM";
	 if( $slot == 99 )
	 	$slot_value = "Immidiate Delivery - + ₹20";

   $digits = 5;
	 $checkout_var = rand(pow(10, $digits-1), pow(10, $digits)-1);

	 $_SESSION['checkout'] = $checkout_var;

   $coupon_code = "";

   if ( isset($_SESSION['coupon']) ) {
     $coupon_code = $_SESSION['coupon'];
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />

	<!-- SEO SECTION -->

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
	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>
	<script type="text/javascript" src="/lang/js/h-basket.vvg.js" ></script>
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>
	<script type="text/javascript" src="/lang/js/rating.js" ></script>
	<script type="text/javascript" src="/lang/js/otp.js" ></script>

	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/registration_ajax.js"></script>
	<script type="text/javascript" src="/lang/ajax/login_ajax_script.js"></script>
  <script type="text/javascript" src="/lang/js/canvas.js"></script>


	<!-- AJAX CONFIGURATION FOR AREA SECTION -->
	<script type="text/javascript">

	var check_cart = [];
	check_cart = JSON.parse(localStorage.getItem("shoppingCart"));
	if( check_cart.length < 1 )
		window.location.href="/basket";
	else {
		//Its Cool
	}

	$(document).ready(function(){

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

		// Phone Number Select and de select

		var usePhone = 0; // 0 = not selected Phone, 1 = selected existing phone no
		var useOtp = 0;

		// CHECKOUT STEP 2

		$("#checkout-finish").submit(function(){

			// if( $(".address-form-input").val() == "" || $(".address-form-input").val() == null )
			// {
			// 	messageBox("Delivery address cannot be empty. Please fill it.","rgba(192, 57, 43,1)");
			// 	return false;
			// }

			// if( usePhone == 0 && useOtp == 0 )
			// {
			// 	messageBox("Please select a phone number or enter a new one","rgba(192, 57, 43,1)");
			// 	return false;
			// }

			// else
			// {
				var cartArray = JSON.parse(localStorage.getItem("shoppingCart"));
				console.log("after this");
				console.log(cartArray);

				document.forms["checkout-finish"]["hiddenBasket"].value = JSON.stringify(cartArray);
				console.log("foRm ka");
				console.log(document.forms["checkout-finish"]["hiddenBasket"].value);
				return true;
			// }
			// return false;
		});

	});
	</script>

</head>

<body class="no-class common">

	<script type="text/javascript">
		// COUPON CODE AJAX

	</script>

<div class="mainPage">

  <input class="hidden-coupon-save" type="hidden" value="<?php echo $coupon_code; ?>" />

	<?php
			include_once('header.php');

			$uid = $_SESSION['uid'];
			$userAddress = "";

			$qq = $db->query(" SELECT * FROM registered_users WHERE uid='$uid' ");
			while( $userInfo = $qq->fetch_assoc() )
			{
				$userAddress = $userInfo["delivery_address"];
				$userPhone = $userInfo["contact"];
				$phone_output = "0 Phone number in record.";
				if( $userPhone != null || $userPhone != "" )
				{
					$phone_output = '<button class="userPhoneNumber">
					 	<span class="icon-check-alt"></span>
					 	<span class="mls">'.$userPhone.'</span>
					</button>';
				}
			}

	?>

  <script>
    var currentLocation = "<?php echo $subareaName.', '.$placeName; ?>";

    var prevAdd = "<?php echo $userAddress; ?>";
    if( prevAdd == "" || prevAdd == null )
    {
      $(".checkout-address-box-right .mls").html("No Address Saved");
      $(".address-tick").hide();
      $(".checkout-change-address .mls").html("Add New Address");
    }

    var prevPhone = "<?php echo $userPhone; ?>";
    if( prevAdd == "" || prevAdd == null )
    {
      $(".checkout-phone-box-right .mls").html("No Contact Saved");
      $(".otp-tick").hide();
      $(".checkout-change-address .mls").html("Add New Contact");
    }

		$(".checkout-section").on("submit",".checkout-finish", function(event){
			//event.preventDefault();
			if( prevAdd == "" || prevAdd == null )
				return false;

			if( prevPhone == "" || prevPhone == null )
			{
				var tt = /^\d{10}$/;

				if( !prevPhone.match(tt) )
					return false;
			}

			return true;
		});
  </script>

	<section class="checkout-section">

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->
		<div class="checkout-left">

			<div class="checkout-address-box">
				<div class="checkout-address-box-left">
					<span class="mls">Address: </span>
				</div>

				<div class="checkout-address-box-right">
					<span class="mls"><label class="change-address-label"><?php echo $userAddress; ?></label><?php echo ', '.$subareaName.', '.$placeName; ?></span>
				</div>

				<div class="phone-verified-tick address-tick">
					<img src="/theme/images/icons/tick-green.png" />
				</div>

				<div class="clear"></div>

				<div class="checkout-change-phone-button checkout-change-address">
					<span class="mls">Change Address</span>
				</div>
			</div>

			<div class="checkout-phone-box">
				<div class="checkout-phone-box-left">
					<span class="mls">Verified Contact:</span>
				</div>

				<div class="checkout-phone-box-right">
					<div class="mls"><?php echo $userPhone; ?></div>
				</div>

				<div class="phone-verified-tick otp-tick">
					<img src="/theme/images/icons/tick-green.png" />
				</div>

				<div class="clear"></div>

				<div class="checkout-change-phone-button">
					<span class="mls">Change Contact</span>
				</div>
			</div>

			<div class="slot-preview">
				<div class="slot-preview-left">
					<span class="mls">Your Selected Slot: </span>
				</div>

				<div class="slot-preview-right">
					<span class="mls"><?php echo $slot_value; ?></span>
				</div>

				<div class="phone-verified-tick">
					<img src="/theme/images/icons/tick-green.png" />
				</div>

				<div class="clear"></div>

				<div class="checkout-change-phone-button checkout-change-slot">
					<span class="mls">Change Delivery Slot</span>
				</div>
			</div>

			<div class="checkout-coupon-box">
				<div class="checkout-coupon-box-left">
					<span class="mls">Coupon Code:</span>
				</div>

				<div class="checkout-coupon-box-right">
					<span class="mls">No Coupon Added</span>
				</div>

				<div class="phone-verified-tick coupon-tick">
					<img src="/theme/images/icons/tick-green.png" />
				</div>

				<div class="clear"></div>

				<div class="checkout-change-phone-button checkout-apply-coupon">
					<span class="mls">Apply Coupon</span>
				</div>
			</div>

			<form class="checkout-coupon-form" id="checkout-coupon-form" name="checkout-coupon-form" method="post">
				<input type="text" placeholder="Coupon Code" name="coupon-code" class="coupon-code-input" />
				<input type="submit" value="Apply Coupon" class="coupon-submit-button" />
				<div class="clear"></div>
        <div class="coupon-message">
          <span class="mls">Invalid Coupon Code. Try Again.</span>
        </div>
			</form>

      <div class="payment-option-box">
        <div class="payment-option-box-left">
          <span class="mls">Payment Method:</span>
        </div>

        <div class="payment-option-box-right">
          <form class="payment-method-form" id="payment-method-form" name="payment-method-form" method="post">
            <select name="payment-method" class="payment-method">
              <option value="0">Cash On Delivery</option>
              <option value="1">Wallet On Delivery (Paytm &amp; FreeCharge)</option>
            </select>
          </form>
        </div>

        <div class="clear"></div>
      </div>

      <form class="checkout-finish" id="checkout-finish" name="checkout-finish" method="POST" action="/post_basket">
        <input type="hidden" name="hiddenBasket" />
        <input type="hidden" name="checkout_var" value="<?php echo $checkout_var; ?>" />
        <input type="submit" value="PROCEED TO PAY ₹200.00" class="finish-checkout-button" />
      </form>

		</div>

		<div class="checkout-right">

			<div class="preview-basket">
				<p class="sideLines preview-basket-heading"><span>Your Mini-Basket</span></p>


				<div class="preview-tab hidden">
					<div class="preview-item-tab">
						<div class="preview-item-name preview-item-float">Potato</div>
						<div class="preview-item-mass preview-item-float"><span>5</span> KG</div>
						<div class="preview-item-cost preview-item-float">₹<span>100</span></div>
						<div class="preview-item-delete" data-name="" title="Remove item"><img src="/theme/images/icons/close_red.png" /></div>
						<div class="clear"></div>
					</div>
				</div>

				<div class="preview-item-box">

				</div>

        <div class="discount-box">
          <div class="old-total-amount">Total: ₹<span class="mls">130</span></div>
          <div class="coupon-discount-value">Coupon Discount: ₹<span class="mls">65</span></div>
        </div>

				<div class="preview-basket-total">
					Grand Total= ₹<span></span>
				</div>

			</div>

      <form class="checkout-finish" id="checkout-finish" name="checkout-finish" method="POST" action="/post_basket">
        <input type="hidden" name="hiddenBasket" />
        <input type="hidden" name="checkout_var" value="<?php echo $checkout_var; ?>" />
        <input type="submit" value="PROCEED TO PAY ₹200.00" class="finish-checkout-button" />
      </form>

			<div class="checkout-ad">
				<img src="/theme/images/pictures/maxresdefault.jpg" />
			</div>

		</div>

		<div class="clear"></div>

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

<script type="text/javascript">
	$(".couponForm").submit(function(e){
			alert("In here");
			applyCoupon();
			return false;
		});
</script>

</body>

</html>
