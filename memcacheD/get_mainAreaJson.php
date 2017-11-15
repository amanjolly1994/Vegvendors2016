
<?php

$timestamp="2017-01-02 09:13:25";

//calling function to compare timestamp
echo mainAreaJsonGet($timestamp);

function mainAreaJsonGet($timestamp)
{
$timestamp=$timestamp;
if (class_exists('Memcache')) {
    $meminstance = new Memcache();
    echo "memcache";
} else {
    $meminstance = new Memcached();
    echo "memcached";
}

$meminstance->addServer('127.0.0.1', 11211);

$result = $meminstance->get("mainAreaJson");

if ($result) 
{

	$yummy = json_decode($result,true);
	$cache_timestamp=$yummy["timestamp"];

	if(strcmp($timestamp,$cache_timestamp)==0)
		{

		$status="same";
		
		 
		echo $json="{\"Json\":\"same json\","."\"timestamp\":"."\"".$timestamp."\",\"status\":"."\"".$status."\"}";

		  
			
		}
	else
	{
		 return $result;
	    echo "<br/><br/>getting data from cache........!with placecode as key mainAreaJson <br/><br/>";
	}	

	

    
} 
else 
{
    return $false="<br/><br/>No matching key found.! with placecode as key vegnmlist <br/><br/>";
   
}








	// { 

	// 	echo " <br/><br/><br/><br/>data set from cache........!with placecode as key".$placecode;

	// }
	// else
	// {
	// 		echo " <br/><br/><br/><br/>data not set from cache........!with placecode as key".$placecode;

	// }



}




?>