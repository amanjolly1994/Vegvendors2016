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

	<?php

		include("seo.php");


		?>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="favicon.png" />


	<!-- Style Links -->

	<link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/order.css" />
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
	<script type="text/javascript" src="/lang/ajax/dashboard-ajax.js"></script>
	<script type="text/javascript" src="/lang/js/reorder.js"></script>

	<!-- AJAX CONFIGURATION FOR AREA SECTION -->
	<script type="text/javascript">
	$(document).ready(function(){
		var order_id;
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

		// Previous Order Click

		$(".dashView").on("click", ".orderBox", function(event){

			event.preventDefault();
			order_id = $(this).attr("data-order");
			openSubOrders(order_id);

		});

		function openSubOrders(order)
		{
			$.ajax({
				type : 'POST',
				url : '/lang/ajax/subOrderBox.php',
				data : 'order_id='+order,

				beforeSend : function()
				{
					console.log("Sending Order to php value");
				},
				success : function(value)
				{
					$(".orderFloatBox").html(value);
					$(".mainPage").css({opacity: '0.2'});
					$("body").css({overflow: 'hidden'});
					$(".orderFloatBox").fadeIn();
				}

			});
		}

		$(document).click(function(e){

			if( e.target.className != 'orderFloatBox' && !$('.orderFloatBox').find(e.target).length )
			{
				$("body").css({overflow: 'auto'});
				$(".mainPage").css({opacity: '1'});
				$(".orderFloatBox").fadeOut();
			}

		});

		$(".orderFloatBox").on("click", ".complaintButton", function(e){
			e.preventDefault();
			//window.location.replace("http://vegvendors.in/complain");
			window.location.href="/complain";
		});

		$(".orderFloatBox").on("click", ".slotChangeButton", function(e){
			e.preventDefault();
			var order = $(this).attr("data-order");
			$.ajax({
				type : 'POST',
				url : '/lang/phpFiles/slot_change_count.php',
				data : 'order_id='+order,

				beforeSend : function()
				{
					console.log("Checking Slot Changes. Please wait.");
				},

				success : function(response)
				{
					if(response=='ok')
					{
						$(".subOrderTable").hide();
						$(".changeSlotBox").fadeIn();
						console.log("Slot Change Available");
					}
					else {
						messageBox("Slot can be changed only once.","#e74c3c");
						console.log("Slot can be changed only once");
					}
				}
			});
		});

		$(".orderFloatBox").on("click", ".slot-back", function(e){
			e.preventDefault();
			$(".changeSlotBox").hide();
			$(".subOrderTable").fadeIn();
		});

		$(".orderFloatBox").on("click", ".changeSlotButton", function(e){
			e.preventDefault();
			console.log("Order id: "+order_id);
			changeSlot();
		});

		function changeSlot()
		{
			var seta = $('#slot-selection').serialize();
			seta = seta+'&order_id='+order_id;

			console.log(seta);

			$.ajax({

				type : 'POST',
				url : '/lang/ajax/changeSlot.php',
				data : seta,

				beforeSend : function()
				{
					console.log("changing slot");
					messageBox("Change Delivery Slot. Please wait.","#34495e");
				},

				success : function(value)
				{
					console.log(value);
					if( value == "ok" )
					{
						console.log("slot changed");
						messageBox("Delivery Slot Updated.","#2ecc71");
						window.location.reload();
					}
					else {
						console.log("Error: "+value);
					}
				}

			});
		}

		$(".orderFloatBox").on("click",".reorderButton", function(e){
			e.preventDefault();
			$(".reorderButton").html("Sure?");
			$(this).addClass("reorderConfirm");
			var unserButton = setTimeout(function(){
				$(".reorderButton").html("Reorder");
				$(".reorderButton").removeClass("reorderConfirm");
			}, 3000);
		});

		$(".orderFloatBox").on("click",".reorderConfirm", function(e){
			e.preventDefault();
			var order = $(this).attr("data-order");
			reOrder(order);
		});

		$(".orderFloatBox").on("click",".cancelOrderButton", function(e){
			e.preventDefault();
			$(".cancelOrderButton").html("Sure?");
			$(this).addClass("cancelConfirm");
			var unserButton = setTimeout(function(){
				$(".cancelOrderButton").html("Cancel");
				$(".cancelOrderButton").removeClass("cancelConfirm");
			}, 3000);

		});

		$(".orderFloatBox").on("click",".cancelConfirm", function(e){
			e.preventDefault();
			var order = $(this).attr("data-order");
			cancel(order);
		});

		function cancel(order)
		{
			$.ajax({
				type : 'POST',
				url : '/lang/ajax/cancelOrder.php',
				data : 'order_id='+order,

				beforeSend : function()
				{
					console.log("Sending to cancel order ajax");
					messageBox("Cancelling Order. Please wait..", "#34495e");
				},
				success : function(value)
				{
					console.log(value);
					if( value=='done' )
					{
						messageBox("Order Cancelled. Redirecting..", "#2ecc71");
						location.reload();
					}
					else {
						messageBox("Error Occurred. Try Later.", "#e74c3c");
					}
				}

			});
		}

		// DASHBOARD THINGS

	$(".dashMenuList li").click(function(e){
		$(".dashMenuList li").removeClass("active");
		$(this).addClass("active");
		if( e.target.className == "dashboardTab active" || $('.dashboardTab').find(e.target).length )
		{
			$(".dashView").html("");
			$(".dashView").load("dashboard.php #notid");
		}

		else if( e.target.className == "profileTab active" || $('.profileTab').find(e.target).length )
		{
			$(".dashView").html("");
			$(".dashView").load("/dashboard/profile.php #profilePage");
		}

		else if( e.target.className == "ordersTab active" || $('.ordersTab').find(e.target).length )
		{
			$(".dashView").html("");
			$(".dashView").load("/dashboard/allOrders.php #allOrders");
		}

		else if( e.target.className == "setsTab active" || $('.setsTab').find(e.target).length )
		{
			$(".dashView").html("");
			$(".dashView").load("/dashboard/settings.php #settingsPage");
		}
	});

	});
	</script>

	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>

