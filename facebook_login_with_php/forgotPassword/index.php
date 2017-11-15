<?php
	//Include Database configuration File dbConfig.php
	session_start();
	include('dbConfig.php');	

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />

	<!-- SEO SECTION -->

	<title>Online Vegetable Store to Order from Local Vendors - Veg Vendors</title>
	<link rel="shortcut icon" href="/favicon.png" />

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

	<script type="text/javascript">


	$(document).ready(function(){

		$(".forgot-password").submit(function(event){						
			event.preventDefault();
			ajaxForget();
			return false;
		});

	});

	function ajaxForget()
	{
		var beta = $("#forgotPassword").serialize();

		$.ajax({

			type : 'POST',
			url : 'mailCode.php',
			data : beta,

			beforeSend : function()
			{

			},

			success : function(value)
			{
				if(value=="done")
					window.location = "sentCode.php";
				else
					alert("Error");
			}

		});
	}

	</script>
	
</head>

<body class="no-class">

<div class="mainPage">
	

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->
		<div class="forgot-page">
			<div class="key-image-holder">
				<img src="/theme/images/icons/key.png" />
			</div>

			<div class="heading-for-page">
				<span class="mls">Forgot your password?</span>
			</div>

			<form name="forgot-password" id="forgotPassword" method="POST" class="forgot-password" enctype="multipart/form-data">
				<input type="email" placeholder="Enter your email here." name="email" class="forgot-email" required />

				<input type="submit" value="Request for new password" />

			</form>

			<div class="goto-login">
				<span class="mls">If you remember your password, please goto <a href="login">login page.</a></span>
			</div>

			<div class="forgot-footer-logo">
				<a href="/"><img src="/theme/images/logos/logo-no-color.png" /></a>
			</div>

		</div>

		<!-- NEW PAGE ENDS -->

	</section>


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
