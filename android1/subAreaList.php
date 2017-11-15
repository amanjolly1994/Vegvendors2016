<?php
//Include database configuration file
include('dbConfig.php');

$subarea=array();
$response=array();
$i=0;

if(isset($_POST["area"]) && !empty($_POST["area"])){
$aj=$_POST["area"];
    //Get all state data
    $query = $db->query("SELECT * FROM subareas s INNER JOIN places p on s.place_code = p.place_code WHERE p.area = '$aj' ORDER BY subareas ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        
        while($row = $query->fetch_assoc()){ 
            $subarea["place"]=$row["subareas"];
            $subarea["code"]=$row["place_code"];
            array_push($response,$subarea);
		}
		echo json_encode($response);
        }
    else{
         $subarea["place"]="No Subarea";
         $subarea["code"]=-1;
            array_push($response,$subarea);
		echo json_encode($response);
    }
}

?>	