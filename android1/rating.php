<?php

  require_once "dbConfig.php";

  if( $_POST )
  {
    $userId = $_POST["uid"];
    $orderId = $_POST["order_id"];
    $rating = $_POST["rating"];

    if( $db->query("UPDATE main_orders SET order_rating='$rating' WHERE order_id='$orderId' AND  uid='$userId'") )
    {
      echo "ok";
    }
    else {
      echo "error";
    }

  }

?>
  