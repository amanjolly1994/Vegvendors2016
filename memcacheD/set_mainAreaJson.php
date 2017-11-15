
<?php

include('mainAreaJsonFx.php');

//calling functions
mainAreaJsonSet();


function mainAreaJsonFx_timestamp_maker()
{
	global $db;
	$q3 = "SELECT `update_timestamp` FROM `table_timestamp` where `tableName` = 'areaJson'  ORDER BY `tableName` ASC";

                 $res3 = $db->query($q3);
                 $timestamp='';
                 while( $row3 = $res3->fetch_assoc() )
                 {
                 	$timestamp=$timestamp.$row3['update_timestamp'];
	
                 }
                 
                 return $timestamp;

 }

 

function mainAreaJsonSet()
{

if (class_exists('Memcache')) {
    $meminstance = new Memcache();
    echo "memcache";
} else {
    $meminstance = new Memcached();
    echo "memcached";
}

$v=AreaList();

$status="changed";
$timestamp=mainAreaJsonFx_timestamp_maker();
 //$json="{\"Json\":".$v.","."\"timestamp\":"."\"".$timestamp."\"}";
 $json="{\"Json\":".$v.","."\"timestamp\":"."\"".$timestamp."\",\"status\":"."\"".$status."\"}";

$meminstance->addServer('127.0.0.1', 11211);


$meminstance->set("mainAreaJson",$json);
	// {

	// 	echo " <br/><br/><br/><br/>data set from cache........!with placecode as key".$placecode;

	// }
	// else
	// {
	// 		echo " <br/><br/><br/><br/>data not set from cache........!with placecode as key".$placecode;

	// }


$result = $meminstance->get("mainAreaJson");

if ($result) {

	// $yummy = json_decode($result,true);
	// echo $yummy["Json"]["Area"][0]["AreaName"];
		

	

    echo $result;
    echo "<br/><br/>getting data from cache........!with placecode as key mainAreaJson <br/><br/>";
} else 
{
    echo "<br/><br/>No matching key found.! with placecode as key mainAreaJson <br/><br/>";
   
}
}




?>