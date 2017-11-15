<?php
//session_start();
	require_once 'dbConfig.php';
// if(isset($_COOKIE["PHPSESSID"]))
// {	
if(isset($_POST["code"]) && !empty($_POST["code"]))
{
		$placecode=$_POST["code"];

		
//$placecode = 4;

  //////////////main json wrapper/////////
  $mahajson=new stdClass();

  $mahajson->ProductList=sabziList($placecode);
  //$mahajson->vendorList=vendorList($placecode);
  $mahajson->adv=adv($placecode);
  $mahajson->vendorImgurl=VendorBaseImgUrl();
  $mahajson->sabziImgurl=SabziBaseImgUrl();
  $mahajson->express_delivery=express_deliverylist($placecode);

  echo json_encode($mahajson);
}
else
{
	echo "posting problem";
}
// }

 /////////////////////////////////////////
 
function sabziList($placecode)
{		
			global $db;
		$placecode=$placecode;
		$q = "SELECT sp.sabzi_id, sp.price_per_kg, s.sabzi_name,s.sabzi_category ,s.rate FROM `sabzi_price` sp INNER JOIN `sabziz` s ON sp.sabzi_id = s.sabzi_id WHERE sp.place_code = $placecode ORDER BY s.sabzi_category";

		$res = $db->query($q);

		$mainSabzi=array();

		$same = 0;

		$sabziList = array();

		$count = $res->num_rows;

		if( $count > 0 )
		{



		while( $row = $res->fetch_assoc() )
		{

			if( $same == $row['sabzi_category'] )
			{
				
				
				$subdata = new stdClass();
				$subdata->sid=$row['sabzi_id'];
				//$subdata->vegetable=$row['sabzi_name'];
				$subdata->IncrimentRate=$row['rate'];
				$subdata->price=$row['price_per_kg'];
				
	

				array_push($sabziList,$subdata);
				$data->subcat=$sabziList;
			}
			else
			{	
				if ($row['sabzi_category']==1)
				{
					$category="Lifeline Veggies";
				}
				if ($row['sabzi_category']==2)
				{
					$category="Green Veggies";
				}
				if ($row['sabzi_category']==3)
				{
					$category="Green Veggies 2";
				}
				if ($row['sabzi_category']==4)
				{
					$category="Chutney Items";
				}
				
				
                
				$data = new stdClass();
				$sabziList = array();
				//$data->$category=$row['sabzi_category'];

				$subdata = new stdClass();
				$subdata->sid=$row['sabzi_id'];
				//$subdata->vegetable=$row['sabzi_name'];
				$subdata->IncrimentRate=$row['rate'];
				$subdata->price=$row['price_per_kg'];

				
                
                array_push($sabziList,$subdata);
                $data->categoryName=$category;
                $data->categoryId=$row['sabzi_category'];

				$data->subcat=$sabziList;
                
                
			
                array_push($mainSabzi,$data);
                
                
			}



			$same = $row['sabzi_category'];

		}
		$sabzi_list = new stdClass();
        $sabzi_list->product="Vegetable";
		$sabzi_list->values=$mainSabzi;
		$sabzi_list->vendorList=vendorList($placecode);
        $s = new stdClass();
        $s=$sabzi_list;
		//echo json_encode($sabzi_list);
		
		$TotalList = array();
		array_push($TotalList,$s);
		return ($TotalList);

		}

		else
		{
			$status = "not fetched sabzi details";

			array_push($mainSabzi,$status);

			//echo json_encode($mainSabzi);
			return $mainSabzi;
		}
}

///////////////// vendor details ////////////////////////////////////////////////////////////


