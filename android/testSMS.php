<?php
  // Account details
  $username = urlencode('saurabhsuman21@gmail.com');
  $hash = urlencode('bbfc1a1994e1e231dfe337695896797ffcc11594');

  $random = 12345;

  // Message details
  $numbers = array(918375930322,919968967301);
  $sender = urlencode('VEGVND');
  $message = 'Your requested OTP for veg vendors is: '.$random.'. Please donot share.';
  //$message = 'Your requested OTP for veg vendors is: '.$random.'. Please donot share.';

  $numbers = implode(',', $numbers);

  // Prepare data for POST request
  $data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

  $ch = curl_init('http://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Process your response here
echo $response;
?>
