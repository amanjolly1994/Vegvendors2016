<?php
//json ends
	session_start();
	include('dbConfig.php');
	require_once('lang/resource/makeOrder.php');


	// Checking whether a location cookie is set or not
	$shownArea = "";

	if( isset($_COOKIE["subareacode"]) )
	{
		$shownArea = $_COOKIE["subareacode"];
		$place_code = $_COOKIE["place_code"];
	}

	else
	{
		redirect("login.php");
	}

	if( !isset($_SESSION['uid']) )
	{
		redirect("/");
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

	 $slot = $_SESSION["slot"];

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
	<script type="text/javascript" src="/lang/js/h-basket.vvg.js" ></script>
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>


	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/registration_ajax.js"></script>
	<script type="text/javascript" src="/lang/ajax/login_ajax_script.js"></script>


	<!-- AJAX CONFIGURATION FOR AREA SECTION -->
	<script type="text/javascript">
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
	});
	</script>

	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>

</head>

<body class="no-class common">

	<script type="text/javascript">
		var usePhone = 0; // 0 = not selected Phone, 1 = selected existing phone no
		var useOtp = 0;
	</script>

<div class="mainPage">
	<?php
			include('header.php');

// ADDING BASKET TO DATABASE

$order_id = 0;

$checkout_var = $_POST["checkout_var"];

if( $_SESSION['checkout'] == $checkout_var )
{
	$myarray = json_decode($_POST["hiddenBasket"], true);
	$userId=$_SESSION['uid'];

	$a = $db->query("SELECT * FROM registered_users WHERE uid = '$userId'");

	$row = $a->fetch_assoc();
	$phone = $row["contact"];
	$email = $row["email"];

	// Coupon Module Session
	$coupon = "";

	$order = new order();

	$order_id = $order->orderConfirm($myarray,$userId,$place_code,$slot,$coupon);

	$_SESSION['checkout'] = 0;
}

else {
	?>
	<script>window.location.href="/";</script>
	<?php
}

?>

<script type="text/javascript">
	var emptyCart = [];
	localStorage.setItem("shoppingCart", JSON.stringify(emptyCart));
</script>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->

		<div class="invoicePage" id="invoicePage" style="max-width:700px; margin: 50px auto;">

			<div class="invoiceLogo">
				<img src="/theme/images/logos/full-logo.png" width="200" />
			</div>

			<h3 style="font-size: 21px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; color: #333; margin-top: 10px;">Transaction Receipt</h3>

			<div style="font-size: 15px; font-family: Arial,Helvetica,sans-serif; margin-top: 5px; color: #333;">
				<?php
					$a = $db->query("SELECT * FROM main_orders WHERE order_id = '$order_id'");

					$row = $a->fetch_assoc();
					$date = $row["order_date"];
					$totalPrice = $row["total_price"];
				 ?>
				<p>Order no: #<?php echo $order_id; ?></p>
				<p><?php echo $date; ?></p>
			</div>

			<div style="font-size: 15px; font-family: Arial,Helvetica,sans-serif; margin-top: 15px; color: #333;">

				<p><?php echo $phone; ?></p>
				<p><?php echo $email; ?></p>
			</div>

			<div style="margin-top:20px;">

				<table style="width: 100%; font-size: 16px; font-family: Arial,Helvetica,sans-serif; color: #333; border: 1px #111 solid; border-spacing: 0px; border-collapse: collapse;">
					<tr style="background: #4CAF50; color: #fff;">
						<td style="width: 60%; padding: 5px;">Vegetable</td>
						<td style="width: 20%; padding: 5px;">Quantity(Kg)</td>
						<td style="width: 20%; padding: 5px;">Total</td>
					</tr>

					<?php

						$qq = $db->query("SELECT * FROM sub_orders WHERE order_id='$order_id' ");
						while( $orderDetails = $qq->fetch_assoc() )
						{ ?>
							<tr style="background: none; color: #333; margin-top: 5px;">
								<td style="width: 60%; padding: 5px; border-bottom: 1px #333 solid;"><?php echo $orderDetails["sabziz"]; ?></td>
								<td style="width: 20%; padding: 5px; border-bottom: 1px #333 solid;"><?php echo $orderDetails["qty_in_kg"]; ?></td>
								<td style="width: 20%; padding: 5px; border-bottom: 1px #333 solid;"><?php echo $orderDetails["price"]; ?></td>
							</tr>
					<?php
						}

						if( $order_id == 0 )
						{ ?>
							<tr>
								<td style="text-align: center; padding-top: 50px;">Page has been refreshed. Goto <a href="dashboard.php" style="color: red !important;">Dashboard</a> to view your orders.</td>
							</tr>
						<?php
						}
					?>

					<tr style="height: 150px;"></tr>

				</table>

				<p style="text-align: right; font-size: 18px; color: #333; font-family: Arial,Helvetica,sans-serif; margin-top: 15px;">Grand Total: ₹ <?php echo $totalPrice; ?></p>

				<?php
					if( $slot == 99 )
					{
				?>
						<p style="text-align: right; font-size: 14px; color: #666; font-family: Arial,Helvetica,sans-serif; margin-top: 10px;">* Immidiate Delivery Extra Charge = ₹20</p>
				<?php
					}
				?>


				<p style="text-align: center; font-size: 14px; color: #333; margin-top: 5px;">Ammount to be paid via Cash on delivery (COD)</p>

				<div style="width: 600px; margin: 20px auto;">
					<img src="/theme/images/pictures/ad1.jpg" style="margin-top: 5px;" />
				</div>

				<p style="text-align: center;">Visit us at <a href="www.vegvendors.in" style="color: #4CAF50 !important;">vegvendors.in</a></p>

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

</body>

<script type="text/javascript">

//EMail Invoice

var total = Number("<?php echo $totalPrice; ?>");

(function(){

	if( total != 0 )
	{
		$.ajax({
	         type: 'POST',
	         url: 'sendInvoice.php?or=<?php echo $order_id; ?>',
	         data: { content: $('#invoicePage').html()},

	         success: function(abc) {
						 console.log(abc);
	         }
	     });
	}

})();

</script>

</html>
