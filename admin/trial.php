<html>
<head>
<title>abcd</title>
</head>
<body>
<?php

$uid=$_POST['UID'];
if(isset($_POST['placecode']) && !empty($_POST['placecode']))
{
$plc=$_POST['placecode'];

}

?>

<label>UID:</label>
<input type="text" name="UID" value="<?php echo $uid;?>" readonly>
<br>

<br>

<label>place code:</label>
<input type="text" name="place" value="<?php echo $plc;?>" readonly></br>





<input type="button" name="cat1" value="category 1" href="category1.php"></br>

<input type="button" name="cat2" value="category 2" href="category2.php"></br>

<input type="button" name="cat3" value="category 3" href="category3.php"></br>

<input type="button" name="cat4" value="category 4" href="category4.php"></br>


</body>
</html>





