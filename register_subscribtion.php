<?php

	include('dbConfig.php');

	
		
		 $user_email = trim($_POST["user_email"]);
		
		
		
		try
		{	
		
			$stmt = $db_con->prepare("INSERT INTO  subscribtion (email) VALUES(:email)");
			$stmt->bindParam(":email",$user_email);
				if($stmt->execute())
				{ 
					include('smtp.php');

					
					$user_name="Vegvendor subscriber";
					$subject="Vegvendor subscribtion confirmation mail";
						$body = <<<EOT
<html>
<head>

	<title>Vegvendor subscribtion</title>

	<link href="https://fonts.googleapis.com/css?family=Droid+Sans|Arimo|Noto+Sans|Ubuntu" rel="stylesheet" type="text/css">

</head>


<body style="box-sizing: border-box;height: 100% !important; margin: 0; padding: 0; width: 100% !important; font-family: Helvetica;">

	<div class="mail-page" style="max-width: 600px; margin: 50px auto;">

		<div class="logo-mail" style="text-align: left;">
			<img src="http://www.vegvendors.in/theme/images/logos/full-logo.png" style="width: 200px;" />
		</div>

		<div class="content-box" style="margin-top: 50px;border: 1px #bdbdbd solid;">

			<div class="mail-heading" style="padding: 20px; font-family: Droid Sans, sans-serif;" >
				<h1 style="font-size: 28px;color: #182432;">Welcome to vegvendors.in</h1>
				<p style="color: #676D76;font-size: 16px;font-weight: 400;">Thank you for Subscribing Vegvendors, Now you will get latest updates on our website and services.We provide a platform to connect with your local vendors.</p>
			</div>

			<div class="graphic" style="width: 100%;height: 300px;background: url(http://www.vegvendors.in/theme/images/pictures/email-back-purple.png) no-repeat;background-size: 100%;text-align: center;">
				<img src="http://www.vegvendors.in/theme/images/icons/sample-anime.gif" />
			</div>

			<div class="mail-content" style="text-align: center;margin-top: 0px;padding: 0px 40px 30px 40px;">
				<p style="text-align: left;font-size: 16px;color: #676D76;line-height: 25px;">Signup vegvendors.in to buy veggies from your local vendors.</p>

				<a href="http://vegvendors.in/login"><button style="font-family: ubuntu;font-size: 16px;background: #2ecc71;color: #fff;padding: 10px 40px;border: none;margin-top: 20px;cursor: pointer;">Signup</button></a>
			</div>

		</div>

		<div class="footer" style="margin-top: 40px;text-align: center;font-family: Arimo;font-size: 14;color: #bdbdbd;">
			<p>You are subscribed as: <span style="color: #64b5f6;text-decoration: none;">$user_email</span><br>
				Visit us at: <a href="vegvendors.in" style="color: #64b5f6;text-decoration: none;">vegvendors.in</a>
			</p>

		</div>

	</div>

</body>
</html>

EOT;
					send_mail($user_email, $user_name, $body, $subject)
					?>
					
			 <script type="text/javascript">
				     alert("Subscribtion done.Thank you for Subscribing");
				  window.location = "index.php"
				</script>
<?php
					
					
					
					
				}
			else{
				
				
				?>
				
				<script type="text/javascript">
				alert("Subscribtion not done.There is some problem. Please try after some time");
				  window.location = "index.php"
				</script>
					
					<?php
					 // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	

?>