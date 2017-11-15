<?php
include('mainJson.php');
mainJsonSet("5");
mainJsonSet("4");




function mainJsonSet($placecode)
{
$placecode=$placecode;
if (class_exists('Memcache')) {
    $meminstance = new Memcache();
    echo "memcache";
} else {
    $meminstance = new Memcached();
    echo "memcached";
}


$meminstance->addServer('127.0.0.1', 11211);


$meminstance->set($placecode,mainJson($placecode));
	// {

	// 	echo " <br/><br/><br/><br/>data set from cache........!with placecode as key".$placecode;

	// }
	// else
	// {
	// 		echo " <br/><br/><br/><br/>data not set from cache........!with placecode as key".$placecode;

	// }


$result = $meminstance->get($placecode);

if ($result) {
    echo $result;
    echo "<br/><br/>getting data from cache........!with placecode as key".$placecode."<br/><br/>";
} else 
{
    echo "<br/><br/>No matching key found.! with placecode as key".$placecode."<br/><br/>";
   
}
}
?>