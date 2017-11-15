s<?php 

include('../dbConfig.php');

$query1 = $db->query("SELECT w.svid,w.name,w.sabzi_category1,w.sabzi_category2,w.sabzi_category3,w.pic,p.place_code FROM sabzi_wala w inner join sabzi_price p on p.place_code= w.place_code WHERE place_code=4");
while($row1=$query1->fetch_assoc())
{
$infon['svid'] = $row1['svid'];

echo $infon['svid'] ;
echo "<br>";

$infon['name'] = $row1['name'];

echo $infon['name'] ;
echo "<br>";

$infon['sabzi_category1'] = $row1['sabzi_category1'];

echo $infon['sabzi_category1'];
echo "<br>";

$infon['sabzi_category2'] = $row1['sabzi_category2'];

echo $infon['sabzi_category2'];
echo "<br>";

$infon['sabzi_category3'] = $row1['sabzi_category3'];

echo $infon['sabzi_category3'];
echo "<br>";

$info2['pic'] = $row1['pic'];

echo $infon['pic'] ;
echo "<br>";

$info2n['place_code'] = $row1['place_code'];

echo $infon['place_code'];
echo "<br>";
echo "<br>";

mysqli_close($con);

}
?>

