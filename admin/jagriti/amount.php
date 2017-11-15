<html>
<head>
<title>sddddddds</title>
<script type="text/javascript"src="js/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function() { 
 $(".abc").click(function(event) {
	 var total = 0;
	 
	 $("#sabziz:checked").each(function() {
	 total += parseInt($(this).val());
	 
	 });
	 

	 if (total == 0) {
	 $('#amount').val('');
	 } else { 
	 $('#amount').val(total);
	 }

 
 });
 
 
}); 
</script>

</head>
<body>
<form name="form1" METHOD="POST" ACTION="book_order.php">
<?php

include('dbConfig.php');
if(isset($_POST['placecode']) && !empty($_POST['placecode']))
{
$sa=$_POST['placecode'];

}
else 
$sa=1;


$plc=$sa;
$query3 = $db->query("SELECT z.sabzi_name,s.price_per_kg FROM sabzi_price s INNER JOIN sabziz z  on s.sabzi_id = z.sabzi_id WHERE s.place_code= '$plc'");

$uid=$_POST['UID'];



?>

<label>UID:</label>
<input type="text" name="UID" value="<?php echo $uid;?>" readonly>
<br>

<br>

<label>place code:</label>
<input type="text" name="place" value="<?php echo $plc;?>" readonly>

<?php

$query4 = $db->query("SELECT svid,name FROM sabzi_wala WHERE place_code ='$plc'");
$row4=$query4->fetch_assoc();

?>




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
 while($row = $query3->fetch_assoc())
{
	?>

 <input type="checkbox" name="sabziz[<? echo $row['sabzi_id']; ?>]" class="abc" id="sabziz" value="<?php echo  $row['price_per_kg'];?>"><?php echo $row['sabzi_name'];?></input>
  <input type="text" name="sabzi_name_<? echo $row['sabzi_id']; ?>" value="<?php echo $row['sabzi_name'];?>" readonly >
 <input type="text" name="price_<? echo $row['sabzi_id']; ?>" style="width: 70px" value="<?php echo $row['price_per_kg']." per kg "; ?>" readonly>
 <input type="text" name="qty_<? echo $row['sabzi_id']; ?>" style="width: 50px"></br>
 
 
<?php

}

?>
  
<strong>Amount :</strong>: <input type="text" name="amount" id="amount" />

           
            
               <h5>ENTER DELIVERY ADDRESS:</h5>
               <textarea name = "address" rows = "5" cols = "40" ></textarea><br>
			   
			   
		
			 
 <P align="center">
			 <input type = "submit" name = "btn1" value = "BOOK YOUR ORDER" >  








			 
</form>			 
            
  </body>
</html>  