</head>

<body class="no-class common">

<!-- Previous Order Float Canvas	 -->

<div class="orderFloatBox">
	<!-- COMING FROM AJAX -->
</div>

<div class="mainPage">
	<?php
			include('header.php');
			if( !isset($_SESSION['uid']) )
			{
				redirect("/");
			}


	?>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->

		<div class="dashWhole row">

			<div class="dashMenu">

				<div class="dash-back">
					<div class="menuBigPic">
						<img src="<?php echo $userImage; ?>" />
					</div>
				</div>

				<ul class="dashMenuList">
					<li class="dashboardTab active">
						<span class="icon-home"></span>
						<span class="mls">Dashboard</span>
					</li>
					<li class="profileTab">
						<span class="icon-account"></span>
						<span class="mls">Profile</span>
					</li>
					<li class="ordersTab">
						<span class="icon-basket"></span>
						<span class="mls">Orders</span>
					</li>
					<li class="setsTab">
						<span class="icon-settings"></span>
						<span class="mls">Settings</span>
					</li>
					<li>
						<span class="icon-wallet"></span>
						<span class="mls">New Option</span>
					</li>
					<li>
						<span class="icon-money"></span>
						<span class="mls">Offers</span>
					</li>
					<li>
						<span class="icon-clipboard-edit"></span>
						<span class="mls">Your Feedbacks</span>
					</li>
					<li>
						<span class="icon-help-with-circle"></span>
						<span class="mls">Goto Forum</span>
					</li>
				</ul>

			</div>

			<div class="dashCase">
				<div class="dashTop">

					<div class="dashName">
						<span class="icon-home"></span>
						<span class="mls">Dashboard</span>
					</div>

					<div class="userInfoBox">

						<div class="notiButton" title="Notifications">
							<span class="icon-notifications_active"></span>
							<span class="mls">3</span>
						</div>

						<div class="userBox">
							<span class="dashUsername"><?php echo $userName; ?></span>
						</div>

						<div class="userPic">
							<img src="<?php echo $userImage; ?>" />
						</div>

						<div class="clear"></div>
					</div>

					<div class="clear"></div>

				</div>

	<?php
					$uid = $_SESSION['uid'];

					$q = "SELECT COUNT( order_id ) , SUM( total_price ) , COUNT(order_rating)FROM `main_orders` WHERE uid ='$uid'";



					$res = $db->query($q);
					$result1 = $res->fetch_assoc();

	?>


				<div class="dashView">
					<div id="notid">
					<div class="profileStats" id="profileStats">
						<p>Veg Vendors Stats</p>

						<div class="statsWrapper">

							<div class="totalOrderStat statBox">
								<div>
									<span class="icon-basket"></span>
									<span class="mls">Total Orders</span>
								</div>

								<div class="statValue">
									<span class="mls"><?php echo $result1['COUNT( order_id )']; ?></span>
								</div>
							</div>

							<div class="totalSpentStat statBox">
								<div>
									<span class="icon-moneybag"></span>
									<span class="mls">Total Spent</span>
								</div>

								<div class="statValue">
									<span class="mls">₹<?php echo $result1['SUM( total_price )']; ?></span>
								</div>
							</div>

							<div class="totalFeedStat statBox">
								<div>
									<span class="icon-clipboard-edit"></span>
									<span class="mls">Feedbacks &amp; Reviews</span>
								</div>

								<div class="statValue">
									<span class="mls"><?php echo $result1['COUNT(order_rating)']; ?></span>
								</div>
							</div>

							<div class="clear"></div>
						</div>
					</div>

					<div class="row notificationToLoad">

						<div class="notificationPreview">
							<div>
								<span class="icon-notifications_active"></span>
								<span class="mls">Notifications</span>
							</div>

							<div class="notificationBox">
								<ul class="notifications">
									<li class="unread">Welcome to VegVendors Family
										<div class="deleteNotification" title="Delete">
											<span class="icon-trash-can"></span>
										</div>
									</li>
									<li class="read">Easy cash on delivery at your Doorsteps
										<div class="deleteNotification">
											<span class="icon-trash-can"></span>
										</div>
									</li>
									<li class="read">Special Offers only for you
										<div class="deleteNotification">
											<span class="icon-trash-can"></span>
										</div>
									</li>
									<li class="read">Please Verify your email id.
										<div class="deleteNotification">
											<span class="icon-trash-can"></span>
										</div>
									</li>
								</ul>
							</div>
						</div>

						<div class="dailyBuyPreview">
							<div>
								<span class="icon-wallet"></span>
								<span class="mls">Your New Option</span>
							</div>

							<div class="dailyBuyWrapper">
								<div class="emptyDailyBuy">
									<span class="icon-emoji-sad"></span><br>
									<span class="mls">No New Option</span>
								</div>
							</div>
						</div>

						<div class="clear"></div>

					</div>
				</div>

				</div>
			</div>

			<div class="clear"></div>

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

</html>
