<?php
session_start();
	require_once 'dbConfig.php';
	require_once 'referral_make.php';
        $response=array();

		
		if (($_POST["flag"]=='1'))
        {
        //take it as email
        
	
		$user_email = $_POST['id'];
		$user_password = $_POST['password'];
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['pwd']==$user_password){
				
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
				$response['credit']= $row['credit'];
				$response['referral_code']=referral($row['uid']);

				$_SESSION['uid']=$row['uid'];

			

				$_SESSION['uname'] = $row['user_name'];		
	

			}
			else{
				
				$response["status"]="NA"; // wrong details 
			}
				
		}
		catch(Exception $e){
			//echo $response["status"]="error";
			echo $e;
		}

echo json_encode($response);
	}
    	
else if (($_POST['flag']=='0'))
        {


        //take it as phone no
        
	
		$contact = $_POST['id'];
		$user_password = $_POST['password'];
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE contact =:contact");
			$stmt->execute(array(":contact"=>$contact));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['pwd']==$user_password){ 
				
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

				$_SESSION['uid']=$row['uid'];

			

				$_SESSION['uname'] = $row['user_name'];	

			}
			else{
				
				$response["status"]="NA"; // wrong details 
			}
				
		}
		catch(Exception $e){
			//$response["status"]="error";
			echo $e;
		}

echo json_encode($response);
	}

else
{

	echo "new posting error";
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

?>