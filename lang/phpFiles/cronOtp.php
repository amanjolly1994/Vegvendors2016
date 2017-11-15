<?php 

include('dbConfig.php');

 $query1 = "DELETE FROM `temp_otp` WHERE timestamp &gt; DATE_SUB(NOW(), INTERVAL 10 MINUTE)"; 

$query2 = "DELETE FROM temp_otp
WHERE timestamp < NOW() - INTERVAL 1 MINUTE";

$query3 = "DELETE FROM temp_otp WHERE time_of_otp < NOW() - INTERVAL 10 MINUTE";

if( $q = $db->query($query3) )
{
	echo "AWESOME";
}
else
	echo "BAD";

?>