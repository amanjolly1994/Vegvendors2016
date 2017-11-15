<?php
	
	session_start();
	$uid = $_SESSION['uid'];

	require_once 'dbConfig.php';

	if( isset($_POST["newPassword"]) )
	{

		$current = $_POST["currentPassword"];
		$new = $_POST["newPassword"];

		try {
			$q1 = "SELECT pwd FROM registered_users WHERE uid=:uid";
			$stmt = $db_con->prepare($q1);
			$stmt->execute(array(":uid"=>$uid));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();

			if($row["pwd"]==$current)
			{
				$at = $db_con->prepare("UPDATE registered_users SET pwd=:pwd WHERE uid=:uid");
				$at->bindParam(":pwd", $new);
				$at->bindParam(":uid", $uid);

				if( $at->execute() )
				{
					echo "done";
				}
			}
			else
			{
				echo "wrong";
			}

		}

		catch (PDOException $e) {
			echo $e->getMessage();		
		}		

	}

?>