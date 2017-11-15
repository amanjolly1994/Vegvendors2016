<?php
	//Include Database configuration File dbConfig.php
	session_start();

	include('dbConfig.php');

	$optionCol3 = '<li class="changeSignup">Create an account</li>';
	$optionCol2 = '<li class="changeLogin">Sign in</li>';

	if( isset($_SESSION['uid']) )
	{
		$optionCol2 = '<li class="logoutClass">Logout</li>';
		$optionCol3 = '<a href="dashboard.php"><li class="dashboardRedirect">'.$_SESSION["uname"].'</li></a>';
	}

	// Checking whether location cookie is preselected or not
	if( isset($_COOKIE["subareacode"]) )
	{
		//Preselect option in the select Menu
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
	<meta name="google-signin-client_id" content="966617801310-2cot46e2pdv28kjsgv2d4rsmpg18791c.apps.googleusercontent.com">

	<!-- SEO SECTION -->
		<?php

		include("seo.php");


		?>

	<title>VegVendors Login</title>
	<link rel="shortcut icon" href="http://vegvendors.in/favicon.png" />

	<!-- Style Links -->

	<link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

	<!-- BootLINK CSS -->

	<link rel="stylesheet" href="dist/css/bootstrap-select.min.css">
  	<link rel="stylesheet" href="dist/css/bootstrap-select.css">

	<!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>
	<script type="text/javascript" src="/lang/js/h-tunnel.js" ></script>
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>
	<script type="text/javascript" src="/json-test/dynamicLocation.js"></script>

	<!-- BootScript Js -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/lang/js/social-login.js" async defer></script>
	<script src="dist/js/bootstrap-select.js"></script>

	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/registration_ajax.js"></script>
	<script type="text/javascript" src="/lang/ajax/login_ajax_script.js"></script>


	<!-- AJAX CONFIGURATION FOR AREA SECTION -->
	<script type="text/javascript">
	$(document).ready(function(){
	// Select Location Loading
		$("#location").on("change", "#areaSelect", function(){
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

	<style>
		/*.loginTopper li:hover{
			text-decoration: underline;
		}*/
		.loginTopper .active{
			font-weight: bold;
			color: #27ae60;
		}
	</style>

</head>

<body class="no-class common">

	<section>
		<div class="loginTopper">
			<ul>
				<li class="againLocation active">Location</li>
				<?php echo $optionCol2; ?>
				<?php echo $optionCol3; ?>

			</ul>
		</div>
	</section>

	<section>
		<div id="loginPage">

			<div id="loginVector">
				<div class="vegVectorHolder">
					<img src="/theme/images/pictures/login-vector.png" />
				</div>

				<div class="fullLogoHolder">
					<img src="/theme/images/logos/full-logo.png" />
				</div>
			</div>

			<div id="loginWrapper" class="hasShadow">
				<div id="loginBox">

					<div id="location">


					<?php
						//Get Area Data from db
						$query = $db->query("SELECT * FROM area_table ORDER BY area ASC");

						//total no of rows
						$rowCount = $query->num_rows;
					?>

						<p class="sideLines"><span>Select Location</span></p>

						<!-- <p style="margin-top: 10px; text-align: center; font-family: robotoLight;"><span>New Delhi Region</span></p>						 -->

					<form action="/" name="locationForm" id="locationForm" method="post" class="form-inline loginForm" enctype="multipart/form-data">

						<div class="catLoc">
					    <div class="form-group">
					      <label class="col-md-1 control-label" for="lunch">Area:</label>
					    </div>
					    <div class="form-group sendingRight1">
					      <select id="areaSelect" required name="area" class="selectpicker" data-live-search="true" title="Please select your area">

							<option value="">Select your Area</option>

					    <?php
					    	//Fetching areas from db
					    	if($rowCount > 0){
					    		while($row = $query->fetch_assoc())
					    		{
					    			echo '<option value="'.$row['id'].'">'.$row['area'].'</option>';
					    		}
					    	}
					    	else{
					    		echo '<option value="">area not available</option>';
					    	}
					    ?>


					      </select>
					    </div>
						</div>

			 			<div class="catLoc">
					    <div class="form-group">
					      <label class="col-md-1 control-label" for="lunch">Sub-Area:</label>
					    </div>
					    <div class="form-group sendingRight2">
					      <select id="subAreaSelect" required name="subarea" class="selectpicker" data-live-search="true" title="Please select your Subarea">
					        <option>Select area first</option>


					      </select>
					    </div>
						</div>

						<input type="submit" value="Proceed" />

			  		</form>

			  			<p style="margin-top: 10px; text-align: center; font-family: robotoLight;">* Both fields are compulsory to proceed.</p>


					</div>

					<div id="login">
					<p class="sideLines"><span>Sign In Via</span></p>

					<div class="socialLoginBox">
						<div class="facebookLoginButton" onclick="loginFB()">
							<span class="icon-social-facebook font20"></span>
							<span class="mls">facebook</span>
						</div>

						<div id="gSignIn" class="g-signin2 googleLoginButton"></div>

						<div class="clear"></div>
					</div>

					<p class="sideLines leave10"><span>Or Use Email</span></p>

					<form class="loginForm" id="loginForm" method="post">

						<div class="input">

						<input type="email" name="user_email" placeholder="Email Address" required  style="text-transform: lowercase" />

						<span class="icon-mail-envelope-closed"></span>

						</div>

						<div class="input">

						<input type="password" name="user_password" placeholder="Password" required />

						<span class="icon-lock"></span>

						</div>
						<input type="submit" value="Login" />

						<a href="/forgotPassword/"><p class="forgotPassword">forgot password?</p></a>

						<p class="signUpPage">Don't have an account? <a href="#" class="changeSignup">Sign Up</a></p>

					</form>

				</div>

				<div id="signUp">
					<p class="sideLines"><span>Sign Up Via</span></p>

					<div class="socialLoginBox">
						<div class="facebookLoginButton" onclick="loginFB()">
							<span class="icon-social-facebook font20"></span>
							<span class="mls">facebook</span>
						</div>

						<div class="g-signin2 googleLoginButton" data-width="150" data-height="35"></div>

						<div class="clear"></div>
					</div>

					<p class="sideLines leave10"><span>Or Use Email</span></p>

					<form class="loginForm" method="post" id="registrationForm" name="registrationForm">

						<div class="input">

						<input type="text" name="full_name" placeholder="Full Name" required />

						<span class="icon-account"></span>

						</div>

						<div class="input">

						<input type="email" name="user_email" placeholder="Email Address"  style="text-transform: lowercase" required />

						<span class="icon-mail-envelope-closed"></span>

						</div>

						<div class="input">

						<input type="password" name="user_password" placeholder="Password" required />

						<span class="icon-lock"></span>

						</div>
						<input type="submit" value="Get Started" />

						<p class="signUpPage">Already have an account? <a href="#" class="changeLogin">Login</a></p>

					</form>
				</div>

				</div>
			</div>

			<div class="clear"></div>

		</div>
	</section>

	<section>
		<div class="rowApp">
			<div class="getApp">
				<span class="mls">Get the App</span>
				<a href="/pages/android.php"target="_blank"><img src="/theme/images/icons/74c874cf7dc5.png" /></a>
			</div>
		</div>

		<div class="rowIndex">
			<div class="bottomAppLeft">
				<ul>
					<a href="/pages/about-us" target="_blank"><li>About Us</li></a>
					<a href="/pages/our-story" target="_blank"><li>Our Story</li></a>
					<a href="/pages/tncs.php" target="_blank"><li>Terms</li></a>
					<a href="/pages/privacy-policy" target="_blank"><li>Privacy</li></a>
					<a href="/pages/werhiring" target="_blank"><li>Jobs</li></a>
					<a href="http://www.vegvendors.in/blog/" target="_blank"><li>Blog</li></a>
					<a href="/pages/faqs" target="_blank"><li>Help</li></a>
				</ul>
			</div>

			<div class="bottomAppRight">
				<span class="mls">&copy; 2016 Veg Vendors</span>
			</div>

			<div class="clear"></div>

		</div>
	</section>

</body>
</html>
