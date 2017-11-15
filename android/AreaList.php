<?php
//Include database configuration file
include('dbConfig.php');


echo AreaList();

function AreaList()
{       
        global $db;
        
        $q = "SELECT * FROM `area_table`";

        $res = $db->query($q);

        
        $areaArray = array();
        $count = $res->num_rows;

        if( $count > 0 )
        {



        while( $row = $res->fetch_assoc() )
        {
            $area=new stdClass();
            $area->AreaName=$row['area'];
            $area->AreaCode=$row['id']; 
            
            array_push($areaArray,$area);
        }
        //$MainAreaArray = new stdClass();
//        $MainAreaArray->Area=$areaArray;
//      echo json_encode($MainAreaArray);
        //return ($MainAreaArray);

        }

        else
        {
            $status = "not fetched area details";

            array_push($areaArray,$status);

            //echo json_encode($areaArray);
            //return $areaArray;
        }
        
        ///////////////////////////////////////////////places table/////////////////////////////
        
        $q2 = "SELECT * FROM `places`";

        $res = $db->query($q2);

        
        $placesArray = array();
        $count = $res->num_rows;

        if( $count > 0 )
        {



        while( $row = $res->fetch_assoc() )
        {
            $places=new stdClass();
            $places->PlaceCode=$row['place_code'];
            $places->AreaCode=$row['area']; 
            
            array_push($placesArray,$places);
        }
        //$MainPlacesArray = new stdClass();
//        $MainPlacesArray->Places=$placesArray;
//      echo json_encode($MainPlacesArray);
        //return ($MainAreaArray);

        }

        else
        {
            $status = "not fetched place details";

            array_push($placesArray,$status);

            //echo json_encode($placesArray);
            //return $placesArray;
        }
        
        
        //////////////////////////////////////////////////////////subareas////////////////////////////////////
        
        

        
        $q2 = "SELECT * FROM `subareas`";

        $res = $db->query($q2);

        
        $subareasArray = array();
        $count = $res->num_rows;

        if( $count > 0 )
        {



        while( $row = $res->fetch_assoc() )
        {
            $subareas=new stdClass();
            $subareas->SubareaCode=$row['sno'];
            $subareas->PlaceCode=$row['place_code']; 
            $subareas->Subareas=$row['subareas'];
            
            array_push($subareasArray,$subareas);
        }
        
        //$MainSubAreasArray = new stdClass();
        //$MainSubAreasArray->SubAreas=$subareasArray;

    //  echo json_encode($MainSubAreasArray);
        //return ($MainSubAreasArray);

        }

        else
        {
            $status = "not fetched place details";

            array_push($subareasArray,$status);

            //echo json_encode($placesArray);
            //return $subareasArray;
        }


    $area_subarea=new stdClass();
    
    $area_subarea->Area=$areaArray;
    $area_subarea->Places=$placesArray;
    $area_subarea->SubAreas=$subareasArray;
    
    $location=new stdClass();
    $location->location=$area_subarea;
    //echo json_encode($location);
    return json_encode($location);
}



?>	