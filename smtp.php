<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';


function send_mail($user_email, $user_name, $body, $subject)
{
	//Create a new PHPMailer instance
	$mail = new PHPMailer(true);
	$mail->CharSet = 'utf-8';
	ini_set('default_charset', 'UTF-8');

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = "vegvendors.in";
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = 587;
		$mail->SMTPSecure = "tls";
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$mail->Username = "alerts@vegvendors.in";
		//Password to use for SMTP authentication
		$mail->Password = "veg-vendors-2016";
		//Set who the message is to be sent from
		$mail->setFrom('alerts@vegvendors.in', 'Veg Vendors');
		//Set an alternative reply-to address
		$mail->addReplyTo('alerts@vegvendors.in', 'Customer Care');
		//Set who the message is to be sent to
		$mail->addAddress($user_email, $user_name);
		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($body, dirname(__FILE__), true);
		//Replace the plain text body with one created manually
		$mail->AltBody = 'Veg Vendors Content';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');

		//send the message, check for errors
		if(!$mail->send())
			return 0;

		return 1;


}
