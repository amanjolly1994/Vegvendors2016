<?php

	session_start();

	include_once("dbConfig.php");

	$id = $_POST["id"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$gender = $_POST["gender"];
	$picUrl = $_POST["picUrl"];
	$oauth_provider = $_POST["oauth"];

	if( $oauth_provider == "facebook" )
		$pic = "https://graph.facebook.com/".$id."/picture?type=large";
	else
		$pic = $picUrl;


	$prev_query = $db->query("SELECT * FROM registered_users WHERE email = '$email'");

	$rowCount = $prev_query->num_rows;

	if( $rowCount > 0 )
	{
		$res = $prev_query->fetch_assoc();
		if( ($res['oauth_provider']=='vegvendors') or (strtolower($res['oauth_provider'])==$oauth_provider) )
		{
			if($update = $db->query("UPDATE registered_users SET oauth_provider = '$oauth_provider', pwd = '$id', user_name = '$name', gender = '$gender', pic = '$pic' WHERE email = '$email' "))
			{
				$_SESSION["uid"] = $res["uid"];
				$_SESSION["uname"] = $res["user_name"];
				echo "done";
			}
			else
			{
				//show sql error
			}
		}
	}

	else
	{
		if($insert = $db->query("INSERT INTO registered_users SET oauth_provider = '$oauth_provider', pwd = '$id', email = '$email', user_name = '$name', gender = '$gender', pic = '$pic'"))
		{
			$_SESSION["uid"] = $db->insert_id;
			$_SESSION["uname"] = $name;
			echo "done";
		}
	}

?>
