<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '572841012892700'; //Facebook App ID
$appSecret = '5986e027bada55b582f1db51b7e0ff56'; // Facebook App Secret
$homeurl = 'http://localhost/facebook_login_with_php/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>