<?php
	require_once 'dbConfig.php';
        $response=array();

	
		$username = $_POST['username'];
		$user_password = $_POST['password'];
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM deo_users WHERE username=:username");
			$stmt->execute(array(":username"=>$username));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['pwd']==$user_password){
				
				$response["status"]="ok";
                                $response["id"]=$row['uid'];
				$response['name'] = $row['username'];
			

			}
			else{
				
				$response["status"]="wrong details"; // wrong details 
			}
				
		}
		catch(PDOException $e){
			$response["status"]="error";
		}

echo json_encode($response);
	

?>