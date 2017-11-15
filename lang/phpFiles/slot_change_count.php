<?php

  session_start();

  include('dbConfig.php');

  $order_id = $_POST["order_id"];

  $uid = $_SESSION["uid"];

  $q = $db->query("SELECT * FROM main_orders WHERE order_id='$order_id' AND uid='$uid'");

  $row = $q->fetch_assoc();

  if( $row['timeslot_change_counter'] == 0 )
    echo "ok";
  else {
    echo "not Available";
  }

?>
