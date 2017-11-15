<?php
session_start();
require_once '../dbConfig.php';
require_once '../android/referral_make.php';
echo $_COOKIE["PHPSESSID"];			
if(isset($_COOKIE["PHPSESSID"]))
{
$_COOKIE["PHPSESSID"];
 $uid=$_SESSION['uid'];
//$uid=1;				
login($uid);	
}
else
{
	echo "not set";
}



function login($uid)	
{

	global $db_con;

	
        

        $response=array();

        //take it as email
        
	
		
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE uid=:uid");
			$stmt->execute(array(":uid"=>$uid));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			
				
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

						



			
				
		}
		catch(Exception $e){
			//echo $response["status"]="error";
			echo $e;
		}

echo json_encode($response);
	
}

?>