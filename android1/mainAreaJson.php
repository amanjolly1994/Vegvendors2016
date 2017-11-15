<?php

include_once ('dbConfig.php');
echo AreaList();



function AreaList()
{		
		global $db;
		
		$q1 = "SELECT * FROM area_table";

		$res1 = $db->query($q1);

        
        $mahaArray = array();
        $areaArray= array();

        $mahaArea=new stdClass();

$area=new stdClass();

		while( $row1 = $res1->fetch_assoc() )
		{
		      
            
           	$area->AreaName=$row1['area'];
            $area->AreaCode=$row1['id'];

            $area_id = $row1['id'];

            $q2 = "SELECT * FROM `places` WHERE area='$area_id'";

            $res2 = $db->query($q2);
             $placesArray=array();

            while( $row2 = $res2->fetch_assoc() ) 
            {
                $places=new stdClass();
                $places->PlaceCode=$row2['place_code'];
                $places->AreaCode=$area_id;

                $place_code = $row2['place_code'];

                 $q3 = "SELECT * FROM `subareas` WHERE place_code=$place_code";

                 $res3 = $db->query($q3);
                 $subareaArray=array();
                 while( $row3 = $res3->fetch_assoc() )
                 {
                 	$subarea = new stdClass();
                 	$subarea->SubareaCode=$row3['sno'];
                 	$subarea->PlaceCode=$place_code;
                 	$subarea->Subareas=$row3['subareas'];
                 	

        			array_push($subareaArray, $subarea);
                 }
                 $places->SubAreas=$subareaArray;
                 array_push($placesArray,$places);
                 
            }
            $area->places=$placesArray;
            array_push($areaArray,$area);            
            
		}
        
		$mahaArea->Area=$areaArray;
        //array_push($mahaArray,$mahaArea);


    return json_encode($mahaArea);
}




?>