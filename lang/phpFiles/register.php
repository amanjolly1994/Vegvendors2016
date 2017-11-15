<?php
session_start();
	require_once 'dbConfig.php';
	
if (!empty($_POST['user_password']))
{
	if($_POST)
	{
		



		$user_name = $_POST['full_name'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		$activation = md5($user_email.time());	


		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM registered_users WHERE email=:email");
			$stmt->execute(array(":email"=>$user_email));
			$count = $stmt->rowCount();
			
			if($count==0){
				
			$stmt = $db_con->prepare("INSERT INTO registered_users(user_name,email,pwd,activation,dor) VALUES(:uname, :email, :pass, :activation,:dor)");
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
					
					
				}
				else
				{
					echo "Query could not execute !";
				}
			
			}
			else{
				
				echo "1"; //  not available
			}

require '../../PHPMailerAutoload.php';
			//mail starts

			$ver_url="http://www.vegvendors.in/activation.php?f=0&pa=".$activation;

			$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
 
class phpmailerAppException extends phpmailerException {}
 
	try {
	$to = $user_email;
	if(!PHPMailer::validateAddress($to)) 
	{
	  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
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
	$body = <<<EOT
<html>
<head>

	<title>Email Verification</title>

	<link href="https://fonts.googleapis.com/css?family=Droid+Sans|Arimo|Noto+Sans|Ubuntu" rel="stylesheet" type="text/css">

</head>


<body style="box-sizing: border-box;height: 100% !important; margin: 0; padding: 0; width: 100% !important; font-family: Helvetica;">

	<div class="mail-page" style="max-width: 600px; margin: 50px auto;">

		<div class="logo-mail" style="text-align: left;">
			<img src="http://www.vegvendors.in/theme/images/logos/full-logo.png" style="width: 200px;" />
		</div>

		<div class="content-box" style="margin-top: 50px;border: 1px #bdbdbd solid;">

			<div class="mail-heading" style="padding: 20px; font-family: Droid Sans, sans-serif;" >
				<h1 style="font-size: 28px;color: #182432;">Welcome $user_name</h1>
				<p style="color: #676D76;font-size: 16px;font-weight: 400;">We provide a platform to connect with your local vendors.</p>
			</div>

			<div class="graphic" style="width: 100%;height: 300px;background: url(http://www.vegvendors.in/theme/images/pictures/email-back-purple.png) no-repeat;background-size: 100%;text-align: center;">
				<img src="http://www.vegvendors.in/theme/images/icons/sample-anime.gif" />
			</div>

			<div class="mail-content" style="text-align: center;margin-top: 0px;padding: 0px 40px 30px 40px;">
				<p style="text-align: left;font-size: 16px;color: #676D76;line-height: 25px;">We need to verify your registered email address. If you see this please click the verify button and start shopping.</p>

				<a href="$ver_url"><button style="font-family: ubuntu;font-size: 16px;background: #2ecc71;color: #fff;padding: 10px 40px;border: none;margin-top: 20px;cursor: pointer;">Verify Email</button></a>
			</div>

		</div>

		<div class="footer" style="margin-top: 40px;text-align: center;font-family: Arimo;font-size: 14;color: #bdbdbd;">
			<p>You are currently logged in as: <span style="color: #64b5f6;text-decoration: none;">$user_email</span><br>
				Visit us at: <a href="vegvendors.in" style="color: #64b5f6;text-decoration: none;">vegvendors.in</a>
			</p>

		</div>

	</div>

</body>
</html>

EOT;


$mail->WordWrap = 78;
$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
// $mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png');  // optional name
// $mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name
 
try {
  $mail->send();
  $results_messages[] = "Message has been sent using SMTP";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}
 
if (count($results_messages) > 0) {
  // echo "<h2>Run results</h2>\n";
  // echo "<ul>\n";
foreach ($results_messages as $result) {
  // echo "<li>$result</li>\n";
}
// echo "</ul>\n";
}

			// mail ends

				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>