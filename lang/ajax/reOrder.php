<?php

include('dbConfig.php');
require_once("../resource/makeOrder.php");


$uid = 1;

if(!isset($_GET['order_id']))
{
  redirect('/');
}

$order_id = $_GET['order_id'];
$place_code = $_COOKIE['place_code'];

// WHAT TO DO

$order = new order();
$order_list = $order->reOrder($order_id,$place_code);

echo json_encode($order_list);

?>
