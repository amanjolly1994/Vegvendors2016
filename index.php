<?php
	//Include Database configuration File dbConfig.php
	session_start();

	include('dbConfig.php');

	// Checking whether a location cookie is set or not
	$shownArea = "";

	if(isset($_POST["subarea"])&&(!empty($_POST["subarea"])))
	{
		unset($_SESSION['cat1vendor']);
		unset($_SESSION['cat2vendor']);
		unset($_SESSION['cat3vendor']);
		unset($_SESSION['cat4vendor']);

		$areacode = $_POST["area"];
		$subareacode = $_POST["subarea"];

		$shownArea = $_POST["subarea"];

		setcookie("subareacode", $subareacode, time()+(86400 * 30), "/");

		$query = $db->query("SELECT * FROM subareas WHERE sno = '$shownArea'");

		$rowCount = $query->num_rows;

		if( $rowCount > 0 )
		{
			$row = $query->fetch_assoc();
			$place_code = $row['place_code'];
			setcookie("place_code", $place_code, time()+(86400 * 30), "/");
		}

		include_once('lang/phpFiles/autoVendor.php');
	}

	else if( isset($_COOKIE["subareacode"]) )
	{
		$shownArea = $_COOKIE["subareacode"];
		include_once('lang/phpFiles/autoVendor.php');
	}

	else
	{
		redirect("/login.php");
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />

	<!-- SEO SECTION -->

		<!-- SEO and Meta goes here -->

		<meta property="og:title" content="VEGVENDORS" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="" />
	    <meta property="og:image" content=""/>

	    <meta name="description" content="It is an on-demand delivery service that connects you to the nearest vegetable hawkers .Veg Vendors aim is to amend the traditional way of people buying groceries to make the local shopping experience more convenient and amicable. We are substituting your visits to the nearby vegetable hawkers with a few taps on the mobile/laptop/computer/tab.This is a user-friendly site/app which provides easy surfing and also offers easy modes of payments-Credit/Debit card, Cash on Delivery (COD), E-wallet/paytm.So, if you want fresh veggies on your doorstep, just go to www.vegvendors.in" />

	    <meta name="keywords" content="vegvendors.com,vegvendors.in,sabji,sabzi,sabjiwala ,sabjiwaala,sabziwaalaonline vegetable shopping,veggie, veggies,vegetables online, veg, shop,peddler,vegetable,vegetables,hawker,vendor,vegetable vendor,vegvendor,veg vendor,vender,veg vender,vegvender,online grocery store,purchase,buy vegetables,buy,bye, home delivery,delivery, doorstep,how to order vegetables,sabzi online,online on demand,vendor,vender online,vegvenders.com,vegvenders.in,shopping india,buy groceries online,online grocery in delhi,online grocery in rohini,online " />
		<meta name="author" content="VEGVENDORS" />

		<link rel="canonical" href="http://www.vegvendors.in/" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="VEGVENDORS" />
		<meta property="og:description" content="It is an on-demand delivery service that connects you to the nearest vegetable hawkers .Veg Vendors aim is to amend the traditional way of people buying groceries to make the local shopping experience more convenient and amicable. We are substituting your visits to the nearby vegetable hawkers with a few taps on the mobile/laptop/computer/tab.This is a user-friendly site/app which provides easy surfing and also offers easy modes of payments-Credit/Debit card, Cash on Delivery (COD), E-wallet/paytm.So, if you want fresh veggies on your doorstep, just go to www.vegvendors.in"/>
		<meta property="og:site_name" content="VEGVENDORS" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="google-site-verification" content="_A34w7fD16XO_eLt8tLHJno7961D_MImB1Vg0g8sRRM" />
		<meta name="google-signin-client_id" content="966617801310-2cot46e2pdv28kjsgv2d4rsmpg18791c.apps.googleusercontent.com">
		<!-- Meta Ends -->
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
	<script type="text/javascript" src="/lang/js/social-login.js" async defer></script>
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
	<meta name="google-site-verification" content="_A34w7fD16XO_eLt8tLHJno7961D_MImB1Vg0g8sRRM" />
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80067919-1', 'auto');
  ga('send', 'pageview');

</script>


	</head>

<body class="no-class common">
<div class="mainPage">
	<div class="homeBigDisplay">
	<?php
			include_once('header.php');

			//TO PRINT MESSAGES ON HOME PAGE FROM URL
			if( isset($_GET['wtp']) )
			{
				if( $_GET['wtp'] == "cf" )
				{
					?>
					<script type="text/javascript">messageBox("You are already registered via google.","#F62217");</script>
					<?php
				}

				if( $_GET['wtp'] == "cg" )
				{
					?>
					<script type="text/javascript">messageBox("You are already registered via facebook.","#F62217");</script>
					<?php
				}

				if( $_GET['wtp'] == "eactd" && isset($_SESSION['activation']) )
				{
					?>
					<script type="text/javascript">messageBox("Your email have been verified. Thank you.","#2ecc71");</script>
					<?php
				}

				if( $_GET['wtp'] == "nact" )
				{
					?>
					<script type="text/javascript">messageBox("Sorry, Activation code is not available.","#e74c3c");</script>
					<?php
				}
			}

	?>

	<!-- Home page UI style -->
	<script type="text/javascript">


		if (window.matchMedia('(max-width: 500px)').matches) {
			$(".main-logo-holder .logo .logo-responsive").attr("src", "/theme/images/logos/full-logo.png");
			$(".taskbar-phoneNo").css({color: '#616161'});
			$(".address-box").css({color: '#616161'});
			$(".head-location-input").css({color: '#616161', background: 'url(/theme/images/icons/down4-50.png) no-repeat', backgroundColor: 'none', backgroundSize: '12px 12px', backgroundPosition: 'right'});

    } else {
			$(".main-logo-holder .logo .logo-responsive").attr("src", "/theme/images/logos/full-logo-white.png");
			$(".taskbar-phoneNo").css({color: '#fff'});
			$(".address-box").css({color: '#fff'});
			$(".head-location-input").css({color: '#fff', background: 'url(/theme/images/icons/drop-arrow_03.png) no-repeat', backgroundColor: 'none', backgroundSize: '12px 12px', backgroundPosition: 'right'});
    }
	</script>

	<section>
		<div class="display">
			<!-- <div class="slideHolder hasShadow">


			</div>

			<div class="rightDisplay">
				<div class="rightTopBox hasShadow">
					<img src="/theme/images/pictures/vendor-tab.jpg" alt="vegvendors delivery"/>
				</div>

				<div class="rightTopBox hasShadow leave10">
					<img src="/theme/images/pictures/discount.jpg" alt="vegvendors discount" />
				</div>
			</div> -->

			<div class="clear"></div>
		</div>
	</section>
	</div>

	<section>


		<div class="row">

			<div class="vegyRow">

				<h3 class="vegHeadings leaveLeft">Quick Buy</h3>


	<?php

			$query1 = $db->query("select * FROM sabziz s inner join sabzi_price sp on s.sabzi_id = sp.sabzi_id WHERE s.sabzi_category = '1' and sp.place_code= '$place_code' LIMIT 3 " );
			 while($row1=$query1->fetch_assoc())
			{
			 	$sabziArray = explode(' ', $row1['sabzi_name']);
			 	$sabzi_name = $sabziArray[0];

?>

				<div class="itemTab vegTab">

					<div class="topRowOptions">
						<div class="addDailyBuyButton hoverGreen">
							<span class="icon-restaurant_menu"></span>
						</div>
						<div class="offerBoxDiv <?php echo $sabzi_name; ?>">
							<span class="mls">0.0</span>Kg (Basket)
						</div>
						<div class="clear"></div>
					</div>

					<div class="vegetableImageDiv">
						<div class="vegetableImageWrapper">
							<img src="<?php echo $row1['sabzi_pic'];?>" alt="<?php echo $row1['alt'];?>"/>
						</div>
					</div>

					<div class="vegetableName">
						<span class="mls"><?php echo $row1['sabzi_name'];?></span>
					</div>

					<div class="vegetableCost">
						<span class="mls">₹<?php echo $row1['price_per_kg'];?>/Kg</span>
					</div>

					<div class="addToCart">

						<button class="minusMass twitchButton">-</button>
						<button class="addToCartButton" data-image="<?php echo $row1['sabzi_pic']; ?>" data-rate="<?php echo $row1['rate']; ?>" data-name="<?php echo $row1['sabzi_name'];?>" data-price="<?php echo $row1['price_per_kg'];?>" data-category="<?php echo $row1['sabzi_category']; ?>" >Add <span class="currentMass"></span> Kg to Cart</button>
						<button class="addMass twitchButton">+</button>

						<div class="clear"></div>

					</div>

					<script type="text/javascript">
						var cartArray = JSON.parse(localStorage.getItem("shoppingCart"));

						for( var i in cartArray )
						{
							var currentName = "<?php echo $sabzi_name; ?>";
							if( cartArray[i].name == currentName )
							{
								if( cartArray[i].count != 0 || cartArray[i].count != null )
								{
									$("<?php echo '.'.$sabzi_name; ?> .mls").text(Number(cartArray[i].count).toFixed(1));
									$("<?php echo '.'.$sabzi_name; ?>").fadeIn();
								}
							}
						}
					</script>

				</div>

	<?php

}
?>

			</div>

			<div class="clear"></div>
		</div>
	</section>

	<section>
		<div class="row">

				<h3 class="vegHeadings">Random Vegetables</h3>




			<?php


			 $query1 = $db->query("select * FROM sabziz s inner join sabzi_price sp on s.sabzi_id = sp.sabzi_id WHERE sp.place_code= '$place_code' AND (s.sabzi_id !='1' AND s.sabzi_id !='2' AND s.sabzi_id !='3') ORDER BY rand() LIMIT 4");
			 while($row1=$query1->fetch_assoc())
			{

			 $sabziArray = explode(' ', $row1['sabzi_name']);
			 $sabzi_name = $sabziArray[0];

?>


				<div class="itemTab vegTab">

					<div class="topRowOptions">
						<div class="addDailyBuyButton hoverGreen">
							<span class="icon-restaurant_menu"></span>
						</div>
						<div class="offerBoxDiv <?php echo $sabzi_name; ?>">
							<span class="mls">0.0</span>Kg (Basket)
						</div>
						<div class="clear"></div>
					</div>

					<div class="vegetableImageDiv">
						<div class="vegetableImageWrapper">
							<img src="<?php echo $row1['sabzi_pic'];?>" alt="<?php echo $row1['alt'];?>"/>
						</div>
					</div>

					<div class="vegetableName">
						<span class="mls"><?php echo $row1['sabzi_name'];?></span>
					</div>

					<div class="vegetableCost">
						<span class="mls">₹<?php echo $row1['price_per_kg'];?>/Kg</span>
					</div>

					<div class="addToCart">

						<button class="minusMass twitchButton">-</button>
						<button class="addToCartButton" data-image="<?php echo $row1['sabzi_pic']; ?>" data-rate="<?php echo $row1['rate']; ?>" data-name="<?php echo $row1['sabzi_name'];?>" data-price="<?php echo $row1['price_per_kg'];?>" data-category="<?php echo $row1['sabzi_category']; ?>" >Add <span class="currentMass"></span> Kg to Cart</button>
						<button class="addMass twitchButton">+</button>

						<div class="clear"></div>

					</div>

					<script type="text/javascript">
						var cartArray = JSON.parse(localStorage.getItem("shoppingCart"));

						for( var i in cartArray )
						{
							var currentName = "<?php echo $sabzi_name; ?>";
							if( cartArray[i].name == currentName )
							{
								if( cartArray[i].count != 0 || cartArray[i].count != null )
								{
									$("<?php echo '.'.$sabzi_name; ?> .mls").text(Number(cartArray[i].count).toFixed(1));
									$("<?php echo '.'.$sabzi_name; ?>").fadeIn();
								}
							}
						}
					</script>

				</div>

<?php
}
?>

			<div class="clear"></div>
		</div>
	</section>

	<section>
		<div class="row">

			<div class="rowHeading">
				<h3><span>Vendors</span></h3>
				<h4>Active vegetable vendors near your location</h4>
			</div>

			<div class="subRow">
				<?php

				//FETCHING VENDORS
	if(isset($shownArea)&&(!empty($shownArea)))
	{
		 $query1 = $db->query("select * FROM sabzi_wala WHERE place_code = '$place_code' ORDER BY rand() LIMIT 4");
		while($row=$query1->fetch_assoc())
		{



				?>
				<div class="itemTab vendorTab">

					<div class="vendorImage">
					<p><a href="vendor.php?id=<?php echo $row['svid']; ?>"><img src="<?php echo $row['pic']; ?>" /></a></p>

					</div>

					<div class="vegetableName">
						<span class="mls"> <?php echo $row['name']; ?></span>
					</div>

					<div class="vegetableCost">
						<span class="mls">Id: VT98YI02<?php echo $row['svid']; ?></span>
					</div>

					<div class="vegetableCost" style="margin-top: 20px; font-size: 16px;">
						<span class="mls">Deals in:</span>
					</div>

					<div class="vegetableName" style="margin-top: 2px; font-size: 14px; color: #717171;">
						<span class="mls"><?php

						$category1 = "";
						$category2 = "";
						$category3 = "";
						$category4 = "";

						if ($row['sabzi_category1']==1)
						{
							$category1="Lifeline Veggies";
						}
						if ($row['sabzi_category2']==1)
						{
							$category2="Green Veggies";
						}
						if ($row['sabzi_category3']==1)
						{
							$category3="Green Veggies 2";
						}
						if ($row['sabzi_category4']==1)
						{
							$category4="Chutney Items";
						}


						echo $category1." ".$category2." ".$category3." ".$category4 ;

						?></span>
					</div>


					<div style="text-align: center; margin-top: 15px;">
						<a href="vendor.php?id=<?php echo $row['svid']; ?>"><button class="vendorProfile">View Vendor Profile</button></a>

					</div>

				</div>
				<?php

					}


	}

				?>



				<div class="clear"></div>

			</div>

		</div>
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

			<div class="tunnel-account" id="tunnel-account">
				<div class="menuBigPic">
					<img src="<?php echo $userImage; ?>" />
				</div>

				<div class="tunnel-account-name">
					<span><?php echo $userName; ?></span>
				</div>

				<ul class="tunnel-account-menu">
					<?php
						if( isset($_SESSION['uid']) )
						{
					?>
							<a href="dashboard.php"><li>Dashboard</li></a>
							<a href="dashboard.php"><li>Notifications</li></a>
							<a href="/lang/phpFiles/logout.php"><li>Logout</li></a>
					<?php
						}

						else
						{
					?>
							<li>Login to your account</li>
							<li>Create a new account</li>
					<?php
						}
					?>

				</ul>
			</div>

		</div>

		<div class="tunnel-row-2">



		</div>

	</div>

</div>

<!-- SIDE TUNNEL ENDS -->

<div class="clear"></div>

</body>

</html>
