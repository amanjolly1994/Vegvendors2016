<?php
include("dbConfig.php");
session_start();
$place_code="4";
if($_POST)
{
$q=$_POST['search'];
if(!($sql_res=mysqli_query($con,"select * FROM sabziz s inner join sabzi_price sp on s.sabzi_id = sp.sabzi_id WHERE s.sabzi_name or s.hindi_name like '%$q%' and sp.place_code = '$place_code' ORDER BY s.sabzi_name DESC LIMIT 5 ")))
{
echo mysqli_error($con);
}
else{
while($row=mysqli_fetch_array($sql_res))
{
$username=$row['sabzi_name'];

$b_username='<strong>'.$q.'</strong>';

$final_username = str_ireplace($q, $b_username, $username);

?>

<a href="show1venderdetail.php?id=<?php echo $row['sabzi_id'];?>">
<div class="show" align="left">
<?php echo "<img src='".$row['sabzi_pic']."'style='width:50px; height:50px; float:left; margin-right:6px;' />";?><span class="name"><?php echo $final_username; ?></span>&nbsp;<br/>
</div></a>
<?php
}
}
}
?>
