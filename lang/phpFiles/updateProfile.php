<?php
	
	session_start();
	$uid = $_SESSION['uid'];

	require_once 'dbConfig.php';

	$dir = "../../content/profile_photos/$uid/";

	if( !empty($_FILES['photo']['name']) )
	{
		
		if(!file_exists($dir))
		{
			echo $dir;
			mkdir("../../content/profile_photos/$uid",0777, true);
		}

		$target_Path = "../../content/profile_photos/$uid/";
		$target_Path = $target_Path.basename( $_FILES['photo']['name'] );
		move_uploaded_file( $_FILES['photo']['tmp_name'], $target_Path );


		$q1 = "UPDATE registered_users SET pic = '$target_Path' WHERE uid='$uid'";

		if( $db->query($q1) === TRUE )
		{
			redirect("/dashboard.php");
		}

		else{
			echo "problem";
		}
	}

	if( isset($_POST["address-only"]) )
	{
		$address = $_POST["address-only"];

		$q1 = "UPDATE registered_users SET delivery_address='$address' WHERE uid='$uid' ";
		
		if( $db->query($q1) === TRUE )
		{
			echo "done";
		}

		else
		{
			echo "not done";
		}
	}


	if( isset($_POST["username"]) )
	{
		$username = $_POST["username"];
		$gender = $_POST["gender"];
		$fav = $_POST["fav-veg"];
		$address = $_POST["address"];

		$q1 = "UPDATE registered_users SET user_name='$username', gender='$gender', favourite='$fav', delivery_address='$address' WHERE uid='$uid' ";
		
		if( $db->query($q1) === TRUE )
		{
			echo "done";
		}

		else
		{
			echo "not done";
		}
	}

	if( isset($_POST["genderPref"]) )
	{
		$genderPref = $_POST["genderPref"];
		$invoice = $_POST["sendEmail"];

		$q1 = "UPDATE registered_users SET gender_preference='$genderPref', send_invoice='$invoice' WHERE uid='$uid' ";

		if( $db->query($q1) === TRUE )
		{
			echo "done";
		}

		else
		{
			echo "not done";
		}
	}

	if( isset($_POST["currentPassword"]) )
	{
		$current = $_POST["currentPassword"];
		$newPassword = $_POST["newPassword"];

		$q1 = "SELECT pwd FROM registered_users WHERE uid='$uid'";

		$qq = $db->query($q1);

		while( $pcheck = $qq->fetch_assoc() )
		{
			
		}

	}

?>