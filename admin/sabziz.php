<?php 

include('../dbConfig.php');

$query1 = $db->query("SELECT s.sabzi_id,s.sabzi_name,s.sabzi_category,sabzi_pic,p.price_per_kg,p.place_code FROM sabziz s inner join sabzi_price p on s.sabzi_id=p.sabzi_id WHERE place_code=4");
while($row1=$query1->fetch_assoc())
{

$info['sabzi_id'] = $row1['sabzi_id'];

echo $info['sabzi_id'];
echo "<br>";

$info['sabzi_name'] = $row1['sabzi_name'];

echo $info['sabzi_name'];
echo "<br>";

$info['sabzi_category'] = $row1['sabzi_category'];

echo $info['sabzi_category'];
echo "<br>";

$info['sabzi_pic'] = $row1['sabzi_pic'];

echo $info['sabzi_pic'];
echo "<br>";

$info['price_per_kg'] = $row1['price_per_kg'];

echo $info['price_per_kg'];

echo "<br>";

}


?>
