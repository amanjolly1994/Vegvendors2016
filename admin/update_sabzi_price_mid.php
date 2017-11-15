<?php
/* instantiate our class, and select our database automatically */
include('dbConfig.php');

 
/*
let's assume we've just received a form submission.
so we'll receive the information, and we'll escape it
this step is not necessary, but why not.
*/
$price= $_POST['price'];
$prsno= $_POST['prsno'];

$price=mysqli_real_escape_string($db,$price);



/* build the query, we'll use an insert this time */
if(!($query = $db->query ("UPDATE `sabzi_price` SET `price_per_kg` = '".$price."' WHERE `prsno` ='".$prsno."'")))
{
echo "error";
echo $db->error;

}
/*
bind your parameters to your query
in our case, string integer string
*/

/* execute the query, nice and simple */
else
{

	include("../memcacheD/set_mainJson.php");
 ?> 
<script>
alert("updated");
window.location ="view_price.php";

</script>
<?php
}



?>