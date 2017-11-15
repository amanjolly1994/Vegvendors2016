<?php
session_start();

//Include Facebook SDK
require_once 'inc/facebook.php';

/*
 * Configuration and setup FB API
 */
 $appId = '572841012892700'; //Facebook App ID
 $appSecret = '5986e027bada55b582f1db51b7e0ff56'; // Facebook App Secret
 $redirectURL = 'http://www.vegvendors.in/social_login/facebook/'; // Callback URL
 $fbPermissions = 'email';



//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbUser = $facebook->getUser();
?>
