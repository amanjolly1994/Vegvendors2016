<?php
require_once("../smtp.php");
$email=$_POST['email'];
$email2="mvpitampura@gmail.com";
$name=$_POST['name'];
$body = $_POST['body'];
$subject=$_POST['subject'];
//echo $body;
if(send_mail($email,$name,$body,$subject))
{
	echo "Email Sent";
}
if(send_mail($email2,$name,$body,$subject))
{
	echo "Email Sent to master vendor";
}
    

?>
