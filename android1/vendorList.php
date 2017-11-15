<?php
	//Include Database configuration File dbConfig.php

	include('dbConfig.php');
$response=array();
$vendors=array();
	


		
			$pc=$_POST['place_code'];
			 $query1 = $db->query("select * FROM sabzi_wala WHERE place_code = '$pc'");
		while($row=$query1->fetch_assoc())
		{  
				if ($row['available']==1)
						{
							$response["status"]="available";
						}
						else $response["status"]="unavailable"; 
						
						$response['name']=$row['name']; 
						$response['id']=$row['svid']; 
						$response['gender']=$row['gender']; 
						$response['pic']=$row['pic'];
						$response['cat1']=$row['sabzi_category1'];
						$response['cat2']=$row['sabzi_category2'];
						$response['cat3']=$row['sabzi_category3'];
						$response['cat4']=$row['sabzi_category4'];
	array_push($vendors,$response);
				
	}
	 

	echo json_encode($vendors);
	
?>