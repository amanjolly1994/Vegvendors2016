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

    // Next Button Action

    $(".rule-next-button").click(function(e){
      e.preventDefault();
      $("#complaint-rules").hide();
      $("#complaint-form-holder").fadeIn();
    });

    // Complaint form Action JS

    $("#complaint-form").submit(function(event){
      event.preventDefault();
      ajaxComplaint();
      return false;
    });

    // complaint ajax form submit

    function ajaxComplaint()
    {
      var feta = $("#complaint-form").serialize();

      $.ajax({

        type : 'POST',
        url : '/lang/phpFiles/complaintSubmit.php',
        data : feta,

        beforeSend : function()
        {
          console.log("going to ajax beforesend");
          messageBox("Registering Complaint. Please wait.", "#34495e");
        },

        success : function(value)
        {
          if(value=="Failed")
          {
            //Failed
            console.log("this is failing");
          }
          else {
            //Success
            console.log("All done: "+value);
            $("#complaint-form").remove();
            $("#complaint-form-holder").append("<p>Your complaint has been registered. We will solve your issue within 24-48 hours. An email has been sent to you regarding your complaint. <br><br>Token no: <b>"+value+"</b><br><br>Use the above token to check the status of your complaint. Thank you.</p>")
          }
        }

      });
    }

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
      if( !isset($_SESSION['uid']) )
			{
				redirect("/");
			}

      $uid = $_SESSION['uid'];

      $res = $db->query("SELECT * FROM main_orders WHERE uid='$uid' AND order_date >= ( CURDATE() - INTERVAL 3 DAY ) ORDER BY order_date DESC LIMIT 5");

      $count = $res->num_rows;

	?>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->

		<div class="complaint-page">

      <div class="complaint-left">

        <!-- complaint status -->
        <a href="/complaint-status" target="_blank">
          <div class="goto-complaint-status">
            <h4>Click Here To Check Complaint Status</h4>
          </div>
        </a>

        <!-- complaint box -->
        <div class="complaint-box" id="complaint-box">

          <div class="complaint-rules" id="complaint-rules">

            <div class="complaint-heading">
              <span class="mls">Before you proceed...</span>
            </div>

            <ol class="complaint-rule-list">
              <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
              <li>Nullam at purus fringilla, volutpat justo a, consequat sapien.</li>
              <li>Vivamus nec velit non arcu lacinia ullamcorper.</li>
              <li>Fusce dignissim ligula eget lobortis consectetur.</li>
              <li>Nam sit amet mauris tristique, venenatis libero quis, condimentum orci.</li>
            </ol>

            <div class="rule-next-button">
              <button>Accept &amp; next</button>
            </div>

          </div>

          <!-- complaint form -->

          <div id="complaint-form-holder" class="complaint-form-holder">

            <?php
            if( $count>0 )  //If the count of options are > 0
            {
            ?>

            <form class="complaint-form" id="complaint-form" name="complaint-form" autocomplete="off" enctype="multipart/form-data" >

              <div class="complaint-heading">
                <span class="mls">Complaint Form</span>
              </div>

              <label for="order-list">Please select an order: </label>
              <select name="order-list" class="select-minimal" required>
                <option value="">Select an order no.</option>
                <?php
                while ( $orders = $res->fetch_assoc() ) {
                ?>
                  <option value="<?php echo $orders['order_id']; ?>">Order no: #<?php echo $orders['order_id']; ?> - ₹<?php echo $orders['total_price']; ?></option>
                <?php
                }
                ?>
              </select>

              <br><br><br>

              <label for="complaint-text">Your complaint (under 500): </label>
              <textarea name="complaint-text" maxlength="500" required></textarea>

              <div class="complaint-button-holder">
                <input type="submit" value="Submit it" />
              </div>

            </form>

            <?php }
            else {
            ?>
            <p class='warning-text'><b>Caution:</b> Sorry, you are not allowed to register complaints because you have not placed any order in 3 days. Complaints are only valid for the last 5 orders made within 3 days.</p>
            <?php
            }
            ?>

          </div>


        </div>

      </div>

      <div class="complaint-right">

        <div class="long-ad">
          <img src="/theme/images/pictures/adidas_400x600.jpg" />
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
