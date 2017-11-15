<?php

	require_once 'dbConfig.php';

	if($_POST)
	{
		// $myarray = json_decode($_POST["orders"], true);
	echo $userId = $_POST["uid"];
	echo $order_id = $_POST["order_id"]; 
		
	}



    if( $db->query("UPDATE `main_orders` SET  `delivery_status`='-1' WHERE `main_orders`.`order_id`=$order_id") )
    {
      echo "done";
	

    }

    else{
      echo "not done";
    }

  


  
?>
