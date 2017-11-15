<?php

if (class_exists('Memcache')) {
    $meminstance = new Memcache();
    echo "memcache";
} else {
    $meminstance = new Memcached();
    echo "memcached";
}

$meminstance->addServer('127.0.0.1', 11211);

$result = $meminstance->get("test");

if ($result) {
    echo $result;
} else 
{
    echo "No matching key found.  Refresh the browser to add it!";
    $meminstance->set("test", "Successfully retrieved the data!") or die("Couldn't save anything to memcached...");
}

?>