
<?php

$sabzitimestamp="2017-01-24 11:54:52";
$vendortimestamp="2017-01-24 11:54:52";
$placecode=4;

//calling function to compare timestamp
echo timestamp_check($sabzitimestamp,$vendortimestamp,$placecode);

function timestamp_check($sabzitimestamp,$vendortimestamp,$placecode)
{
$sabzitimestamp=$sabzitimestamp;
$vendortimestamp=$vendortimestamp;
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

	$json = json_decode($result,true);
	echo $cache_vendortimestamp=$json[$placecode]["vendorTimestamp"];
	echo $cache_sabzitimestamp=$json[$placecode]["sabziTimestamp"];

	if((strcmp($vendortimestamp,$cache_vendortimestamp)!=0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)!=0))
		{

			
			$json[$placecode]["vendor_status"]="changed";
			$json[$placecode]["sabzi_status"]="changed";
			return json_encode($json[$placecode]);

		  
			
		}
	elseif((strcmp($vendortimestamp,$cache_vendortimestamp)!=0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)==0))
		{

			
			$json[$placecode]["vendor_status"]="changed";
			
			return json_encode($json[$placecode]);

		  
			
		}
	elseif((strcmp($vendortimestamp,$cache_vendortimestamp)==0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)!=0))
		{

			
			$json[$placecode]["sabzi_status"]="changed";
			
			return json_encode($json[$placecode]);

		  
			
		}
	elseif((strcmp($vendortimestamp,$cache_vendortimestamp)==0)&&(strcmp($sabzitimestamp,$cache_sabzitimestamp)==0))
		{

			
			return $message="nothing changed all ok....taking orders";
			
			//order();

		  
			
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