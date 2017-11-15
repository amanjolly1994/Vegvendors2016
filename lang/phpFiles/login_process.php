<?php
	session_start();
	require_once 'dbConfig.php';


if (!empty($_POST['user_password']))
 {
    
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['user_password']);

    login($user_email,$user_password);

}
else
{

	echo "password empty";
}

function login ($user_email,$user_password)
{

	global $db_con;


		//$user_name = $_POST['user_name'];
		



		try
		{

			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();

			if($row['pwd']==$user_password){

				echo "ok"; // log in
				$_SESSION['uid'] = $row['uid'];
				$_SESSION['uname'] = $row['user_name'];								
			}
			else{

				echo "email or password does not exist."; // wrong details
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

}
?>
