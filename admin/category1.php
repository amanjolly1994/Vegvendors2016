<?php



$query3 = $db->query("SELECT z.sabzi_name,s.price_per_kg FROM sabzi_price s INNER JOIN sabziz z  on s.sabzi_id = z.sabzi_id WHERE s.place_code= '$plc' && sabzi_category=1");
$query4 = $db->query("SELECT svid,name FROM sabzi_wala WHERE place_code ='$plc' && sabzi_category1=1");
$row4=$query4->fetch_assoc();



<h5>SELECT SABZIZS</h5>

 while($row = $query3->fetch_assoc())
{
	?>

 <input type="checkbox" name="sabziz" class="abc" id="sabziz" value="<?php echo  $row['price_per_kg'];?>"><?php echo $row['sabzi_name'];?></input>
 <input type="text" name="price" style="width: 70px" value="<?php echo $row['price_per_kg']." per kg "; ?>">
 <input type="text" name="qty" style="width: 50px"></br>
 

<?php
}
?>

<h5>SELECT  SUBZIWALA</h5>

<div class="row">
<label>Subziwala:</label><br/>
<select name="subziw" id="subziw" class="demoInputBox">
    <option value="">Select subziwala</option>
	<option value="<?php echo $row4["svid"]; ?>"><?php echo $row4["name"]; ?></option>
</select>
</div>


