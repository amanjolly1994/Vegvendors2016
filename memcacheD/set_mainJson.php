
<?php

include('MainJsonFx.php');

//calling functions
mainJsonSet();




 

function mainJsonSet()
{

if (class_exists('Memcached')) {
    $meminstance = new Memcached();
    echo "memcached";
} else {
    $meminstance = new Memcache();
    echo "memcache";
}

// $v=AreaList();

// $timestamp=mainAreaJsonFx_timestamp_maker();
//  $json="{\"Json\":".$v.","."\"timestamp\":"."\"".$timestamp."\"}";

$meminstance->addServer('127.0.0.1', 11211);


$meminstance->set("mainJson",All_mainJson_encoder());
	// { 

	// 	echo " <br/><br/><br/><br/>data set from cache........!with placecode as key".$placecode;

	// }
	// else
	// {
	// 		echo " <br/><br/><br/><br/>data not set from cache........!with placecode as key".$placecode;

	// }


$result = $meminstance->get("mainJson");

if ($result) {

	$yummy = json_decode($result,true);
	
	//echo json_encode($yummy[4]["timestamp"]);
	//echo $yummy[0]["timestamp"];
		

	

   echo $result;
    echo "<br/><br/>getting data from cache........!with placecode as key mainJson <br/><br/>";
} else 
{
    echo "<br/><br/>No matching key found.! with placecode as key mainJson <br/><br/>";
   
}
}




?>