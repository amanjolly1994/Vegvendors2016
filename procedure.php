<?php
//db details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'proceduretest';

//Connect and select the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

//proceduretest_CRUD ('SELECT',"","");
 echo $result = mysqli_query($db,"CALL proceduretest_CRUD('SELECT',null,null)") or die("Query fail: " . mysqli_error());
while( $row = $result->fetch_assoc() )
{
	echo $row["name"];
	echo $row["id"];
	echo $row["email"];
	echo $row["pwd"];


}


?>