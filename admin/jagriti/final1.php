<html>
<head>
<title>sddddddds</title>

</head>
<?php

include('dbConfig.php');
if(isset($_POST['placecode']) && !empty($_POST['placecode']))
{
$sa=$_POST['placecode'];

}
else 
$sa=1;


$plc=$sa;
$query3 = $db->query("SELECT sabzi_name FROM sabziz");

$query4 = $db->query("SELECT svid,name FROM sabzi_wala WHERE place_code ='$plc'");
$row4=$query4->fetch_assoc();



?>




<label>place code:</label>
<input type="text" name="place" value="<?php echo $plc;?>">






<h5>SELECT  SUBZIWALA</h5>

<div class="row">
<label>Subziwala:</label><br/>
<select name="subziw" id="subziw" class="demoInputBox">
    <option value="">Select subziwala</option>
	<option value="<?php echo $row4["svid"]; ?>"><?php echo $row4["name"]; ?></option>
</select>
</div>


</div>

            
              





<h5>SELECT SABZIZS</h5>
<?php
foreach($query3 as $subzi)
{
	?>
<select>
  <option value="1">1kg</option>
  <option value="2">2kg</option>
  <option value="3">3kg</option>
  <option value="4">4kg</option>
  <option value="5">5kg</option>
  <option value="6">6kg</option>
  <option value="7">7kg</option>
  <option value="8">8kg</option>
  <option value="9">9kg</option>
  <option value="10">10kg</option>
  </select>
 
 <input type="checkbox" name="sabziz"><?php echo $subzi['sabzi_name'];?><br>
 
 
<?php

}

?>
  

           
            
               <h5>ENTER DELIVERY ADDRESS:</h5>
               <textarea name = "address" rows = "5" cols = "40" ></textarea><br>
			   
			   
		
			 
 <P align="center">
			 <input type = "submit" name = "btn1" value = "BOOK YOUR ORDER" >             
            
  </body>
</html>  