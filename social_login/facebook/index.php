<?php
//Include FB config file && User class
session_start();
require_once 'fbConfig.php';
require_once 'User.php';


if(!$fbUser){
	$fbUser = NULL;
	echo $loginURL = $facebook->getLoginUrl(array('redirect_uri'=>$redirectURL,'scope'=>$fbPermissions));
	$output = '<a href="'.$loginURL.'"><img src="images/fblogin-btn.png"></a>';
}else{
	//Get user profile data from facebook
	$fbUserProfile = $facebook->api('/me?fields=id,first_name,last_name,email,link,gender,locale,picture');

	//Initialize User class
	$user = new User();

	//Insert or update user data to the database
	$fbUserData = array(
		'oauth_provider'=> 'facebook',
		'oauth_uid' 	=> $fbUserProfile['id'],
		'first_name' 	=> $fbUserProfile['first_name'],
		'last_name' 	=> $fbUserProfile['last_name'],
		'email' 		=> $fbUserProfile['email'],
		'gender' 		=> $fbUserProfile['gender'],
		'locale' 		=> $fbUserProfile['locale'],
		'picture' 		=> $fbUserProfile['picture']['data']['url'],
		'link' 			=> $fbUserProfile['link']
	);
	 $userData = $user->checkUser($fbUserData);
$userData1=json_decode($userData,true);
	//Put user data into session
	
	$_SESSION['uid'] = $userData1['uid'];
	$_SESSION['uname'] = $userData1['user_name'];	
$output="";
	//Render facebook profile data
						// if(!empty($userData1)){
						// 	$output = '<h1>Facebook Profile Details </h1>';
						// 	$output .= '<img src="'.$userData1['pic'].'">';

					 //        $output .= '<br/>Name : ' . $userData1['user_name'];
					 //        $output .= '<br/>Email : ' . $userData1['email'];
					 //        $output .= '<br/>Gender : ' . $userData1['gender'];

					 //        $output .= '<br/>Logged in with : Facebook';

					 //        $output .= '<br/>Logout from <a href="logout.php">Facebook</a>';
						// }else{
						// 	$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
						// }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Facebook </title>
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
</style>
</head>
<body>
<div><?php echo $output; ?></div>
</body>
</html>
