<?php 
include('../dbconfig1.php');
 
$parent_cat = $_GET['parent_cat'];
$sa="SELECT * FROM sub areas WHERE area_id = '$parent_cat'" ;
$query = mysqli_query($con,$sa);

while($row = mysqli_fetch_array($query)) { ?>
	<option value="<?php echo $row['id']; ?>"><?php echo $row['sub area name']; ?></option>

	<?php
	
	}
 
?>

