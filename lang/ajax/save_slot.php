<?php

	session_start();

	$slot = $_POST["slot"];

	$_SESSION["slot"] = $slot;

	echo "done";



?>