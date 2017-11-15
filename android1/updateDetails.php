<?php

	require_once 'dbConfig.php';

	$status="not";	// NO EDIT IN PROFILE

	if(isset($_POST["fb_id"]))
	{
		$email = $_POST["email"];
		$fb_id = $_POST["fb_id"];

		$pq = $db->query("SELECT * FROM registered_users WHERE email='$email'");

		$row = $pq->fetch_assoc();

		if( $fb_id == $row["oauth_uid"] )
		{
			$status="ok";
			$name = $row["user_name"];
			$phone = $row["contact"];
			$pic = $row["pic"];
			$gender = $row["gender"];
			$g_pref = $row["gender_preference"];
			$fav = $row["favourite"];
			$add = $row["delivery_address"];
			$userId = $row["uid"];

			$detail[] = array(
						"status" => "$status",
						"uid" => "$userId",
						"name" => "$name",
						"contact" => "$phone",
						"gender" => "$gender",
						"gp" => "$g_pref",
						"address" => "$add"
						);

			$json = json_encode($detail);

			echo $json;
		}
		else
		{
			echo "not fb";
		}

	}
  if($_POST["name"])
         {
         	$uname=$_POST["name"];
         	$uadd=$_POST["address"];
         	$contact=$_POST["contact"];
         	$gender=$_POST["gender"];
         	$gender_preference=$_POST["gp"];
         	$uid=$_POST["id"];

         	//echo $uname." ".$uadd." ".$contact." ".$gender." ".$gender_preference." ".$uid;


         	$stmt = $db_con->prepare("UPDATE registered_users SET user_name=:user_name,delivery_address=:delivery_address,contact=:contact,gender=:gender,gender_preference=:gender_preference WHERE uid=$uid");

             $stmt->bindParam(':user_name',$uname);
             $stmt->bindParam(':delivery_address',$uadd);
             $stmt->bindParam(':contact',$contact);
         	$stmt->bindParam(':gender',$gender);
         	$stmt->bindParam(':gender_preference',$gender_preference);

         	if($stmt->execute() === TRUE)
         		$status="ok"; //PROFILE HAS BEEN EDITED
         }

         if( isset($_POST["id"]) )
         {
         	$userId = $_POST["id"];

         	$a = $db->query("SELECT * FROM registered_users WHERE uid = '$userId'");

         	$count = $a->num_rows;


         	if( $count > 0 )
         	{
         		$row = $a->fetch_assoc();

         		$name = $row["user_name"];
         		$phone = $row["contact"];
         		$email = $row["email"];
         		$pic = $row["pic"];
         		$gender = $row["gender"];
         		$g_pref = $row["gender_preference"];
         		$fav = $row["favourite"];
         		$add = $row["delivery_address"];

         		$detail[] = array(
         						"status" => "$status",
         						"name" => "$name",
         						"contact" => "$phone",
         						"gender" => "$gender",
         						"gp" => "$gp",
         						"address" => "$add"
         						);

         		$json = json_encode($detail);

         		echo $json;

         	}

         	else{
         		echo "no";
         	}

         }


?>
