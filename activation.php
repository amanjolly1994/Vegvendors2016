<?php

echo "AAA VVV";

session_start();
include('dbConfig.php');

if(!empty($_GET['pa']) && isset($_GET['pa']))
{
$code=$_GET['pa'];

$query=$db->query("SELECT uid FROM registered_users WHERE activation='$code'");

if($query->num_rows > 0)
{	
	if( $db->query("UPDATE registered_users SET activation='active' WHERE activation='$code' ") )
	{
		$_SESSION['activation'] = "1";
		redirect("/?wtp=eactd");
	}

	else{
		echo "Update error";
	}
}
}

else
{
	redirect("/?wtp=nact");
}

?>