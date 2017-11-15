<?php

include_once("dbConfig.php");

$phone = $_POST['newPhone'];

$q1 = $db->query("SELECT contact FROM registered_users WHERE contact='$phone'");

$rowCount = $q1->num_rows;

if( $rowCount > 0 )
  echo 0;
else
  echo 1;

?>
