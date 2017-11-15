<?php
require_once 'PHPMailerAutoload.php';
 
$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
 
class phpmailerAppException extends phpmailerException {}
 
try {
$to = 'jollyaman.jolly663@gmail.com';
if(!PHPMailer::validateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->isSMTP();
$mail->SMTPDebug  = 2;
$mail->Host       = "vegvendors.in";
$mail->Port       = "587";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth   = true;
$mail->Username   = "no-reply@vegvendors.in";
$mail->Password   = "veg-vendors-2016";
$mail->addReplyTo("no-reply@vegvendors.in", "Veg Vendors");
$mail->setFrom("no-reply@vegvendors.in", "Veg Vendors");
$mail->addAddress("jollyaman.jolly663@gmail.com", "Aman Jolly");
$mail->Subject  = "Email Verification (PHPMailer test using SMTP)";
$body = <<<'EOT'
THIS IS A BIG FAT SPAM.
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
  echo "<h2>Run results</h2>\n";
  echo "<ul>\n";
foreach ($results_messages as $result) {
  echo "<li>$result</li>\n";
}
echo "</ul>\n";
}
?>