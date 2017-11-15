<?php

// Email to user
		require_once ('../dbConfig.php');
		//require_once("../smtp.php");
		//$order_id=$_POST["order_id"];
		//$order_id=474;
?>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>

</head>
<?php
//mail_msg_via_order_id ($order_id);
function mail_via_order_id2 ($order_id)
{
	global $db;
	//GETTING INFO OF THE USER
	$a = $db->query("SELECT * FROM registered_users r inner join main_orders m on r.uid = m.uid WHERE m.order_id  = '$order_id'");

	$row = $a->fetch_assoc();
	$phone = $row["contact"];
	$email = $row["email"];
	$name = $row["user_name"];
	$totalPrice=$row["total_price"];
	$secondary_no=$row["secondary_no"];



	 $slot = $row["timeslot_id"];

	 if( $slot == 1 )
	 	$slot_value = "Today 07 AM - 10 AM";
	 if( $slot == 2 )
	 	$slot_value = "Today 01 PM - 02 PM";
	 if( $slot == 3 )
	 	$slot_value = "Today 06 PM - 09 PM";
	 if( $slot == 4 )
	 	$slot_value = "Tomorrow 07 AM - 10 AM";
	 if( $slot == 5 )
	 	$slot_value = "Tomorrow 01 PM - 02 PM";
	 if( $slot == 6 )
	 	$slot_value = "Tomorrow 06 PM - 09 PM";
	 if( $slot == 99 )
	 	$slot_value = "Immidiate Delivery - + ₹20";




		$subject = "Invoice for Order no: #".$order_id;
	?>
<body>



			<div class="invoicePage" id="invoicePage" style="max-width:700px; margin: 50px auto;">

			<div class="invoiceLogo">
				<img src="/theme/images/logos/full-logo.png" width="200" />
			</div>

			<h3 style="font-size: 21px; font-weight: bold; font-family: Arial,Helvetica,sans-serif; color: #333; margin-top: 10px;">Transaction Receipt</h3>

			<div style="font-size: 15px; font-family: Arial,Helvetica,sans-serif; margin-top: 5px; color: #333;">
				<?php

					$date = $row["order_date"];
				 ?>
				<p>Order no: #<?php echo $order_id; ?></p>
				<p><?php echo $date; ?></p>
			</div>

			<div style="font-size: 15px; font-family: Arial,Helvetica,sans-serif; margin-top: 15px; color: #333;">

				<p><?php echo $phone; ?></p>
				<p><?php echo $secondary_no; ?></p>
				<p><?php echo $email; ?></p>
			</div>

			<div style="margin-top:20px;">

				<table style="width: 100%; font-size: 16px; font-family: Arial,Helvetica,sans-serif; color: #333; border: 1px #111 solid; border-spacing: 0px; border-collapse: collapse;">
					<tr style="background: #4CAF50; color: #fff;">
						<td style="width: 60%; padding: 5px;">Vegetable</td>
						<td style="width: 20%; padding: 5px;">Quantity(Kg)</td>
						<td style="width: 20%; padding: 5px;">Total</td>
					</tr>

					<?php

						$qq = $db->query("SELECT * FROM sub_orders WHERE order_id='$order_id' ");
						while( $orderDetails = $qq->fetch_assoc() )
						{ ?>
							<tr style="background: none; color: #333; margin-top: 5px;">
								<td style="width: 60%; padding: 5px; border-bottom: 1px #333 solid;"><?php echo $orderDetails["sabziz"]; ?></td>
								<td style="width: 20%; padding: 5px; border-bottom: 1px #333 solid;"><?php echo $orderDetails["qty_in_kg"]; ?></td>
								<td style="width: 20%; padding: 5px; border-bottom: 1px #333 solid;"><?php echo $orderDetails["price"]; ?></td>
							</tr>
					<?php
						}

						if( $order_id == 0 )
						{ ?>
							<tr>
								<td style="text-align: center; padding-top: 50px;">Page has been refreshed. Goto <a href="www.vegvendors/dashboard.php" style="color: red !important;">Dashboard</a> to view your orders.</td>
							</tr>
						<?php
						}
					?>

					<tr style="height: 150px;"></tr>

				</table>

				<p style="text-align: right; font-size: 18px; color: #333; font-family: Arial,Helvetica,sans-serif; margin-top: 15px;">Grand Total: ₹ <?php echo $totalPrice; ?></p>

				<?php
					if( $slot == 99 )
					{
				?>
						<p style="text-align: right; font-size: 14px; color: #666; font-family: Arial,Helvetica,sans-serif; margin-top: 10px;">* Immidiate Delivery Extra Charge = ₹20</p>
				<?php
					}
					else
					{
				?>
						<p style="text-align: right; font-size: 14px; color: #666; font-family: Arial,Helvetica,sans-serif; margin-top: 10px;">* Delivery Slot :<?php echo $slot_value;?></p>
				<?php
					}
					?>
				<p style="text-align: center; font-size: 14px; color: #333; margin-top: 5px;">Ammount can paid via Cash on delivery (COD) / Paytm/ Freecharge </p>

				<div style="width: 600px; margin: 20px auto;">
					<img src="/theme/images/pictures/ad1.jpg" style="margin-top: 5px;" />
				</div>

				<p style="text-align: center;">Visit us at <a href="www.vegvendors.in" style="color: #4CAF50 !important;">vegvendors.in</a></p>

			</div>

		</div>

<script type="text/javascript">

//EMail Invoice
var total = Number("<?php echo $totalPrice; ?>");
(function(){

	if( total != 0 )
	{
		$.ajax({
	         type: 'POST',
	         url: 'mail_orders.php',
	         data: { body: $('#invoicePage').html() ,email:'<?php echo $email ;?>',name:'<?php echo $name ;?>',subject:'<?php echo $subject;?>'},

	        success: function (response) {
						console.log(response);
           // you will get response from your php page (what you echo or print)
        	}
		});
	}

})();

</script>
</body>



	<?php

// $body = $_POST['content'];
// echo $subject;
//echo $body;
//send_mail($email,$name,$body,$subject);

	//SMS to USER

	// require_once("../smsFn.php");
	// $message = "Your order with order id: #".$order_id." has been confirmed. Total amount for your order is: Rs ".$totalPrice.". You will receive the order within 3 hour.";
	// $val123 = sendSMS($phone,$message);
}
?>
