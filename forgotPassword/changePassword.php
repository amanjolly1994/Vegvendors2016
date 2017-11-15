<?php

session_start();
include('dbConfig.php');

if(isset($_POST["password"]))
  $password = $_POST["password"];

$uid = $_SESSION["reset_uid"];
//$uid = 1;

if($update = $db->query("UPDATE registered_users SET pwd='$password' WHERE uid='$uid'"))
{
  if( $del = $db->query("DELETE FROM forget WHERE uid='$uid'") )
  {
    echo "done";
  }
}
else {
  echo "error";
}



?>
