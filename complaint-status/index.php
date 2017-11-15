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
	<link rel="stylesheet" type="text/css" href="complain.css" />
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
			url : 'complaintStat.php',
			data : beta,

			beforeSend : function()
			{
				console.log("going to ajax beforeSend");
			},

			success : function(value)
			{
        if(value=="wrong")
        {
          $(".fail-box").fadeIn();
        }
				else
				{
            var email = document.forms["forgot-password"]["token"].value;
            $(".forgot-password").remove();
            $(".fail-box").hide();
            $(".heading-for-page .mls").text("Status of Complaint");
            $(".goto-login .mls").remove();
            $(".goto-login").html(value);
        }
			}

		});
	}

	</script>

</head>

<body class="no-class">

<div class="forgotPage">

<div class="forgotBox">
	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->
		<div class="forgot-page">

			<div class="key-image-holder">
				<img src="complaint.png" />
			</div>

      <div class="fail-box">
        <span class="mls">Sorry, the token number is not known to Veg Vendors.</span>
      </div>

			<div class="heading-for-page">
				<span class="mls">Complaint Status</span>
			</div>

			<form name="forgot-password" id="forgotPassword" method="POST" class="forgot-password" enctype="multipart/form-data">

				<p>Token no</p>
				<input type="text" placeholder="" name="token" class="forgot-email" required />

				<div class="submit-holder">
					<input type="submit" value="Check Status" />
				</div>

			</form>

			<div class="goto-login">
				<span class="mls">To post complaints, please goto <a href="http://www.vegvendors.in/complain">Complaints.</a></span>
			</div>

		</div>

		<!-- NEW PAGE ENDS -->

	</section>
</div>

</div>

</body>

</html>
