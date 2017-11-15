<?php
session_start();

//Include Google client library
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '966617801310-2cot46e2pdv28kjsgv2d4rsmpg18791c.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'KMqFJSEdUbZEPBzw6cHLpkZ7'; //Google client secret
$redirectURL = 'http://www.vegvendors.in/social_login/google/'; //Callback URL


//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login via google.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
