<?php
//session_start();
class User {
	private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "admin_sabziwala";

		function __construct(){
			if(!isset($this->db)){
	            // Connect to the database
	            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
	            if($conn->connect_error){
	                die("Failed to connect with MySQL: " . $conn->connect_error);
	            }else{
	                $this->db = $conn;
									//echo "connection made";
	            }
	        }
		}

		function checkUser($userData = array())
		{
			 $loginData=new stdclass();

			$userTbl    = $userData['oauth_provider'];
			if(!empty($userData)){

				//Check whether user data already exists in database
				$prevQuery = "SELECT * FROM ".$userTbl." WHERE googleOauthId = '".$userData['oauth_uid']."'";
			if	(!$prevResult = $this->db->query($prevQuery))
			 $this->db->error;
				if($prevResult->num_rows > 0)
				{

					$row = $prevResult->fetch_assoc();
				//getting user info fron another table registered_users
					$q1 = "SELECT *  FROM registered_users WHERE uid = '".$row["uid"]."'";
					//echo "login info";
					$res = $this->db->query($q1);
						$user_info = $res->fetch_assoc();

				$loginData=json_encode($user_info);



				}
				else
				{	// not in google table
					//Insert user data
					//echo "into else part\n</br></br>";
					$query = "INSERT INTO registered_users SET  user_name = '".$userData['first_name']." ".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', pic = '".$userData['picture']."', dor = '".date("Y-m-d H:i:s")."'";
					if(!$insert = $this->db->query($query))
					{

						//echo $this->db->error;
					//echo "its seems that you have already signed in with other modes but not with google";
					//echo "not inserted in google table";
							$q1 = "SELECT *  FROM registered_users WHERE email = '".$userData['email']."'";
							//echo "login info";
							$res = $this->db->query($q1);
								$user_info = $res->fetch_assoc();

					 $loginData=json_encode($user_info);

					}
					if($insert)
					{
						//echo "inserted in reg users";
						$insertId=$this->db->insert_id;
						$_SESSION['uid']=$insertId;
						$Insertquery = "INSERT INTO ".$userTbl." SET  uid = '".$insertId."', googleOauthId = '".$userData['oauth_uid']."'";
						if (!$inserted = $this->db->query($Insertquery))
						//echo $this->db->error;
							if($inserted)
							{
								//echo "inserted in g table";
								$q1 = "SELECT *  FROM registered_users WHERE uid = '".$insertId."'";
								//echo "login info";
								$res = $this->db->query($q1);
									$user_info = $res->fetch_assoc();

						 $loginData=json_encode($user_info);
							}


				}


			}

			//Return user data
				// $_SESSION['uid'] = $user_info['uid'];
				// $_SESSION['uname'] = $user_info['user_name'];
				return $loginData;
		}
	}
	}
	?>
