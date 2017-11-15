<?php
	//Include Database configuration File dbConfig.php
	session_start();
	include('dbConfig.php');

	$current_time = date('H:i');

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
	<script type="text/javascript" src="/lang/ajax/dashboard-ajax.js"></script>


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

</head>

<body class="no-class common">

	<script type="text/javascript">

		var check_cart = [];
		check_cart = JSON.parse(localStorage.getItem("shoppingCart"));
		if( check_cart.length < 1 )
			window.location.href="/basket";
		else {
			//Its Cool
		}

		var usePhone = 0; // 0 = not selected Phone, 1 = selected existing phone no
		var useOtp = 0;

		setInterval(function() {
      window.location.reload();
    }, 300000);

		function save_slot_session(slot)
		{

			var meta = 'slot='+slot;

			$.ajax({

				type : 'POST',
				url : '/lang/ajax/save_slot.php',
				data : meta,

				beforeSend : function()
				{

				},

				success : function(value)
				{
					if( value == "done" )
					{
						messageBox("Slot has been saved.","rgba(46, 204, 113,1.0)");
						window.location = "/checkout";
					}

					else
					{
						messageBox("Error saving slot.", "rgb(192, 57, 43)");
						location.reload();
					}
				}

			});

		}

		function ajaxUpdate()
		{
			var meta = $("#editProfile").serialize();

			$.ajax({

				type : 'POST',
				url : '/lang/phpFiles/updateProfile.php',
				data : meta,


				beforeSend : function()
				{
					$(".address-loading").html('<img src="/theme/images/icons/1.gif" />');
				},

				success : function(value)
				{
					if(value=="done")
					{
						$(".address-loading").html('<img src="/theme/images/icons/tick-green.png" />');
					}
					else if(value=="not done")
					{
						messageBox("Error. Please try again.", "rgb(192, 57, 43)");
					}
				}

			});

		}

	</script>

<div class="mainPage">
	<?php
			if( !isset($_SESSION['uid']) )
			{
				redirect("basket.php?bto=0");
			}

			include_once('header.php');

			$uid = $_SESSION['uid'];


	?>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->

		<div class="delivery-left">

			<div class="delivery-box">

				<div class="delivery-main">

				<div class="heading">
					<span></span>
					<span class="mls">Delivery Option</span>
				</div>

				<div class="delivery-main-options">
					<form id="delivery-option" name="delivery-main-option" method="POST" enctype="multipart/form-data" >
						<input type="radio" name="delivery-main-option" value="98" checked><label>Normal Delivery</label><br>
						<input type="radio" name="delivery-main-option" value="99"><label>Immidiate Delivery</label><label for="immidiate">*Extra ₹20 on this service</label>
					</form>
				</div>

				</div>

				<div class="slot-main">

					<div class="heading">
						<span></span>
						<span class="mls">Delivery Slot Selection</span>
					</div>

					<form id="slot-selection" name="slot-selection" method="POST" encrypt="multipart/form-data" >
						<p>Today</p>
						<?php
							$slot1_active = "";
							$slot2_active = "";
							$slot3_active = "";

							$slot1_time = "08:30:00";
							$slot2_time = "12:30:00";
							$slot3_time = "17:30:00";
							if( time() > strtotime($slot1_time) )
								$slot1_active = "disabled";

							if( time() > strtotime($slot2_time) )
								$slot2_active = "disabled";

							if( time() > strtotime($slot3_time) )
								$slot3_active = "disabled";
						?>
						<input type="radio" name="slot-selection" <?php echo $slot1_active ?> value="1"><label>07 AM - 10 AM</label><br>
						<input type="radio" name="slot-selection" <?php echo $slot2_active ?> value="2"><label>01 PM - 02 PM</label><br>
						<input type="radio" name="slot-selection" <?php echo $slot3_active ?> value="3"><label>06 PM - 09 PM</label><br>

						<p>Tomorrow</p>
						<input type="radio" name="slot-selection" value="4"><label>07 AM - 10 AM</label><br>
						<input type="radio" name="slot-selection" value="5"><label>01 PM - 02 PM</label><br>
						<input type="radio" name="slot-selection" value="6"><label>06 PM - 09 PM</label><br>

					</form>

					<button class="slot-back">Back</button>

				</div>

			</div>

			<button class="delivery-main-button">Proceed</button>

		</div>

		<div class="delivery-page-ad">
			<div class="delivery-ad-box">
				<img src="/theme/images/pictures/nike2.jpg" height="380" />
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

</body>

</html>
