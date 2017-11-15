<?php
	require_once 'dbConfig.php';
        $response=array();
		
		if (($_POST['flag']=='1'))
        {
        //take it as email
        
	
		$user_email = $_POST['id'];
		
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			

		
				
		}
		catch(PDOException $e){
			$response["status"]="error";
		}


	}
    else
    		
            if (($_POST['flag']=='0'))
        {
        //take it as phone no
        
	
		$contact = $_POST['id'];

		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE contact =:contact");
			$stmt->execute(array(":contact"=>$contact));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			

			
				
		}
		catch(PDOException $e){
			$response["status"]="error";
		}


	}


                $uid=$row['uid'];

				$response["status"]="ok";
                $response["id"]=$row['uid'];
				$response['name'] = $row['user_name'];
				$response['email'] = $row['email'];
				$response['pic']= $row['pic'];
				$response['contact'] = $row['contact'];
				$response['address'] = $row['delivery_address'];
				$response['gender']= $row['gender'];
				$response['gender_preference']= $row['gender_preference'];		
				$response['favourite']= $row['favourite'];
                $response['previous_orders']= previous_orders($uid);
                
                
                echo json_encode($response);
                
                
  function previous_orders($uid ){
   
    global $db;
        
	$myorders=array();	
        $uid=$uid;
        
		$q = "SELECT * FROM `main_orders` WHERE `uid` ='$uid'AND order_date >= DATE_ADD(CURDATE(), INTERVAL -14 DAY) " ;

		$res = $db->query($q);

	

		$count = $res->num_rows;

	
            


        
		while( $row1 = $res->fetch_assoc() )
		{
				
				$subdata1 = new stdClass();
				$subdata1->order_id=$row1['order_id'];
				$subdata1->total_price=$row1['total_price'];
				$subdata1->order_date=$row1['order_date'];
				$subdata1->delivery_status=$row1['delivery_status'];
				$subdata1->delivery_type=$row1['type_of_delivery'];
			
           array_push($myorders,$subdata1);     
                           
      	}
        
          return ($myorders); 
	
}              
                
?>