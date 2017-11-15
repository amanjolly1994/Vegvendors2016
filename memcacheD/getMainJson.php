<?php
$placecode="4";
if (class_exists('Memcache')) {
    $meminstance = new Memcache();
    echo "memcache";
} else {
    $meminstance = new Memcached();
    echo "memcached";
}

$meminstance->addServer('127.0.0.1', 11211);

$result = $meminstance->get($placecode);

if ($result) {
    echo $result;
    echo "<br/><br/>getting data from cache........!with placecode as key".$placecode."<br/><br/>";
} else 
{
    echo "<br/><br/>No matching key found.! with placecode as key".$placecode."<br/><br/>";
   
}

?>