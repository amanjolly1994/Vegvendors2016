<?php
	session_start();
    include('../dbConfig.php');

if((isset($_POST["username"])&&(!empty($_POST["username"]))&&isset($_POST["password"])&&(!empty($_POST["password"]))))
	{
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
	
		
			$stmt = $db_con->prepare("SELECT * FROM deo_users WHERE username=:username");
			$stmt->execute(array(":username"=>$username));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['pwd']==$password)
			
			{
				
				echo "ok"; // log in
			
				$_SESSION['deo_uname'] = $row['username'];
				redirect("dashboard.php");
			}


else
{
		?>
		<script>
		
		alert("wrong username or password");
		window.location = "index.php";
	
		</script>
		
		
		
		
		
	
<?php	
	
}
		
		
	}




			?>