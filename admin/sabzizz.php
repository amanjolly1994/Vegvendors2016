<?php 

include('../dbConfig.php');
$pc=$_POST['place_code'];
$query1 = $db->query("SELECT s.sabzi_id,s.sabzi_name,s.sabzi_category,s.sabzi_pic,s.rate,p.price_per_kg,p.place_code FROM sabziz s inner join sabzi_price p on s.sabzi_id=p.sabzi_id WHERE place_code= '$pc'");
while($row1=$query1->fetch_assoc())
{

$info['sabzi_id'] = $row1['sabzi_id'];




$info['sabzi_name'] = $row1['sabzi_name'];



$info['sabzi_category'] = $row1['sabzi_category'];


$info['sabzi_pic'] = $row1['sabzi_pic'];



$info['price_per_kg'] = $row1['price_per_kg'];


$info['rate'] = $row1['rate'];
}
	json_encode($info);

?>
