<?php

include('dbConfig.php');
session_start();

$uid = $_SESSION['uid'];

if(!isset($_POST['order_id']))
{
  redirect('/');
}

$order_id = $_POST['order_id'];

if( $q = $db->query("UPDATE main_orders SET delivery_status=-1 WHERE uid='$uid' AND order_id='$order_id'") )
{
  // ORDER CANCEL SUCCESSFULL - SEND MAIL
  
}

?>
