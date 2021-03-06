<?php

	require_once 'dbConfig.php';

	if($_POST)
	{
		$myarray = json_decode($_POST["basket"], true);
		$userId = $_POST["uid"];
	}

  if(isset($_POST['newAdd']))
	{
		$add = $_POST['newAdd'];
		$q1 = "UPDATE registered_users SET delivery_address='$add' WHERE uid='$userId' ";
		$m = $db->query($q1);
	}

	if($_POST["immidiate"] && $_POST["placecode"])
	{
		$placecode = $_POST["placecode"];
		if( $ms = $db->query("SELECT * FROM immediate_delivery_settings WHERE place_code='$placecode' AND immediate_delivery_status=1") )
		{
			$a = $db->query("SELECT * FROM registered_users WHERE uid = '$userId'");

			$row = $a->fetch_assoc();
			$phone = $row["contact"];
			$email = $row["email"];

			$totalPrice = 0;

			//total is the each vegetable total. and adds up to total price of order
			foreach($myarray as $key => $value)
			{
				$totalPrice=$totalPrice+$value["total"];
			}

			if( $myarray != null )
			{
				$stmt = $db_con->prepare("INSERT INTO main_orders(uid,total_price,immidiate_delivery) VALUES(:uid, :total_price, :immidiate_delivery)");
				$stmt->bindParam(":uid",$userId);
				$stmt->bindParam(":total_price",$totalPrice);
				$stmt->bindParam(":immidiate_delivery",1);
				$stmt->execute();
				$order_id=$db_con->lastInsertId();
			}

			foreach ($myarray as $key => $value) {
		    // echo $value["count"] . ", " . $value["name"] . $value["price"] . ", " . $value["total"] . "<br>";

			 	$stmt = $db_con->prepare("INSERT INTO sub_orders(order_id, sabziz, qty_in_kg, price, svid) VALUES(:order_id, :sabziz, :qty_in_kg, :price, :svid)");
				$stmt->bindParam(":order_id",$order_id);
				$stmt->bindParam(":sabziz",$value["name"]);
				$stmt->bindParam(":qty_in_kg",$value["count"]);
				$stmt->bindParam(":price",$value["total"]);
				//Vendor Id of the vendor for that vegetable
				$stmt->bindParam(":svid",$value["vendorId"]);
				$stmt->execute();
			}

			echo "immidiate done";
		}

		else {
			echo "immidiate not available";
		}

	}

?>
