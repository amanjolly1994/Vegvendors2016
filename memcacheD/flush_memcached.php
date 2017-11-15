<?php
$m = new Memcache();
$m->addServer('localhost', 11211);

/* flush all items in 10 seconds */
echo $m->flush();
?>
