<?php
	session_start();
	require_once 'dbConfig.php';

	include_once("facebook/config.php");
	include_once("google/config.php");

	$trying = 'nothing';

	if( isset($_SESSION['trying']) )
	{
		$trying = $_SESSION['trying'];
	}

	if(array_key_exists('logout',$_GET))
	{
		$facebook->destroySession();		
		unset($_SESSION['userdata']);
		session_destroy();
		unset($_SESSION['token']);
		unset($_SESSION['google_data']); //Google session data unset
		$gClient->revokeToken();
		session_destroy();
		unset($_SESSION['uid']);		
	}

	if(session_destroy())
	{
		if( $trying == "google" )
			redirect("/?wtp=cg");

		else if( $trying == "facebook" )
			redirect("/?wtp=cf");
		
		else
			redirect("/");
	}

	// unset cookies
if (isset($_SERVER['HTTP_COOKIE'])) 
{
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
?>