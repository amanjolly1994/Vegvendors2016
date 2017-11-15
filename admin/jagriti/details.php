


<?php 
include('dbConfig.php');
$query1 = $db->query("SELECT distinct area FROM places");
$query2 = $db->query("SELECT svid,name FROM sabzi_wala");
$query3 = $db->query("SELECT sabzi_name FROM sabziz");



?>





<html>
<head>
<title>jagriti</title>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "get_state1.php",
	data:'area='+val,
	success: function(data){
		$("#subarea-list").html(data);
	}
	});
}

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
</head>
<body>


<h3>FURTHER DETAILS:</h3>


              <h5>SELECT LOCATION:</h5> 
			  
               <div class="frmDronpDown">
<div class="row">
<label>Location</label><br/>
<select name="location" id="location-list" class="demoInputBox" onChange="getState(this.value);">
<option value="">Select location</option>
<?php
foreach($query1 as $location) {
?>
<option value="<?php echo $location["area"]; ?>"><?php echo $location["area"]; ?></option>
<?php
}
?>
</select>


</div>

<h5>SELECT  SUB AREA</h5>
			   
<div class="row">
<label>Sub Area:</label><br/>
<select name="subarea" id="subarea-list" class="demoInputBox">
<option value="">Select Sub area</option>
</select>
</div>
</div>
            
               <h5>ENTER SUBZIWALA</h5>
			 <div class="frmDronpDown">
<div class="row">
<label>Subziwala:</label><br/>
<select name="subzi" id="svendor-list" class="demoInputBox">
<option value="">Select Subziwala</option>
<?php
foreach($query2 as $subziwala) {
?>
<option value="<?php echo $subziwala["svid"]; ?>"><?php echo $subziwala["name"]; ?></option>
<?php
}
?>
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
			   
			   
		
			 
              
            
               
