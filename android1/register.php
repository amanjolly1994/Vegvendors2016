<?php
session_start();
	require_once 'dbConfig.php';
	require '../PHPMailerAutoload.php';

	if($_POST)
	{
		$user_name = $_POST['full_name'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];

		$activation = md5($user_email.time());

			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$count = $stmt->rowCount();

			if($count==0){

			$stmt = $db_con->prepare("INSERT INTO registered_users(user_name,email,pwd,activation,dor) VALUES(:uname, :email, :pass, :activation, :dor)");
			$stmt->bindParam(":uname",$user_name);
			$stmt->bindParam(":email",$user_email);
			$stmt->bindParam(":pass",$user_password);
			$stmt->bindParam(":activation",$activation);
			$stmt->bindParam(":dor",date('Y-m-d H:i:s'));


				if($stmt->execute())
				{
					$_SESSION['uid']=$db_con->lastInsertId();
					$_SESSION['uname']=$user_name;
					
					echo "registered";

					if ($_POST['referral'])
				{
				$suid=$db_con->lastInsertId();
				require_once 'referral_register.php';


				}

					// //mail starts
					$ver_url="http://www.vegvendors.in/activation.php?f=0&pa=".$activation;

					$results_messages = array();

				  $mail = new PHPMailer(true);
				  $mail->CharSet = 'utf-8';
				  ini_set('default_charset', 'UTF-8');

				  class phpmailerAppException extends phpmailerException {}

				  try {
				  if(!PHPMailer::validateAddress($user_email)) {
				  throw new phpmailerAppException("Email address " . $user_email . " is invalid -- aborting!");
				  }
					$mail->isSMTP();
					$mail->SMTPDebug  = 0;
					$mail->Host       = "vegvendors.in";
					$mail->Port       = "587";
					$mail->SMTPSecure = "tls";
					$mail->SMTPAuth   = true;
					$mail->Username   = "alerts@vegvendors.in";
					$mail->Password   = "veg-vendors-2016";
					$mail->addReplyTo("alerts@vegvendors.in", "Veg Vendors");
					$mail->setFrom("alerts@vegvendors.in", "Veg Vendors");
					$mail->addAddress($user_email, $user_name);
					$mail->Subject  = "Email Verification";
					$body = "Hello <b>$user_name</b>
									 <br><br>
									 	You have registered successfully at <b>Veg Vendors</b> using this email address.
										<br>
										Please complete your registration process by verifying your email id.
										<br>
										Click on the following link to verify your email address.
										<br><br>
										$ver_url
										<br><br>
										Sincerely<br>
										<b>Veg Vendors Team</b>
									";


					$mail->WordWrap = 78;
				  $mail->msgHTML($body, dirname(__FILE__), true);
				  try {
				  $mail->send();
				  $results_messages[] = "Message has been sent using SMTP";
				  }
				  catch (phpmailerException $e) {
				  throw new phpmailerAppException('Unable to send to: ' . $user_email. ': '.$e->getMessage());
				  }
				  }
				  catch (phpmailerAppException $e) {
				  $results_messages[] = $e->errorMessage();
				  }

				  // 	// mail ends





				}
				else
				{
					echo "Query could not execute !";
				}



			}
			else{

				echo "1"; //  not available user already exists
			}



}
?>
