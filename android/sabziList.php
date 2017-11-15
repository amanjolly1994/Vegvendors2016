<?php
//Include database configuration file
include('dbConfig.php');
 
$sabzi=array();
$response=array();
$i=0;
 
if(isset($_POST["code"]) && !empty($_POST["code"])){
$code=$_POST["code"];
    //Get all state data
    $query = $db->query("SELECT sp.sabzi_id, sp.price_per_kg,s.hindi_name,s.hing_name,s.sabzi_name, s.rate, s.sabzi_category,s.sabzi_pic FROM  `sabzi_price` sp, sabziz s WHERE sp.place_code =$code AND sp.sabzi_id = s.sabzi_id ORDER BY sp.sabzi_id");
 
    //Count total number of rows
    $rowCount = $query->num_rows;
 
    //Display states list
    if($rowCount > 0){
 
        while($row = $query->fetch_assoc()){ 
            $sabzi["id"]=$row["sabzi_id"];
            $sabzi["name"]=$row["sabzi_name"];
            $sabzi["category"]=$row["sabzi_category"];
            $sabzi["weight"]=$row["rate"];
            $sabzi["price"]=$row["price_per_kg"];
            $sabzi["pic"]=$row["sabzi_pic"];
			$sabzi["hindi_name"]=$row["hindi_name"];
			$sabzi["hing_name"]=$row["hing_name"];
 
            array_push($response,$sabzi);
		}
		echo json_encode($response);
        }
    else{
         $sabzi["id"]=-1;
            array_push($response,$sabzi);
		echo json_encode($response);
    }
}
 
?>	