<?php
include_once('dbConfig.php');
$id=$_GET['id'];

$query1 = $db->query("DELETE FROM main_orders WHERE order_id= '$id'");
$query2 = $db->query("DELETE FROM sub_orders WHERE order_id= '$id'");


if(($query1)&&($query2))
{

echo"record deleted";
}
		
else{
    echo "ERROR:";
	
}
	






 
       
		
					

	   
      
         
        
      ?>