<?php

session_start();
include('dbConfig.php');
require_once '../../smtp.php';

$uid = $_SESSION['uid'];

$find = $db->query("SELECT * FROM registered_users WHERE uid='$uid'");

$usr_row = $find->fetch_assoc();

$user_email = $usr_row['email'];
$user_name = $usr_row['user_name'];
$phone = $usr_row['contact'];

if(!isset($_POST['order_id']))
{
  redirect('/');
}

$order_id = $_POST['order_id'];

if( $q = $db->query("UPDATE main_orders SET delivery_status=-1 WHERE uid='$uid' AND order_id='$order_id'") )
{
  // ORDER CANCEL SUCCESSFULL - SEND MAIL
  echo "done";
  $subject = "Order Cancelled!";
  $body = "<p>Hello <b>$user_name</b>, <br><br>
              You have successfully cancelled Order Id: <b>#$order_id</b>.
              <br>
              If still the delivery arrives then please tell the vendor that you have cancelled your order.
              <br>
              To check your order login to Veg Vendors and goto your Dashboard.
            <br><br>
            Sincerely<br>
            <b>Veg Vendors Team</b>
          </p>";
  send_mail($user_email, $user_name, $body, $subject);


  //mail for admin vendor

$admin_vendor_email="mvpitampura@gmail";
$subject="CANCEL ORDER INFO";
$body = "<p>Hello <b>$user_name</b>, <br><br>
              You have successfully cancelled Order Id: <b>#$order_id</b>.
              <br>
              If still the delivery arrives then please tell the vendor that you have cancelled your order.
              <br>
              To check your order login to Veg Vendors and goto your Dashboard.
            <br><br>
            Sincerely<br>
            <b>Veg Vendors Team</b>
          </p>";
send_mail($admin_vendor_email, $user_name, $body, $subject);

  //mail for admin vendor ends
}

else {
  echo "error";
}

?>
