<?php

	require_once "dbConfig.php";



	if($_POST)
	{
		$fbuser = json_decode($_POST["fbuser"], true);
	}
	else
	{
		echo "posting error";
		   foreach ($_POST as $key => $value) 
	{
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }

	}	

	foreach( $fbuser as $key => $value )
	{
		$email = $value["email"];
		$o_prov = $value["oprov"];
		$picture = $value["pic"];
		$gender = $value["gender"];
		$name = $value["name"];
		$oauth_uid = $value["oauth_uid"];

		$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE email=:email");
		$stmt->execute(array(":email"=>$email));
		$rowCount = $stmt->rowCount();

		if( $rowCount > 0 )
		{
			if( $update = $db->query("UPDATE registered_users SET oauth_provider='$o_prov', oauth_uid='$oauth_uid', user_name='$name', gender='$gender', pic='$picture' WHERE email='$email' ") )
			{
				echo "login";
			}
			else
			{
				echo "error in update";
			}
		}
		else
		{
			$stmt = $db_con->prepare("INSERT INTO registered_users(email, oauth_provider, oauth_uid, user_name, gender, pic) VALUES(:email, :oauth_provider, :oauth_uid, :name, :gender, :photo) ");
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":oauth_provider", $o_prov);
			$stmt->bindParam(":oauth_uid", $oauth_uid);
			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":gender", $gender);
			$stmt->bindParam(":photo", $picture);
			if( $stmt->execute() )
			{
				echo "done";
			}
			else
			{
				echo "error in insert";
			}
		}

	}


?>