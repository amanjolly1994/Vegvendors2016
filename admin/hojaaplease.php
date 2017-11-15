<!DOCTYPE html>
<html lang="en">
<head>
<title>abcd</title>
</head>
<body>
<form name="edit" method="POST" action="save.php">

<?php			
	
	
	include('../dbConfig.php');
include("header.php");
$orderid=$_GET["id"];
$plc=$_GET["plc"];
$sabzi=$_GET["sabzi"];

	$query2 = $db->query("select sabzi_category from sabziz where sabzi_name='$sabzi'");
	$row3=$query2->fetch_assoc();
	
	$cat="sabzi_category".$row3["sabzi_category"];
	
	
	$query1 = $db->query("select sno from suborders where order_id='$orderid'");
			 $row2=$query1->fetch_assoc();
				 
				 
			?>	
<table>

							<tr>
								
								
								
								<td class="center"><select name="subziw" id="subziw" class="demoInputBox">
								<option value="">Select subziwala</option>
	
							
								<?php
								$query6 = $db->query("select * FROM sabzi_wala where place_code='$plc' AND $cat=1");
			 while($row4=$query6->fetch_assoc())
				 
			 
			 {
				 
				 ?>
								
								
    <option value="<?php echo $row4["svid"]; ?>"><?php echo $row4["name"]; ?></option>
	
			 <?php
			 
			 }
			 
			 ?>
	
	</td>
									<td><input type="text" name="sno" value="<?php echo $row2['sno'];?>"></td>
									<td><input type="button" name="button" value="submit"></td>
									
									<form/>
								
							</tr>
							
							</table>
							
							</form>
							
	</body>
</html>	