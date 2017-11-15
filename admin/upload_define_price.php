<?php
/* instantiate our class, and select our database automatically */
include('dbConfig.php');

 
/*
let's assume we've just received a form submission.
so we'll receive the information, and we'll escape it
this step is not necessary, but why not.
*/

$subareacode= $_POST['placecode'];
$sabzi_id= $_POST['sabzi_id'];
$price = $_POST['price'];


$subareacode=stripslashes($subareacode);
$sabzi_id=stripslashes($sabzi_id);
$price=stripslashes($price);


$subareacode=mysqli_real_escape_string($db,$subareacode);
$sabzi_id=mysqli_real_escape_string($db,$sabzi_id);
$price=mysqli_real_escape_string($db,$price);



//selection and check
$query3 = $db->query("SELECT * FROM `sabzi_price` WHERE `sabzi_id` = $sabzi_id  AND `place_code` = $subareacode ");
    
    //Count total number of rows
    $rowCount = $query3->num_rows;
    
        if($rowCount > 0)
{   

	$row3= $query3->fetch_assoc();
	
	$prsno=$row3["prsno"];

//update
	$query3 = $db->query ("UPDATE `sabzi_price` SET `price_per_kg` = '".$price."' WHERE `prsno` ='".$prsno."'");

 echo "new value updated";




} 
/* build the query, we'll use an insert this time */
else 
{
$query = $db->prepare ("INSERT INTO `sabzi_price`(sabzi_id,place_code,	price_per_kg) VALUES ('".$sabzi_id."','".$subareacode."','".$price."')");

}
/*
bind your parameters to your query
in our case, string integer string
*/

/* execute the query, nice and simple */
if (!($query->execute())&&!($query3))
{
echo "error execute";
echo $db->error;


}
else
{
	include("../memcacheD/set_mainJson.php");
 ?> 
<script>
alert("inserted");
window.location ="define_price.php";

</script>
<?php
}



?>