<?php

session_start();
include('dbConfig.php');

if(isset($_POST["token"]))
	$token = $_POST["token"];

$af = $db->query("SELECT * FROM complain WHERE token='$token'");

$count = $af->num_rows;

if($count>0)
{
	$row = $af->fetch_assoc();

	$uid = $row['uid'];
  $order_id = $row['order_id'];
	$complaint = $row['complain'];
  $date = $row['date'];
  $remark = $row['remark'];
  $status = $row['status'];

	$ch = $db->query("SELECT * FROM registered_users WHERE uid='$uid'");

	$ch_count = $ch->num_rows;

  $user = $ch->fetch_assoc();

  $name = $user['user_name'];
  $email = $user['email'];

  #Sending the printed result
   echo "<p class='complainTxt'>Name: <b>$name</b> <$email>
         <br><br>
         Order Id: <b>$order_id</b> | Token no: <b><u>$token</u></b>
         <br><br>
         Date of complaint: <b>$date</b>
         <br><br>
         Your complaint: <i>$complaint</i>
         <br>
         </p>";

   if( $status == 0 )
   {
     $sval = "In Progress";
     $rel = "Nothing Yet. Have Patience. We are solving your issue. We will get back you very soon.";
   }
   else if( $status == 1 )
   {
     $sval = "Complete";
     $rel = $remark;
   }

   echo "<p class='complainTxt'><br>Status: <b>$sval</b>
         <br><br>
         Result of complaint: <i>$rel</i>
         <br><br><br><br>
         <a href='/complaint-status'><< Another Token</a>
         </p>";

}

else {
  echo "wrong";
}

?>
