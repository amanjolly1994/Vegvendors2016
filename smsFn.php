<?php

function sendSMS($phone, $message)
{
  //MSG API

  // Account details
  $username = 'saurabhsuman21@gmail.com';
  $hash = 'bbfc1a1994e1e231dfe337695896797ffcc11594';

  // Message details
  $numbers = $phone;
  $sender = urlencode('VEGVND');
  $encode_message = rawurlencode($message);


  // Prepare data for POST request
  $data = array('username' => $username, 'hash' => $hash, 'numbers' => $phone, "sender" => $sender, "message" => $encode_message);

  // Send the POST request with cURL
  $ch = curl_init('http://api.textlocal.in/send/');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  // Process your response here
  if($response)
  {
  //Msg Sent
  //echo 'SMS sent';
  //echo $response;
  return 1;
  }

  else {
  //Msg Not Sent
  //echo $response;
  return 0;
  }

}

?>
