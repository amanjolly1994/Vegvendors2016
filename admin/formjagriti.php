



<html>
<head>
<title>login</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$nam=$_POST['name'];

$phn=$_POST['phone'];

$email=$_POST['mail'];

$add=$_POST['address'];

$gen=$_POST['gender'];

}

?>





<form name="form", method="POST" ,action="formjagriti.php">

Name:<input type="text" name="name" value="<?php echo $nam;?>"><br>


Phone no: <input type="text" name="phone" value=<? echo $phn;?>"><br>

Email:<input type="text" name="mail" value="<?php echo $email;?>"><br>

Address: <input type="textarea" name="address" rows="5" cols="40" value="<?php echo $add;?>"><br>

Gender:
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="female") echo "checked";?>
value="female">Female
<input type="radio" name="gender"
<?php if (isset($gender) && $gender=="male") echo "checked";?>
value="male">Male

<input type="submit" name="sbmit" value="Submit">


</form>



<?php






<?php

echo "<H3>YOUR INPUT</H3>";


NAME:<?php echo $nam; ?><br>

PHONE:<?php echo $phn; ?><br>

EMAIL:<?php echo $mail; ?><br>

ADDRESS:<?php echo $add; ?><br>

GENDER:<?php echo $gen; ?><br>

?>

>?



