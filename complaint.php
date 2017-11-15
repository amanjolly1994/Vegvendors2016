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

<div class="mainPage">
	<?php

      $uid = $_GET['uid'];

      $_SESSION['uid'] = $uid;

      $order_id = $_GET['order'];

      $res = $db->query("SELECT * FROM main_orders WHERE uid='$uid' AND order_id='$order_id'");

      $tes = $res->fetch_assoc();

      $order_price = $tes['total_price'];

	?>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->

		<div class="complaint-page">

      <div class="complaint-centre">

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

          <div id="complaint-form-holder" class="complaint-form-holder" style="padding-right: 20px">

            <form class="complaint-form" id="complaint-form" name="complaint-form" autocomplete="off" enctype="multipart/form-data" >

              <div class="complaint-heading" style="margin-bottom: 15px">
                <span class="mls">Complaint Form</span>
              </div>

              <label for="order-list">Selected Order: </label>
              <select name="order-list" class="select-minimal" required readonly>
                <option selected value="<?php echo $order_id; ?>">Order no: #<?php echo $order_id; ?> - ₹<?php echo $order_price; ?></option>
              </select>

              <br><br><br>

              <label for="complaint-text">Your complaint (under 500): </label><br>
              <textarea name="complaint-text" maxlength="500" style="width:300px" required></textarea>

              <div class="complaint-button-holder">
                <input type="submit" value="Submit it" />
              </div>

            </form>

          </div>


        </div>

      </div>

      <div class="clear"></div>

    </div>

		<!-- NEW PAGE ENDS -->

	</section>

</div>

</body>

</html>
