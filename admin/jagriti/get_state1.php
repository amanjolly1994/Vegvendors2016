
<?php
//Include database configuration file
include('dbConfig.php');

if(isset($_POST['area']) && !empty($_POST['area'])){
$aj=$_POST['area'];

    //Get all state data
   $query = $db->query("SELECT * FROM subareas s INNER JOIN places p on s.place_code = p.place_code WHERE p.area = '$aj' ");
    
   // Count total number of rows
   $rowCount = $query->num_rows;
    
   // Display states list
   if($rowCount > 0){
        
       while($row = $query->fetch_assoc()){ 
            
			  echo '<option value="'.$row['place_code'].'">'.$row['subareas'].'</option>';
        }
    }else{
        echo '<option value="">subarea not available</option>';
    }
 }
else{
        echo '<option value="">not available</option>';
    }
?>