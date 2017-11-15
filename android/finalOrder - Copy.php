<?php
session_start();
  if(isset($_COOKIE["PHPSESSID"]))
  { 


	require_once 'dbConfig.php';

	if( $_POST )
	{
		$myarray = json_decode($_POST["order"], true);
		
		timestamp_check($myarray);

	}



function timestamp_check($myarray)
{
		$sabzitimestamp = $myarray["sabzitimestamp"];
		$vendortimestamp = $myarray["vendortimestamp"];
		$placecode = $myarray["placecode"];

		if (class_exists('Memcache')) {
		    $meminstance = new Memcache();
		    echo "memcache";
		} else {
		    $meminstance = new Memcached();
		    echo "memcached";
		}

		$meminstance->addServer('127.0.0.1', 11211);

		$result = $meminstance->get("mainJson");

		if ($result) 
		{

			$json = json_decode($result,true);
			echo $cache_vendortimestamp=$json[$placecode]["vendorTimestamp"];
			echo $cache_sabzitimestamp=$json[$placecode]["sabziTimestamp"];

			if((strcmp($vendortimestamp,$cache_vendortimestamp)!=0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)!=0))
				{

					
					$json[$placecode]["vendor_status"]="changed";
					$json[$placecode]["sabzi_status"]="changed";
					return json_encode($json[$placecode]);

				  
					
				}
			elseif((strcmp($vendortimestamp,$cache_vendortimestamp)!=0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)==0))
				{

					
					$json[$placecode]["vendor_status"]="changed";
					
					return json_encode($json[$placecode]);

				  
					
				}
			elseif((strcmp($vendortimestamp,$cache_vendortimestamp)==0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)!=0))
				{

					
					$json[$placecode]["sabzi_status"]="changed";
					
					return json_encode($json[$placecode]);

				  
					
				}
			elseif((strcmp($vendortimestamp,$cache_vendortimestamp)==0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)==0))
				{

					
					return $message="nothing changed all ok....taking orders";
					
					order($myarray);

				  
					
				}		


			

		    
		} 
		else 
		{
		    return $false="<br/><br/>No matching key found.! with placecode as key mainJson <br/><br/>";
		   
		}








			// { 

			// 	echo " <br/><br/><br/><br/>data set from cache........!with placecode as key".$placecode;

			// }
			// else
			// {
			// 		echo " <br/><br/><br/><br/>data not set from cache........!with placecode as key".$placecode;

			// }



}



function order($myarray)
{


	//$userId = $myarray["uid"];
	$userId=$_SESSION["uid"];
	$address = $myarray["newAdd"];
	$c_status = $myarray["coupon_status"];
	$place_code = $myarray["place_code"];
	$slot = $myarray["timeslot"];
	if (isset($myarray["secondary_no"])&&(!empty($myarray["secondary_no"])))
	{
		$secondary_no=$myarray["secondary_no"];
	}
	else
	{
		$secondary_no=NULL;
	}	


	//GETTING INFO OF THE USER
	$a = $db->query("SELECT * FROM registered_users WHERE uid = '$userId'");

	$row = $a->fetch_assoc();
	$phone = $row["contact"];
	$email = $row["email"];
	$name = $row["user_name"];

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

	if( $c_status == "yes" )
	{
		$c_code = $myarray["coupon_code"];
		//Coupon function work

		$q = "SELECT * FROM default_promo_table WHERE Promo_code=:code";
		$stmt = $db_con->prepare($q);
		$stmt->execute(array(":code"=>$c_code));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();

		if( $count > 0 )
		{
			$discount = $row["discount"];
			$min = $row["minimum"];
			$max = $row["maximum"];

			if( $totalPrice >= $min )
			{
				$totalPrice = $totalPrice - ($totalPrice*($discount/100));

				if( $max != "" || $max != null || $max != 0 && $totalPrice > $max )
				{
					$totalPrice = $max;
				}
			}
		}

	}

	if( $myarray != null )
	{
		$stmt = $db_con->prepare("INSERT INTO main_orders(uid,total_price,order_date,timeslot_id,secondary_no) VALUES(:uid, :total_price,:order_date,:slot,:secondary_no)");
		$stmt->bindParam(":uid",$userId);
		$stmt->bindParam(":total_price",$totalPrice);
		$stmt->bindParam(":order_date",date('Y-m-d H:i:s'));
		$stmt->bindParam(":slot",$slot);
		$stmt->bindParam(":secondary_no",$secondary_no);
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

/////////////////////for non liable orders///////////////////////////////
	if( $myarray["basket2"]!= null )
	{

	foreach($myarray["basket2"] as $key => $value)
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


//inserting non liable orders in a main TABLE/////////
	
		$stmt = $db_con->prepare("INSERT INTO main_orders(uid,total_price,order_date,timeslot_id,delivery_status,secondary_no) VALUES(:uid, :total_price,:order_date,:slot,:delivery_status,:secondary_no)");
		$stmt->bindParam(":uid",$userId);
		$stmt->bindParam(":total_price",$totalPrice);
		$stmt->bindParam(":order_date",date('Y-m-d H:i:s'));
		$stmt->bindParam(":slot",$slot);
		$stmt->bindParam(":secondary_no",$secondary_no);
		$stmt->bindParam(":delivery_status",-2);
		$stmt->execute();
		$order_id2=$db_con->lastInsertId();
	
  

	foreach ($myarray["basket2"] as $key => $value) 
	{

    // echo $value["count"] . ", " . $value["name"] . $value["price"] . ", " . $value["total"] . "<br>";

	 	$stmt = $db_con->prepare("INSERT INTO sub_orders(order_id, sabziz, qty_in_kg, price, svid) VALUES(:order_id2, :sabziz, :qty_in_kg, :price, :svid)");
		$stmt->bindParam(":order_id2",$order_id2);
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

				/////////////////////
				echo "Ok";
				//sending mail for non liable orders
				mail_via_order_id2 ($order_id2);
				require_once "mail_via_orderId2.php";

}
				///////////////////////////////////
				//sending msg and mail////////////
				mail_msg_via_order_id ($order_id);
				require_once "mail_msg_via_orderId.php";
				////////////////////////////////

	}//function order closed	
	
}

?>
