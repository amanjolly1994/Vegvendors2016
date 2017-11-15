<?php

	require_once 'dbConfig.php';

	if( $_POST )
	{
		$myarray = json_decode($_POST["order"], true);
		
	}

	$email = $myarray["email"];
	//$userId = $myarray["uid"];
	$address = $myarray["newAdd"];
	$c_status = $myarray["coupon_status"];
	$place_code = $myarray["place_code"];
	$immediate_delivery = $myarray["immediate_delivery"];
	$timeslot_id = $myarray["timeslot_id"];
	$prev_oid = $myarray["prev_oid"];
	$type_of_delivery = $myarray["delivery_type"];
	


	//GETTING INFO OF THE USER
	$a = $db->query("SELECT * FROM registered_users WHERE email = '$email'");

	$row = $a->fetch_assoc();
	$phone = $row["contact"];
	
	$userId = $row["uid"];

	if( $address != "" || $address != null )
	{
		$q1 = "UPDATE registered_users SET delivery_address='$address' WHERE uid='$userId' ";
		$m = $db->query($q1);
	}

	$totalPrice = 0;

	foreach($myarray["basket"] as $key => $value)
	{
		$sabzi = $value["name"];
		$mass = $value["count"];

		$q1 = "SELECT * FROM sabzi_price s INNER JOIN sabziz z  on s.sabzi_id = z.sabzi_id WHERE s.place_code= '$place_code' AND z.sabzi_name= '$sabzi'";

		$sab = $db->query($q1);

		$row = $sab->fetch_assoc();

		$cost = $row["price_per_kg"];

		$totalCost = $cost*$mass; 

		$totalPrice = $totalPrice + $totalCost;

	}

	// if( $c_status == "yes" )
	// {
		// $c_code = $myarray["coupon_code"];
		// //Coupon function work

		// $q = "SELECT * FROM default_promo_table WHERE Promo_code=:code";
		// $stmt = $db_con->prepare($q);
		// $stmt->execute(array(":code"=>$c_code));
		// $row = $stmt->fetch(PDO::FETCH_ASSOC);
		// $count = $stmt->rowCount();

		// if( $count > 0 )
		// {
			// $discount = $row["discount"];
			// $min = $row["minimum"];
			// $max = $row["maximum"];

			// if( $totalPrice >= $min )
			// {
				// $totalPrice = $totalPrice - ($totalPrice*($discount/100));
				
				// if( $max != "" || $max != null || $max != 0 && $totalPrice > $max )	
				// {
					// $totalPrice = $max;
				// }
			// }
		// }

	// }
	
	if( $myarray != null )
	{
		$stmt = $db_con->prepare("INSERT INTO main_orders(uid,total_price,immediate_delivery,timeslot_id,prev_oid,type_of_delivery) VALUES(:uid, :total_price, :immediate_delivery , :timeslot_id , :prev_oid, :type_of_delivery)");
		$stmt->bindParam(":uid",$userId);
		$stmt->bindParam(":total_price",$totalPrice);
		$stmt->bindParam(":immediate_delivery",$immediate_delivery);
		$stmt->bindParam(":timeslot_id",$timeslot_id);
		$stmt->bindParam(":prev_oid",$prev_oid);
		$stmt->bindParam(":type_of_delivery",$type_of_delivery);
		
		$stmt->execute();
		$order_id=$db_con->lastInsertId();
	}


	foreach ($myarray["basket"] as $key => $value) 
	{
    // echo $value["count"] . ", " . $value["name"] . $value["price"] . ", " . $value["total"] . "<br>";
 
	 	$stmt = $db_con->prepare("INSERT INTO sub_orders(order_id, sabziz, qty_in_kg, price, svid) VALUES(:order_id, :sabziz, :qty_in_kg, :price, :svid)");
		$stmt->bindParam(":order_id",$order_id);
		$stmt->bindParam(":sabziz",$value["name"]);
		$stmt->bindParam(":qty_in_kg",$value["count"]);		
		//Vendor Id of the vendor for that vegetable
		$stmt->bindParam(":svid",$value["vendorId"]);

		$sabzi = $value["name"];
		$mass = $value["count"];

		$q1 = "SELECT * FROM sabzi_price s INNER JOIN sabziz z  on s.sabzi_id = z.sabzi_id WHERE s.place_code= '$place_code' AND z.sabzi_name= '$sabzi'";

		$sab = $db->query($q1);

		$row = $sab->fetch_assoc();

		$cost = $row["price_per_kg"];

		$totalCost = $cost*$mass; 

		$stmt->bindParam(":price",$totalCost);

		$stmt->execute();
	}	

	echo "Ok";

?>