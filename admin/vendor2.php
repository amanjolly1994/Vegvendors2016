<?php
	//Include Database configuration File dbConfig.php

	include('dbConfig.php');
	


		
			$pc=$_POST['place_code'];
			 $query1 = $db->query("select * FROM sabzi_wala WHERE place_code = '$pc'");
		while($row=$query1->fetch_assoc())
		{  
				if ($row['available']==1)
						{
							echo "Available";
						}
						else echo "Unavailable"; 
						
						echo $row['name']; 
						echo $row['svid']; 
						echo $row['gender']; 
						echo $row['pic'];
						echo $row['sabzi_category1'];
						echo $row['sabzi_category2'];
						echo $row['sabzi_category3'];
						echo $row['sabzi_category4'];
				
				
				
	
				
				if ($row['available']==1)
						{
							echo "Available";
						}
						else 
						{
						echo "Unavailable"; 
						}
						
						
						
						$category1 = "";
						$category2 = "";
						$category3 = "";
						$category4 = "";
						
						if ($row['sabzi_category1']==1)
						{
							$category1="Category 1";
						}
						if ($row['sabzi_category2']==1)
						{
							$category2="Category 2";
						}
						if ($row['sabzi_category3']==1)
						{
							$category3="Category 3";
						}
						if ($row['sabzi_category4']==1)
						{
							$category4="Category 4";
						}


						echo $category1." ".$category2." ".$category3." ".$category4 ;

					}
	 

	json_encode($row);
	
				?>