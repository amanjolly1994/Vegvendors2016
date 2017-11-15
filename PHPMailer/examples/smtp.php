<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../PHPMailerAutoload.php';

$user_email = "jollyaman.jolly663@gmail.com";
$user_name = "Aman";

$body = <<<EOT
<html>
<head>

	<title>Welcome Page</title>

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
				<p style="text-align: left;font-size: 16px;color: #676D76;line-height: 25px;">Welcome to Veg Vendors. You have successfully register to the application using google. You can now starting shopping. Click on the button to start shopping.</p>

				<a href="www.vegvendors.in"><button style="font-family: ubuntu;font-size: 16px;background: #2ecc71;color: #fff;padding: 10px 40px;border: none;margin-top: 20px;cursor: pointer;">Start Shopping</button></a>
			</div>

		</div>

		<div class="footer" style="margin-top: 40px;text-align: center;font-family: Arimo;font-size: 14;color: #bdbdbd;">
			<p>You are currently logged in as: <span style="color: #64b5f6;text-decoration: none;">$user_email (google)</span><br>
				Visit us at: <a href="vegvendors.in" style="color: #64b5f6;text-decoration: none;">vegvendors.in</a>
			</p>

		</div>

	</div>

</body>
</html>

EOT;

send_mail($user_email, $user_name, $body);

function send_mail($user_email, $user_name, $body)
{
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = "vegvendors.in";
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 587;
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication
	$mail->Username = "no-reply@vegvendors.in";
	//Password to use for SMTP authentication
	$mail->Password = "veg-vendors-2016";
	//Set who the message is to be sent from
	$mail->setFrom('no-reply@vegvendors.in', 'Veg Vendors');
	//Set an alternative reply-to address
	$mail->addReplyTo('no-reply@vegvendors.in', 'Coustomer Care');
	//Set who the message is to be sent to
	$mail->addAddress($user_email, $user_name);
	//Set the subject line
	$mail->Subject = 'PHPMailer SMTP test';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($body, dirname(__FILE__), true);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a HTML message body';
	//Attach an image file
	//$mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}

}
