<?php

?>
<?php
          include("dbConfig.php");

$id=$_GET['id'];


$sql = "DELETE FROM sabzi_price WHERE prsno='$id'";
if (mysqli_query($db,$sql))
{                            
	include("../memcacheD/set_mainJson.php");
 ?> 
								<script>
						            alert("your price has been deleted");
									window.location= "view_price.php";
						           
						        </script>
								<?php
}
else
echo mysqli_error($db);

?>