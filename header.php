<?php
	//Getting the name of subarea using subarea code
	 $query = $db->query("SELECT * FROM subareas WHERE sno = '$shownArea'");

	 $rowCount = $query->num_rows;

	 if( $rowCount > 0 )
	 {
	 	$row = $query->fetch_assoc();
	 	$subareaName = $row['subareas'];
		$place_code = $row['place_code'];

		$query2 = $db->query("SELECT * FROM places WHERE place_code = '$place_code'");
		$row2 = $query2->fetch_assoc();

		$area_code = $row2['area'];

		$query3 = $db->query("SELECT * FROM area_table WHERE id = '$area_code'");
		$row3 = $query3->fetch_assoc();

		$placeName = $row3['area'];
	 }

	else
		redirect("login.php");
?>

<script type="text/javascript">

	$(function(){

		$(".search-in-head").keyup(function(){

			var searchid = $(this).val();
			var dataString = 'search='+searchid;
			if( searchid!='' )
			{
				$.ajax({
					type: 'POST',
					url: '/lang/phpFiles/search.php',
					data: dataString,
					cache: false,

					success: function(rel)
					{
						if( rel == "not" )
							$(".result").html("<div class='not-found'>No result found. Try Again.</div>");
						else
							$(".result").html(rel).show();
					}
				});
			}
			return false;

		});

		$(".result").live("click", function(e){
			var $clicked = $(e.target);
			var $name = $clicked.find('.search-show-name').html();
			var decode = $('<div/>').html($name).text();
			$('#searchid').val(decode);
		});

		$(document).live("click", function(e){
			var $clicked = $(e.target);
			if( ! $clicked.hasClass("search-in-head") )
				$('.result').fadeOut();
		});

		$("#searchid").click(function(){
			$(".result").fadeIn();
		});

	});

</script>

