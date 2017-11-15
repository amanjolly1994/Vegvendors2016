
<?php

$timestamp="2017-01-02 09:122";
$placecode=4;

//calling function to compare timestamp
echo mainJsonGet($timestamp,$placecode);

function mainJsonGet($timestamp,$placecode)
{
$timestamp=$timestamp;
$placecode=$placecode;
if (class_exists('Memcache')) {
    $meminstance = new Memcache();
    echo "memcache";
} else {
    $meminstance = new Memcached();
    echo "memcached";
}

$meminstance->addServer('127.0.0.1', 11211);

$result = $meminstance->get("mainJson");

if ($result) 
{

	$yummy = json_decode($result,true);
	echo $cache_timestamp=$yummy[$placecode]["timestamp"];

	if(strcmp($timestamp,$cache_timestamp)==0)
		{

		$status="same";
		
		 
		echo $json="{\"Json\":\"same json\","."\"timestamp\":"."\"".$timestamp."\",\"status\":"."\"".$status."\"}";

		  
			
		}
	else
	{
		

		 return json_encode($yummy[$placecode]);
	    echo "<br/><br/>getting data from cache........!with placecode as key MainJson  <br/><br/>";
	}	

	

    
} 
else 
{
    return $false="<br/><br/>No matching key found.! with placecode as key mainJson <br/><br/>";
   
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