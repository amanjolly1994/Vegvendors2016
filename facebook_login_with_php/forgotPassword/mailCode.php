<?php

session_start();
include('dbConfig.php');

if(isset($_POST["email"]))
	$email = $_POST["email"];	

$af = $db->query("SELECT * FROM registered_users WHERE email='$email'");

$count = $af->num_rows;

if($count>0)
{
	$row = $af->fetch_assoc();

	$uid = $row['uid'];

	$ch = $db->query("SELECT * FROM forget WHERE uid='$uid'");

	$ch_count = $ch->num_rows;

	// Random Code

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789#@"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 24) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 


	if($ch_count==0)
	{
		$stmt = $db_con->prepare("INSERT INTO forget(uid,code) VALUES(:uid, :code)");
		$stmt->bindParam(":uid",$uid);
		$stmt->bindParam(":code",$pass);
		$stmt->execute();
		echo "done";
	}
	else
	{
		$up = $db->query("UPDATE forget SET code='$pass' WHERE uid='$uid'");
		echo "done";
	}
}


?>