<header>

	<div title="Basket" class="float-checkout-button">
		<a href='/basket'><img src="/theme/images/icons/commerce.png" /></a>
	</div>

	<div class="canvas-box-holder">
		<div class="canvas-box">
			<div class="canvas-content">
				<!-- JS INSERT -->
				
			</div>
		</div>
	</div>

		<div id="taskbar">
			<section>

				<div class="main-logo-holder">
					<a href="/" class="logo">
						<img src="/theme/images/logos/full-logo.png" class="logo-responsive" alt="Veg Vendors" title="Veg Vendors" />
					</a>
				</div>

				<div class="address-box">
					<span class="icon-pin"></span>
					<label>Delivery at</label>
					<div style="display:inline-block; position:relative;" >
						<input type="text" name="location" class="head-location-input" value="<?php echo $subareaName.', '.$placeName; ?>" />
						<div class="head-loc-clickable" style="position:absolute; left:0; right:0; top:0; bottom:0;"></div>
					</div>
				</div>

				<div class="clearfix taskbar-phoneNo">
					<span class="icon-phone"></span>
					<span class="mls">+91-9313001876</span>
				</div>

				<div class="clear"></div>

			<section>
		</div>

		<nav>
			<section>
				<div  class="navigation">

					<div class="box-category-heading">
						<span class="icon-menu-bar"></span>
						<span class="mls">Category</span>
					</div>

					<div class="category-box">
						<ul class="catMenu menu">
							<a href="pcveg?cat=1"><li><span>Lifeline Veggies</span></a>
								<div class="subMenuHolder">
								<ul class="subMenu categoryMenu1">
									<a class="sub-heading">Lifeline Veggies</a>
									<li><a href="pcveg.php?cat=1&sc=1">Potato (आलू)</a></li>
									<li><a href="pcveg.php?cat=1&sc=2">Onion (प्याज़)</a></li>
									<li><a href="pcveg.php?cat=1&sc=3">Tomato (टमाटर)</a></li>
								</ul>
								</div>
							</li>

							<a href="pcveg?cat=2"><li><span>Green Veggies</span></a>
								<div class="subMenuHolder">
								<ul class="subMenu categoryMenu2">
									<a class="sub-heading">Green Veggies</a>
									<li><a href="pcveg.php?cat=2&sc=4">Cabbage (पत्ता गोभी)</a></li>
									<li><a href="pcveg.php?cat=2&sc=5">Carrot (गाजर)</a></li>
									<li><a href="pcveg.php?cat=2&sc=6">Radish (मूली)</a></li>
									<li><a href="pcveg.php?cat=2&sc=7">Peas (हरी मटर)</a></li>
									<li><a href="pcveg.php?cat=2&sc=8">French Beans (फ्रांस फली)</a></li>
									<li><a href="pcveg.php?cat=2&sc=9">Jackfruit (कटहल)</a></li>
									<li><a href="pcveg.php?cat=2&sc=10">Ridge Gourd (तोरी/तुरई)</a></li>
									<li><a href="pcveg.php?cat=2&sc=11">Sweet corn (मक्का)</a></li>
									<li><a href="pcveg.php?cat=2&sc=12">Broccoli (ब्रोक्कोली)</a></li>
									<li><a href="pcveg.php?cat=2&sc=13">Cucumber (खीरा)</a></li>
									<li><a href="pcveg.php?cat=2&sc=41">Arbi (अरबी)</a></li>
									<li><a href="pcveg.php?cat=2&sc=15">Capsicum (Green) (हरी शिमला मिर्च)</a></li>
								</ul>
								</div>
							</li>

							<a href="pcveg?cat=3"><li>
								<span>Green Veggies 2</span></a>
								<div class="subMenuHolder">
								<ul class="subMenu categoryMenu3">
									<a class="sub-heading">Green Veggies 2</a>
									<li><a href="pcveg.php?cat=3&sc=16">Cauliflower (फूल गोभी)</a></li>
									<li><a href="pcveg.php?cat=3&sc=17">Sarso Saag (सरसों का साग)</a></li>
									<li><a href="pcveg.php?cat=3&sc=18">Spinach (पालक)</a></li>
									<li><a href="pcveg.php?cat=3&sc=19">Ladyfinger (भिन्डी / ओकरा)</a></li>
									<li><a href="pcveg.php?cat=3&sc=20">Green Beans (ग्वार फली)</a></li>
									<li><a href="pcveg.php?cat=3&sc=21">Brinjal (बैंगन)</a></li>
									<li><a href="pcveg.php?cat=3&sc=22">Round Gourd (टिंडा)</a></li>
									<li><a href="pcveg.php?cat=3&sc=23">Pumpkin (कद्दू / सीता फल)</a></li>
									<li><a href="pcveg.php?cat=3&sc=24">Bottle Gourd (घीया/ लौकी)</a></li>
									<li><a href="pcveg.php?cat=3&sc=25">Lettuce (सलाद पत्ता)</a></li>
									<li><a href="pcveg.php?cat=3&sc=26">Mushroom (मशरुम)</a></li>
									<li><a href="pcveg.php?cat=3&sc=27">Olives (जैतून)</a></li>
								</ul>
								</div>
							</li>

							<a href="pcveg?cat=4"><li>
								<span>Chutney Items</span></a>
								<div class="subMenuHolder">
								<ul class="subMenu categoryMenu4">
									<a class="sub-heading">Chutney Items</a>
									<li><a href="pcveg.php?cat=4&sc=28">Lemon (नीम्बू)</a></li>
									<li><a href="pcveg.php?cat=4&sc=29">Ginger (अदरक)</a></li>
									<li><a href="pcveg.php?cat=4&sc=30">Peppermint (पुदीना)</a></li>
									<li><a href="pcveg.php?cat=4&sc=31">Coriander Leaves (हरा धनिया)</a></li>
									<li><a href="pcveg.php?cat=4&sc=32">Gooseberry (आँवला)</a></li>
									<li><a href="pcveg.php?cat=4&sc=33">Sweet Potato (शकरकंद)</a></li>
									<li><a href="pcveg.php?cat=4&sc=34">Turnip (शलगम)</a></li>
									<li><a href="pcveg.php?cat=4&sc=35">Garlic (लहसुन)</a></li>
									<li><a href="pcveg.php?cat=4&sc=36">Bitter Gourd (करेला)</a></li>
									<li><a href="pcveg.php?cat=4&sc=37">Chillies (Red &amp; Green) (मिर्च)</a></li>
									<li><a href="pcveg.php?cat=4&sc=38">Bell Pepper(Red &amp; Yellow) (लाल और पीली शिमला मिर्च)</a></li>
									<li><a href="pcveg.php?cat=4&sc=42">Kachi Ambi (कच्ची अम्बी)</a></li>
									<li><a href="pcveg.php?cat=4&sc=40">Methi (मेथी)</a></li>

								</ul>
								</div>
							</li>
						</ul>
					</div>

