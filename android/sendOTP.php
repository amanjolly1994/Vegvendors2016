<?php

	session_start();
	include_once('dbConfig.php');

	$phone = $_POST["newPhone"];
	//$phone = '9968967301';

	//generate random OTP

	$digits = 5; 	// 5 digit OTP
	$random = rand(pow(10, $digits-1), pow(10, $digits)-1);

	//Putting Otp into Database

	$uid = $_POST["uid"];
	//$uid = 113;

	$q1 = $db->query("SELECT * FROM temp_otp WHERE uid='$uid'");

	$rowCount = $q1->num_rows;

	if( $rowCount > 0 )
	{
		if( $db->query("UPDATE temp_otp SET otp='$random', phone_no='$phone' WHERE uid='$uid'") )
		{
			echo "ok";
		}
		else
		{
			echo "not ok";
		}

	}

	else
	{

		try
		{
			$stmt = $db_con->prepare("INSERT INTO temp_otp(uid,otp,phone_no) VALUES(:uid, :otp, :phone)");
			$stmt->bindParam(":uid",$uid);
			$stmt->bindParam(":otp",$random);
			$stmt->bindParam(":phone",$phone);
			if($stmt->execute())
			{
				//nothing to Print
				echo "ok";
			}
			else
			{
				echo "Problem in loading into database";
			}
		}

		catch (phpmailerAppException $e) {
		  $results_messages[] = $e->errorMessage();
		}

	}


	//MSG API

	// Account details
	$username = 'saurabhsuman21@gmail.com';
	$hash = 'bbfc1a1994e1e231dfe337695896797ffcc11594';

// Message details
$numbers = $phone;
$sender = urlencode('VEGVND');
$message = rawurlencode('Your requested OTP for veg vendors is: '.$random.'. Please donot share.');

$numbers = implode(',', $numbers);

// Prepare data for POST request
$data = array('username' => $username, 'hash' => $hash, 'numbers' => $phone, "sender" => $sender, "message" => $message);

// Send the POST request with cURL
$ch = curl_init('http://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Process your response here
if(response)
{
	//Msg Sent
	echo 'SMS sent';
	//echo $response;
}

else {
	//Msg Not Sent
	echo $response;
}
?>
