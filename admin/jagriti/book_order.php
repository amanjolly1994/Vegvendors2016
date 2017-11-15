<?php

include('dbConfig.php');
$uid=$_POST['UID'];
$total_price=$_POST['amount'];

$qu

$query4 = $db->query("INSERT INTO main_orders(uid,total_price)VALUES($uid,$total_price)");



echo"done";

$plc=$_POST['place'];


$id=mysqli_insert_id($db); 

//for ($i=0; $i < count($_POST['sabziz']); $i++) 
foreach($_POST['sabziz'] as $checkbox=>$val)
{

    echo $_POST['price'][$checkbox]."\n";
    echo "quantity".$_POST['qty'][$checkbox]."\n";
	echo $_POST['sabzi_name'][$checkbox]."\n";
	echo $_POST['subziw'][$checkbox]."\n";// change it to dynamic
	
	$sabzi_name=$_POST['sabzi_name'][$checkbox];
    $price = $_POST['price'][$checkbox];
	$qty = $_POST['qty'][$checkbox];
	$svid=$_POST['subziw'][$checkbox];
	
$stmt = $db->prepare("INSERT INTO sub_orders(order_id,sabziz,qty_in_kg,price,svid)VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss",$id,$sabzi_name,$qty,$price,$svid);
if($stmt->execute())
{
echo "sub_orders hogaye hahahahaha";

}	
else
{
echo $stmt->error;

}
}	
// if($query3 = $db->query("INSERT INTO sub_orders(order_id,sabziz,qty_in_kg,price,svid)VALUES($id,$sabzi_name,$qty,$price,$svid)"))
// { 
// echo "sub_orders hogaye hahahahaha";
// }
// else
// {
 // echo mysqli_error($db);
// }
	
	
	
//{
	
	 //$sn="sabzi_name_".$checkbox;
	//echo  $name;
	
    // echo  $sabzi_name= $_POST['sabzi_name'][$checkbox];
    // echo $price = $_POST['price'][$checkbox];
	// echo $qty = $_POST['qty'][$checkbox];
	





//}
?>

