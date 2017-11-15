<?php
session_start();
include('dbConfig.php');
require_once("../resource/makeOrder.php");

if(!isset($_COOKIE['place_code']))
{
  redirect('/');
}

if( !isset($_SESSION['uid']) )
{
  redirect('/');
}

$uid = $_SESSION['uid'];

if(!isset($_POST['order_id']))
{
  redirect('/');
}

$order_id = $_POST['order_id'];
$place_code = $_COOKIE['place_code'];

// WHAT TO DO

$order = new order();
$order_list = $order->reOrder($order_id,$place_code);

echo json_encode($order_list);

?>
