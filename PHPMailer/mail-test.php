<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'vegvendors.in';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'no-reply@vegvendors.in';                 // SMTP username
$mail->Password = 'veg-vendors-2016';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('no-reply@vegvendors.in', 'Veg Vendors');
$mail->addAddress('ronny.rooney10@gmail.com', 'Pratyush');     // Add a recipient
//$mail->addAddress('ronny.rooney10@gmail.com');               // Name is optional
$mail->addReplyTo('no-reply@vegvendors.in', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Check Php Mailer';
$mail->Body    = 'YOYOYO Honey Singh';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
?>