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
		$place_code = $row['place_code'];
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

	<title><?php

				if($_GET['cat']==1)
				{
					echo "Lifeline Veggies";
				}
				if($_GET['cat']==2)
				{
					echo "Green Veggies";
				}
				if($_GET['cat']==3)
				{
					echo "Green Veggies 2";
				}
				if($_GET['cat']==4)
				{
					echo "Chutney Items";
				}


				?></title>
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

		// Change Vendor
		$(".changeSelectedVendor").click(function(){
			$(".mainPage").css({left: '-400px', opacity: '0.5'});
			$(".tunnel").css({right: '0px'});
			$(".tunnel-row-1").load("changeVendor.php?cat=<?php echo $_GET['cat']; ?> #changeVendorDiv", function(){

			});
		});

	});
	</script>

	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>

</head>

<body class="no-class common">
<div class="mainPage">
	<?php
		include('header.php');
	?>

	<section>

		<!-- Default Vendor Selection and fetching vendor -->

		<?php
		$cat = $_GET['cat'];
		$vendorPicture = "";
		$vendorName = "";
		$venId = 0;

		if( $cat == 1 )
		{
			if( isset($_SESSION['cat1vendor']) )
			{
				$venId = $_SESSION['cat1vendor'];
				$squery = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$venId'");

				$srow = $squery->fetch_assoc();

				$vendorPicture = $srow['pic'];
				$vendorName = $srow['name'];
			}
		}

		else if( $cat == 2 )
		{
			if( isset($_SESSION['cat2vendor']) )
			{
				$venId = $_SESSION['cat2vendor'];
				$squery = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$venId'");

				$srow = $squery->fetch_assoc();

				$vendorPicture = $srow['pic'];
				$vendorName = $srow['name'];
			}
		}

		else if( $cat == 3 )
		{
			if( isset($_SESSION['cat3vendor']) )
			{
				$venId = $_SESSION['cat3vendor'];
				$squery = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$venId'");

				$srow = $squery->fetch_assoc();

				$vendorPicture = $srow['pic'];
				$vendorName = $srow['name'];
			}
		}

		else if( $cat == 4 )
		{
			if( isset($_SESSION['cat4vendor']) )
			{
				$venId = $_SESSION['cat4vendor'];
				$squery = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$venId'");

				$srow = $squery->fetch_assoc();

				$vendorPicture = $srow['pic'];
				$vendorName = $srow['name'];
			}
		}
		?>

		<div class="row filterRow" style="margin-top: 20px;">
			<div class="left" style="padding-top: 15px;">
				<span class="mls">Veg Vendors - Category <?php

				if($_GET['cat']==1)
				{
					echo "Lifeline Veggies";
				}
				if($_GET['cat']==2)
				{
					echo "Green Veggies";
				}
				if($_GET['cat']==3)
				{
					echo "Green Veggies 2";
				}
				if($_GET['cat']==4)
				{
					echo "Chutney Items";
				}


				?></span>
			</div>

			<div class="right">
				<div class="selectedVendorBox">
					<div class="selectedVendorPic left changeSelectedVendor" title="Change Vendor">
						<img src="<?php echo $vendorPicture; ?>" />
					</div>

					<div class="selectedVendorInfo left">
						<div class="selectedVendorName">
							<span class="mls"><?php echo $vendorName; ?> - [id: <?php echo $venId; ?>]</span>
						</div>
						<div class="selectedVendorClick">
							<span class="mls"><strong>Selected Vendor</strong></span>
						</div>
					</div>

					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>
		</div>


		<div class="row">

<?php
			$cat=$_GET['cat'];
		    $sabzi_id=$_GET['sc'];

			 $query1 = $db->query("select * FROM sabziz s inner join sabzi_price sp on s.sabzi_id = sp.sabzi_id WHERE s.sabzi_category = '$cat' AND s.sabzi_id = '$sabzi_id' and sp.place_code= '$place_code'");
			while ($row1=$query1->fetch_assoc())
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

			 $query1 = $db->query("select * FROM sabziz s inner join sabzi_price sp on s.sabzi_id = sp.sabzi_id WHERE s.sabzi_category = '$cat' AND s.sabzi_id != '$sabzi_id' and sp.place_code= '$place_code'");
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

		<div class="row aboutDiv" style="padding: 10px 40px;">
			<h3>Fact File</h3>

			<p style="margin-top: 5px;">Dedicated to fulfilling your wishes without any hassle, VegVendors ensures that everything from placing an order to having it delivered right to doorstep goes smoothly and efficiently.</p>
		</div>

		<div class="row">

				<h3 class="vegHeadings">EASY COMBO</h3>

<?php


			 $query1 = $db->query("select * FROM sabziz s inner join sabzi_price sp on s.sabzi_id = sp.sabzi_id WHERE sp.place_code= '$place_code' ORDER BY rand() LIMIT 4");
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
