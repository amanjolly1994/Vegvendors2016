<?php


echo date('Y-m-d_H:i:s');

$slot1_active = "";
$slot2_active = "";
$slot3_active = "";

$slot1_time = "06:30:00";
$slot2_time = "12:30:00";
$slot3_time = "17:30:00";
if( time() > strtotime($slot1_time) )
  echo $slot1_active = "disabled";

if( time() > strtotime($slot2_time) )
  echo $slot2_active = "disabled";

if( time() > strtotime($slot3_time) )
  echo $slot23_active = "disabled";

?>
