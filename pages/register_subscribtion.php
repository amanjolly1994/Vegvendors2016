<?php

	include('../dbConfig.php');

	
		
		 $user_email = trim($_POST["user_email"]);
		
		
		
		try
		{	
		
			$stmt = $db_con->prepare("INSERT INTO  subscribtion (email) VALUES(:email)");
			$stmt->bindParam(":email",$user_email);
				if($stmt->execute())
				{
					
					
					
					?>
					
			 <script type="text/javascript">
				     alert("Subscribtion done.Thank you for Subscribing");
				  window.location = "http://www.vegvendors.in/index.php"
				</script>
<?php
					
					
					
					
				}
			else{
				
				
				?>
				
				<script type="text/javascript">
				alert("Subscribtion not done.There is some problem. Please try after some time");
				  window.location = "http://www.vegvendors.in/index.php"
				</script>
					
					<?php
					 // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	

?>