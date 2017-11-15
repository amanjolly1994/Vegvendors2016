<?php
	 include_once '../dbConfig.php';



function vegnmlist()
{
global $db;

$query1 = $db->query("select sabzi_id,sabzi_name,hing_name,hindi_name FROM sabziz");




$innercover=array();

 


		while( $row2 = $query1->fetch_assoc() )
		{  
				
				$veglist=array();
				$subdata = new stdClass();
				
				$vegnmlist = new stdClass();
				$subdata->name=$row2['sabzi_name'];
				$subdata->hinglish=$row2['hing_name'];	
				$subdata->hindi_name=$row2['hindi_name'];
				array_push($veglist,$subdata);
				$vegnmlist->sabzi_id=$row2['sabzi_id'];
                $vegnmlist->sabziNames=$veglist;
                
				array_push($innercover,$vegnmlist);
				
				
	
		}
		
			
		$outercover=new stdClass();
		$outercover->vegnmlist=$innercover;
		
		return json_encode($outercover);
}
?>