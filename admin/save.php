<?php

include('../dbConfig.php');

$svid=$_POST["subziw"];
$oid=$_POST["sno"];
if($query2 = $db->query("UPDATE sub_orders SET svid='$svid' where sno='$oid'"))

{
	
	echo "done";
	
}	

else
{
	echo mysqli_error($db);
	
}
	?>