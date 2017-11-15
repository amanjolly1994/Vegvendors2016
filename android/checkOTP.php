<?php

	session_start();
	include_once('dbConfig.php');

	$uid = $_POST["uid"];

	$otp = $_POST["otp"];

	//get OTP from temp_otp

	if($q1 = $db->query("SELECT * FROM temp_otp WHERE uid='$uid' AND otp='$otp'"))
	{
	$rowCount = $q1->num_rows;

	if( $rowCount > 0 )
	{
		$row1 = $q1->fetch_assoc();
		$phone = $row1['phone_no'];
		$q2 = "UPDATE registered_users SET contact = '$phone' WHERE uid='$uid'";

		if( $db->query($q2) )
			echo "OK";
		else
			echo "not";
	}

	else{
		echo "wrong";
	}
	}
	else
	{
		echo mysqli_error($db);
	}
?>
