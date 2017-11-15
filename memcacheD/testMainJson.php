<?php

include('mainJson.php');

 $placecode="4";
 $v=mainJson($placecode);
$status="enable";
$timestamp="12234455";
echo $json="{\"status\":"."\"".$status."\","."\"JsON\":".$v.","."\"timestamp\":"."\"".$timestamp."\"}";

//echo $v;
?>