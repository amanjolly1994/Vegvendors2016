<?php
	session_start();
	include('dbConfig.php');

	require 'smtp.php';

	$body = $_POST['content'];

	$order_id = $_GET['or'];

	$userId=$_SESSION['uid'];

	$a = $db->query("SELECT * FROM registered_users WHERE uid = '$userId'");

	$row = $a->fetch_assoc();
	$phone = $row["contact"];
	$email = $row["email"];
	$name = $row["user_name"];
	$address = $row["delivery_address"];

	$subject = "Invoice for Order no: ".$order_id;

	send_mail($email, $name, $body, $subject);

// sending mail to master vendor
	$masteremail="mvpitampura@gmail.com";

	$body = "Name: ".$name." Email: ".$email." Phone: ".$phone." Address: ".$address." \n".$body;

	send_mail($masteremail, $name, $body, $subject);

	//MSG API

	$b = $db->query("SELECT * FROM main_orders WHERE order_id='$order_id'");

	$rowb = $b->fetch_assoc();

	$totalPrice = $rowb['total_price'];


	//Invoice to user
	require_once("smsFn.php");

	$message = "Your order with order id: #".$order_id." has been confirmed. Total amount for your order is: Rs ".$totalPrice.". You will receive the order within 3 hour.";

	sendSMS($phone,$message);
	//SMS to vendors

	$str="Order No: #".$order_id."\n Name: ".$name."\n Address: ".$address."\n Orders: \n";

	$ss = $db->query("SELECT * FROM sub_orders WHERE order_id='$order_id'");

	$count = 1;

	$subPrice = 0;

	$ven_no = array();

	$ven_no[1] = 123;

	while($show = $ss->fetch_assoc())
	{
		$str = $str.$count.". ".$show['sabziz']." ".$show['qty_in_kg']."Kg "."Rs. ".$show['price']."\n";
		if( $show['svid'] != $ven_no[$count] )
		{
			$ven_no[$count] = $show['svid'];
		}
		$count++;
	}

	$str = $str."Total: Rs ".$totalPrice;

	echo $message=urlencode($str);

	$username="pratyush";

	$password="65354";

	$senderid="PDTIPS";


	for( $x=1; $x<$count; $x++ )
	{
		$svid = $ven_no[$x];

		$qq = $db->query("SELECT * FROM sabzi_wala WHERE svid='$svid'");

		$q_row = $qq->fetch_assoc();

		$number = $q_row['contact'];

		echo $number;

		$url="http://smsleads.in/pushsms.php?username=$username&password=$password&message=$message&sender=$senderid&numbers=$numbers";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$response = curl_exec($ch);

	}

?>