function vendorList($placecode)
{
global $db;
$placecode=$placecode;
$query1 = $db->query("select * FROM sabzi_wala WHERE place_code = '$placecode'");
$same = 0;		
$vendor=array();
$vendorList = array();
$lifelineVeggies= array();
$GreenVeggies = array();
$GreenVeggies2 = array();
$ChutneyItems = array();
$data = new stdClass();
$data2 = new stdClass();
$data3 = new stdClass();
$data4 = new stdClass();





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
				
				
				$subdata1 = new stdClass();
				$subdata1->vid=$row2['svid'];
				$subdata1->name=$row2['name'];
				$subdata1->gender=$row2['gender'];
				$subdata1->available=$row2['available'];
				$subdata1->pic=$row2['pic'];
				
				array_push($lifelineVeggies,$subdata1);
				
				
				
			}
			if($row2['sabzi_category2']==1)
			{
				
				
				$subdata2 = new stdClass();
				$subdata2->vid=$row2['svid'];
				$subdata2->name=$row2['name'];
				$subdata2->gender=$row2['gender'];
				$subdata2->available=$row2['available'];
				$subdata2->pic=$row2['pic'];
				
				
			
				array_push($GreenVeggies,$subdata2);
				
				
			}
			if($row2['sabzi_category3']==1)
			{
				
				
				$subdata3 = new stdClass();
				$subdata3->vid=$row2['svid'];
				$subdata3->name=$row2['name'];
				$subdata3->gender=$row2['gender'];
				$subdata3->available=$row2['available'];
				$subdata3->pic=$row2['pic'];
				
				
			
				array_push($GreenVeggies2,$subdata3);
				
				
			}
			if($row2['sabzi_category4']==1)
			{
				
				
				$subdata4 = new stdClass();
				$subdata4->vid=$row2['svid'];
				$subdata4->name=$row2['name'];
				$subdata4->gender=$row2['gender'];
				$subdata4->available=$row2['available'];
				$subdata4->pic=$row2['pic'];
				
	
				
				
				array_push($ChutneyItems,$subdata4);
				
				
			}

			
			
		}
		$cat1="Lifeline Veggies";
		$cat2="Green Veggies";
		$cat3="Green Veggies 2";
		$cat4="Chutney Items";
		 $data->category=$cat1;
		 $data->categoryId='1';
		 $data->value=$lifelineVeggies;
		 array_push($vendor,$data);
		 $data2->category=$cat2;
		 $data2->categoryId='2';
		 $data2->value=$GreenVeggies;
		 array_push($vendor,$data2);
		 $data3->category=$cat3;
		 $data3->categoryId='3';
		 $data3->value=$GreenVeggies2;
		 array_push($vendor,$data3);
		 $data4->category=$cat4;
		 $data4->categoryId='4';
		 $data4->value=$ChutneyItems;
		 array_push($vendor,$data4);

		$vendor_list = new stdClass();
		$vendor_list=$vendor;
	//	echo json_encode($vendor_list);
		return ($vendor_list);
}

/////////////////////////////////adv//////////////////////////////////

//echo adv($placecode);
function adv($placecode)
{		
		global $db;
		$placecode=$placecode;
		$q = "SELECT * FROM `advertisement` WHERE place_code = '$placecode' and adv_type='0' " ;

		$res = $db->query($q);

	

		$count = $res->num_rows;

		if( $count > 0 )
		{



$cover= array();
		while( $row = $res->fetch_assoc() )
		{
				$subdata = new stdClass();
				
				

				$advlist=array();
			$subdata->placecode=$placecode;
			$subdata->ad_id = $row['ad_id'];
			$subdata->hyperlocal = $row['hyperlocal'];
			//$subdata->basepath='../content/adv/';
			$subdata->link=$row['link'];
			//$subdata->piclink=$row['picture'];
			
			array_push($cover,$subdata);			
			
		}
		
		$adv= new stdClass();
		$adv->value=$cover;
		$adv->basepath='../content/adv/';
		//return json_encode($adv);
		return ($adv);

		}

		else
		{
			$status = "adv details unavailable";
			$adv=array();
			array_push($adv,$status);

			//return json_encode($adv);
			return ($adv);
		}
}		
						
///////////////////////////////////////////////////////////////vendor base image url////////////////
function VendorBaseImgUrl()
{
	return $vendorImgurl="not defined";
}
//////////////////////////////////////////////////////////////sabzi base image url/////////////////						
						
	function SabziBaseImgUrl()
{
	return $sabziImgurl="android/sabzi-pics";
}			
/////////////////////////////////////////////////////////////express_deliverylist////////////////////
function express_deliverylist($placecode)
{
global $db;
$placecode=$placecode;
$query1 = $db->query("select * FROM express_delivery where place_code='$placecode'");









		while($row2=$query1->fetch_assoc())
		{  
				
				$explist=array();
				$subdata = new stdClass();
				
				$vegnmlist = new stdClass();
				$subdata->DurationTime=$row2['duration'];	
				$subdata->Px=$row2['charges'];
				array_push($explist,$subdata);
				
				
				
	
		}
			$expnmlist=new stdClass();
			$expnmlist=$explist;
			

		
		return($expnmlist);
}	
	 






?>
