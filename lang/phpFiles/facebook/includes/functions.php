<?php
class Users {
	public $table_name = 'registered_users';
	
	function __construct(){
		//database configuration
		$dbServer = 'localhost'; //Define database server host
		$dbUsername = 'root'; //Define database username
		$dbPassword = 'root'; //Define database password
		$dbName = 'admin_sabziwala'; //Define database name
		
		//connect database
		$con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
		if(mysqli_connect_errno()){
			die("Failed to connect with MySQL: ".mysqli_connect_error());
		}else{
			$this->connect = $con;
		}
	}
	
	function checkUser($oauth_provider,$oauth_uid,$name,$email,$gender,$picture){
		
		// if($oauth_provider == 'google')
		// 	$picture = $_SESSION['google_data']['picture'];
		
		

		$prev_query = mysqli_query($this->connect,"SELECT * FROM ".$this->table_name." WHERE email = '".$email."' ") or die(mysql_error($this->connect));
		
		$res = mysqli_fetch_array($prev_query);
		
		if(mysqli_num_rows($prev_query)>0)
		{
			if (($res['oauth_provider']=='vegvendors') or( $res['oauth_provider']==$oauth_provider))
			{
			if(!($update = mysqli_query($this->connect,"UPDATE $this->table_name SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$oauth_uid."', user_name = '".$name."', gender = '".$gender."', pic = '".$picture."' WHERE email = '".$email."' ")));
		    {
		    	echo mysqli_error($this->connect);
		    }
			}
			else{			
				
				$_SESSION['trying'] = $oauth_provider;
				redirect("lang/phpFiles/logout.php");
			}
		}
		else{
			$insert = mysqli_query($this->connect,"INSERT INTO $this->table_name SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$oauth_uid."', pwd = '".$oauth_uid."', user_name = '".$name."', email = '".$email."', gender = '".$gender."', pic= '".$picture."'");
			
			$body = "Thank you for sign up";

			$subject = "Veg Vendors sign-up via".$oauth_provider;
			

			
		}
		//showing result
		$query = mysqli_query($this->connect,"SELECT * FROM $this->table_name WHERE email = '".$email."' AND oauth_uid = '".$oauth_uid."'");
		$result = mysqli_fetch_array($query);
		return $result;
	}

	
}



?>
