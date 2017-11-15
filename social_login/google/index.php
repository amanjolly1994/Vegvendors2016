<?php
//Include GP config file && User class
session_start();
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();

	//Initialize User class
	$user = new User();

	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
       echo  $userData = $user->checkUser($gpUserData);
		$userData1=json_decode($userData,true);

	//Storing user data into session
	
	$_SESSION['uid'] = $userData1['uid'];
	$_SESSION['uname'] = $userData1['user_name'];	
$output="";

	//Render facebook profile data
					   //  if(!empty($userData1))
					   //  {
								// $output = '<h1>Google Profile Details </h1>';
								// $output .= '<img src="'.$userData1['pic'].'">';

						  //       $output .= '<br/>Name : ' . $userData1['user_name'];
						  //       $output .= '<br/>Email : ' . $userData1['email'];
						  //       $output .= '<br/>Gender : ' . $userData1['gender'];

					        
					   //      $output .= '<br/>Logged in with : Google';

					   //      $output .= '<br/>Logout from <a href="logout.php">Google</a>';
					   //  }else{
					   //      $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
					   //  }
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
?>
<html>
<head>




</head>
<body>
<div><?php echo $output; ?></div>
</body>
</html>
