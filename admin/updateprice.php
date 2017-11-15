
<html>

		<link rel="stylesheet" type="text/css" href="css/deo pages/insert.css"  />
		<link rel="stylesheet" type="text/css" href="css/deo pages/ajresponsive.css" media="screen and (max-width: 650px)" />
		<link rel="stylesheet" type="text/css" href="css/deo pages/style.css" />
		<link href="css/deo pages/main-style.css" rel="stylesheet" type="text/css">
<?php
          include("dbConfig.php");

$id=$_GET['id'];


$sql = "select * FROM sabzi_price WHERE prsno ='$id'";
if ($res=mysqli_query($db,$sql))
{
 while($row=mysqli_fetch_array($res))
{
?>


<form action="update_sabzi_price_mid.php" method="post" enctype="multipart/form-data">

<p>Sabzi price per kg</p>
<input type="text" name="price" required="" value="<?php echo $row['price_per_kg']?>" /> 

<input style="display:none;" type="text" name="prsno" required="" value="<?php echo $row['prsno']?>" /> 
 
<input type="submit" class="btn btn-colored btn-lg btn-blue" value="Update sabzi price" />

</form>
<?php
}
 
}
else
echo mysqli_error($con);

?>

</html>