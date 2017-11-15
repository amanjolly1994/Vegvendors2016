



<html>
<head>
<title>sddddddds</title>
<script type="text/javascript"src="js/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function() { 
 $(".abc").click(function(event) {
	 var total = 0;
	 var total1= 0;
	 var quantity= 0;
	 
	 $("#sabziz:checked").each(function() {
	 total = parseInt($(this).val());
	 
	 
	 
	  $("#qty").each(function() {
	 quantity = parseInt($(this).val());
	 
	 alert(quantity*total);
	 
	 total1 += (quantity)*(total);
	 
	 });
	 
	 });
	 

	 if (total1 == 0) {
	 $('#amount').val('');
	 } else { 
	 $('#amount').val(total1);
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
$query3 = $db->query("SELECT * FROM sabzi_price s INNER JOIN sabziz z  on s.sabzi_id = z.sabzi_id WHERE s.place_code= '$plc'");



$uid=$_POST['UID'];
$row = $query3->fetch_assoc();
$cat="sabzi_category".$row['sabzi_category'];



?>

<label>UID:</label>
<input type="text" name="UID" value="<?php echo $uid;?>" readonly>
<br>

<br>

<label>place code:</label>
<input type="text" name="place" value="<?php echo $plc;?>" readonly>

<?php


$add=$_POST['address'];
$query7=$db->query("UPDATE registered_users SET delivery_address = '$add' WHERE uid = '$uid'");	
	



?>





            
              





<h5>SELECT SABZIZS</h5>
<?php
 while($row = $query3->fetch_assoc())
{
?>
<label>Subziwala:</label><br/>	
<select name="subziw[<?php echo  $row['sabzi_id'];?>]" id="subziw" class="demoInputBox">
    <option value="">Select subziwala</option>
	
	<?php

$query4 = $db->query("SELECT svid,name FROM sabzi_wala WHERE place_code ='$plc' AND $cat='1'");	
 while($row4 = $query4->fetch_assoc())
 {	 
	
	?>
	

	<option value="<?php echo $row4["svid"]; ?>"><?php echo $row4["name"]; ?></option>


<?php
 }
 
 ?>
</select>
 <input type="checkbox" name="sabziz[<?php echo  $row['sabzi_id'];?>]" class="abc" id="sabziz" value="<?php echo  $row['price_per_kg'];?>"><?php echo $row['sabzi_name'];?></input>
 <input type="text" style="display:none;" name="sabzi_name[<?php echo  $row['sabzi_id'];?>]" value="<?php echo $row['sabzi_name'];?>" readonly >
 <input type="text" name="price[<?php echo  $row['sabzi_id'];?>]" style="width: 70px" value="<?php echo $row['price_per_kg']; ?>" readonly>per kg
 <input type="text" name="qty[<?php echo  $row['sabzi_id'];?>]"  id ="qty" value="0" style="width: 50px">quantity</br>
 
 


<?php



}

 

?>
  
<strong>Amount :</strong>: <input type="text" name="amount" id="amount" />

           
            
              
		
			 
 <P align="center">
			 <input type = "submit" name = "btn1" value = "BOOK YOUR ORDER" >  








			 
</form>			 
            
  </body>
</html>  