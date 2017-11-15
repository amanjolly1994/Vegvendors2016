<?php

  require_once "dbConfig.php";

  if( $_POST )
  {
    $userId = $_POST["uid"];
    $complain = $_POST["complain"];

    try {
      $stmt = $db_con->prepare("INSERT INTO complain(`uid`, `complain`,`date`) VALUES(:uid, :complain,:time)");
      $stmt->bindParam(":uid", $userId);
      $stmt->bindParam(":complain", $complain);
       $stmt->bindParam(":time", date('Y-m-d H:i:s'));


      // GENERATE complaint number or token

      if( $stmt->execute() )
        echo "ok"; // also SEND EMAILS for this
      else
        echo "Error";

    } catch (PDOException $e) {
      echo $e->getMessage();
    }

  }

?>
