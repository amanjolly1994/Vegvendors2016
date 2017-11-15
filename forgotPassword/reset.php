<?php
	//Include Database configuration File dbConfig.php
	session_start();
	include('dbConfig.php');

  if(isset($_GET["xc"]))
    $code = $_GET["xc"];
  else
    redirect("/forgotPassword");

  $af = $db->query("SELECT * FROM forget WHERE code='$code'");

  $count = $af->num_rows;

  if($count>0)
  {
    $row = $af->fetch_assoc();

    $uid = $row['uid'];

    $_SESSION["reset_uid"] = $uid;
  }

  else {
    redirect("/forgotPassword");
  }

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
	<link rel="stylesheet" type="text/css" href="pass.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

	<!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>

	<script type="text/javascript">


	$(document).ready(function(){

		$("#resetPassword").submit(function(event){
			event.preventDefault();
      var pass1 = document.forms["reset-password"]["password"].value;
      var pass2 = document.forms["reset-password"]["repass"].value;

      if( pass1 === pass2 )
			   ajaxReset();
      else {
        $(".fail-box .mls").text("Sorry, passwords don't match.")
        $(".fail-box").fadeIn();
      }
			return false;
		});

	});

	function ajaxReset()
	{
		var beta = $("#resetPassword").serialize();

		$.ajax({

			type : 'POST',
			url : 'changePassword.php',
			data : beta,

			beforeSend : function()
			{
				console.log("going to ajax beforeSend");
			},

			success : function(value)
			{
				if(value=="done")
				{
            $(".forgot-password").remove();
            $(".fail-box").hide();
            $(".heading-for-page .mls").text("Password Changed!");
            $(".goto-login .mls").html("Your password has been successfully changed. <a href='/login'>Login Here.</a>");
        }
        else if(value=="error")
        {
            $(".fail-box").fadeIn();
        }
				else
					alert("Error");
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
				<img src="reset.png" />
			</div>

      <div class="fail-box">
        <span class="mls">Sorry, some error has occured.</span>
      </div>

			<div class="heading-for-page">
				<span class="mls">Reset your password!</span>
			</div>

			<form name="reset-password" id="resetPassword" method="POST" class="forgot-password" enctype="multipart/form-data">

				<p>New Password</p>
				<input type="password" placeholder="" name="password" class="forgot-emai" required />

        <p style="margin-top:15px">Re Password</p>
        <input type="password" placeholder="" name="repass" class="forgot-emai" required />

				<div class="submit-holder">
					<input type="submit" value="Reset Password" />
				</div>

			</form>

			<div class="goto-login">
				<span class="mls">If you remember your password, please goto <a href="http://www.vegvendors.in/login">login page.</a></span>
			</div>

		</div>

		<!-- NEW PAGE ENDS -->

	</section>
</div>

</div>

</body>

</html>