<?php

	// USER INFO EMPTY VARIABLES


     $userName = "My Account";
     $userImage = "/content/profile_photos/vegvendor_black_dp.png";

if( isset($_SESSION['uid']) )
	{
		$uid = $_SESSION['uid'];


		$qq = $db->query(" SELECT * FROM registered_users WHERE uid='$uid' ");
		while($userInfo = $qq->fetch_assoc())
		{
			$userName = $userInfo["user_name"];
			if( $userInfo["pic"] != null || $userInfo["pic"] != "" )
				$userImage = $userInfo["pic"];

		}
	}
?>

					<div class="my-account-tab">
						<span class="icon-account"></span>
						<span class="mls"><?php echo $userName; ?></span>

						<!-- MY ACCOUNT SUB MENU -->
						<!-- <div class="account-subMenu">

							<div class="account-img-holder">
								<img src="/theme/images/icons/default-pic.png" />
							</div>

							<div class="myaccount-menu">
								<ul>
									<li>Your Orders</li>
									<li>Your Settings</li>
									<li>New User? Register</li>
									<li><span>Login</span></li>
								</ul>
							</div>

							<div class="clear"></div>

						</div> -->
					</div>

					<div class="cart-tab">
						<span class="icon-basket"></span>
						<span class="mls">Basket</span>
						<span class="item-number">0</span>
					</div>

					<div class="search-tab">
						<span class="icon-search"></span>
						<span class="mls">Search</span>
					</div>

					<div class="search-div">
						<input type="text" id="searchid" class="search-in-head" name="search" placeholder="what are you looking for?" autocomplete="off" />
						<button title="Search" type="submit" class="searchButton">
							<span class="icon-search"></span>
						</button>
						<div class="result"></div>
					</div>

					<!-- SEARCH DIVISION -->

					<!-- <div id="searchBox" class="searchBox">

						<div class="search-row-1">
							<div class="search-text-1">
								<span>Search for Vegetables &amp; Vendors</span>
							</div>
							<div class="search-text-2">
								<span>Start Typing</span>
							</div>

							<div class="close-search-holder">
								<span title="Close" class="close close-search">X</span>
							</div>
						</div>

						<div class="search-row-2">
							<div class="search-holder">
								<input type="search" autocomplete="off" class="searchBar" name="search" placeholder="What are you looking for" />

								<button title="Search" type="submit" class="searchButton">
									<span class="icon-search"></span>
								</button>
							</div>
						</div>

					</div> -->

					<div class="clear"></div>
				</div>
			</section>
		</nav>

	</header>

	<!-- New Floating Popup -->



	<!-- Nwe Floating Popup ends -->

<?php
					$ven1 = $_SESSION['cat1vendor'];
					$ven2 = $_SESSION['cat2vendor'];
					$ven3 = $_SESSION['cat3vendor'];
					$ven4 = $_SESSION['cat4vendor'];

					$query = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$ven1' ");
					$row = $query->fetch_assoc();

					?>
					<script type="text/javascript">
					var ven1id = "<?php echo $ven1; ?>";
					var ven1name = "<?php echo $row['name']; ?>";
					console.log(ven1name);
					var ven1pic = "<?php echo $row['pic']; ?>";
					</script>
					<?php

					$query = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$ven2' ");
					$row = $query->fetch_assoc();

					?>
					<script type="text/javascript">
					var ven2id = "<?php echo $ven2; ?>";
					var ven2name = "<?php echo $row['name']; ?>";
					console.log(ven2name);
					var ven2pic = "<?php echo $row['pic']; ?>";
					</script>
					<?php

					$query = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$ven3' ");
					$row = $query->fetch_assoc();

					?>
					<script type="text/javascript">
					var ven3id = "<?php echo $ven3; ?>";
					var ven3name = "<?php echo $row['name']; ?>";
					console.log(ven3name);
					var ven3pic = "<?php echo $row['pic']; ?>";
					</script>
					<?php

					$query = $db->query("SELECT * FROM sabzi_wala WHERE svid = '$ven4' ");
					$row = $query->fetch_assoc();

					?>
					<script type="text/javascript">
					var ven4id = "<?php echo $ven4; ?>";
					var ven4name = "<?php echo $row['name']; ?>";
					console.log(ven4name);
					var ven4pic = "<?php echo $row['pic']; ?>";
					</script>
					<?php

					?>
