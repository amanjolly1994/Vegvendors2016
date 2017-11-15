<?php

session_start();
include('dbConfig.php');
require '../PHPMailerAutoload.php';

if(isset($_POST["email"]))
	$email = $_POST["email"];

$af = $db->query("SELECT * FROM registered_users WHERE email='$email'");

$count = $af->num_rows;

if($count>0)
{
	$row = $af->fetch_assoc();

	$uid = $row['uid'];
	$name = $row["user_name"];

	$ch = $db->query("SELECT * FROM forget WHERE uid='$uid'");

	$ch_count = $ch->num_rows;

	// Random Code

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789#@";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 24) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }





	if($ch_count==0)
	{
		$stmt = $db_con->prepare("INSERT INTO forget(uid,code) VALUES(:uid, :code)");
		$stmt->bindParam(":uid",$uid);
		$stmt->bindParam(":code",$pass);
		$stmt->execute();
		confirmAll($email,$pass,$name);
	}
	else
	{
		$up = $db->query("UPDATE forget SET code='$pass' WHERE uid='$uid'");
		confirmAll($email,$pass,$name);
	}
}

else {
	echo "not available";
}

function confirmAll($email,$pass,$name)
{
	echo "done";

	$reset_url="http://www.vegvendors.in/forgotPassword/reset?xc=$pass";

	//mail starts

	$results_messages = array();

$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');

class phpmailerAppException extends phpmailerException {}

try {
$to = $email;
$user_name = $name;
if(!PHPMailer::validateAddress($to)) {
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
$mail->addAddress($to, $user_name);
$mail->Subject  = "Reset Password";
$body = "<p>This email has been sent to your address because it was entered in the forgotten password form when signing in to Veg Vendors.</p>
					<br>
					<p>Click on the following link to reset your password</p>
					<br>
				".$reset_url."<br>
					If this email was sent in error then please ignore it.
				";


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

?>
