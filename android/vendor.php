<?php
	require_once 'dbConfig.php';

	//if( $_POST )
		//$placecode = $_POST['place_code'];
$placecode = 7;
$query1 = $db->query("select * FROM sabzi_wala WHERE place_code = '$placecode'");
$same = 0;		
$vendor=array();
$vendorList = array();
$lifelineVeggies= array();
$GreenVeggies = array();
$GreenVeggies2 = array();
$ChutneyItems = array();
$data2 = new stdClass();
$subdata1 = new stdClass();
$subdata2 = new stdClass();
$subdata3 = new stdClass();
$subdata4 = new stdClass();

		while($row2=$query1->fetch_assoc())
		{  
				if ($row2['available']==1)
						{
							$response["status"]="available";
						}
						else 
						
						{
							$response["status"]="unavailable"; 
						}
						
						



		
		

			if($row2['sabzi_category1']==1)
			{
				
				
				
				$subdata1->vid=$row2['svid'];
				$subdata1->name=$row2['name'];
				$subdata1->gender=$row2['gender'];
				$subdata1->available=$row2['available'];
				$subdata1->pic=$row2['pic'];
				
				array_push($lifelineVeggies,$subdata1);
				$data2->lifelineVeggies=$lifelineVeggies;
				
				
			}
			if($row2['sabzi_category2']==1)
			{
				
				
				
				$subdata2->vid=$row2['svid'];
				$subdata2->name=$row2['name'];
				$subdata2->gender=$row2['gender'];
				$subdata2->available=$row2['available'];
				$subdata2->pic=$row2['pic'];
				
				
			
				array_push($GreenVeggies,$subdata2);
				$data2->GreenVeggies=$GreenVeggies;
				
			}
			if($row2['sabzi_category3']==1)
			{
				
				
				
				$subdata3->vid=$row2['svid'];
				$subdata3->name=$row2['name'];
				$subdata3->gender=$row2['gender'];
				$subdata3->available=$row2['available'];
				$subdata3->pic=$row2['pic'];
				
				
			
				array_push($GreenVeggies2,$subdata3);
				$data2->GreenVeggies2=$GreenVeggies2;
				
			}
			if($row2['sabzi_category4']==1)
			{
				
				
				
				$subdata4->vid=$row2['svid'];
				$subdata4->name=$row2['name'];
				$subdata4->gender=$row2['gender'];
				$subdata4->available=$row2['available'];
				$subdata4->pic=$row2['pic'];
				
	
				
				
				array_push($ChutneyItems,$subdata4);
				$data2->ChutneyItems=$ChutneyItems;
				
			}

			
			
		}
		array_push($vendor,$data2);
		$vendor_list = new stdClass();
		$vendor_list->vendordetail=$vendor;
		echo json_encode($vendor_list);

?>