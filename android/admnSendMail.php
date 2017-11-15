<?php
	require_once 'dbConfig.php';
	require_once '../smtp.php';
	
	echo	$user_email = "jollyaman.jolly663@gmail.com";
	echo	$user_name = "vegvendor";
	echo	$body = "test mail";
	echo	$subject = "this is test mail";	
		

	
		// $user_email = trim($_POST['user_email']);
		// $user_name = trim($_POST['user_name']);
		// $body = trim($_POST['body']);
		// $subject = trim($_POST['subject']);
		
		try
		{	
		
			
			
			if(send_mail($user_email, $user_name, $body, $subject))
			{
				echo "mail sent";
			}
			
			else
			{
				echo "mail not sent";
			}
				
		}
		catch(PDOException $e)
		{
			echo "catch error";
		}


	

?>