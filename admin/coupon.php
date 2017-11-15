<html>
   
   <head>
      <title>PHP Form Validation</title>
   </head>
   
   <body>
    <?php

include('../dbConfig1.php');

$cpn="";
$val="";
$code="";
$per="";





if(isset($_POST['value']) && isset($_POST['code']) )
{
	$cpn=$_POST['code'];
	$val=$_POST['value'];
$code=$_POST['code'];

}


$ss ="SELECT percentage FROM coupon where coupon_code='$cpn'";
$result=mysqli_query($con, $ss);
$row=mysqli_fetch_assoc($result);
mysqli_close($con);

$per=$row['percentage'];

$dis=(($per)*($val))/100;
$new=$val-$dis;

?>	

<script>

var disc ="<?php echo $new;?>";

alert(disc);


</script>

   
      <h2>COUPON</h2>
	  
	  
	<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
         <table>
            
            
            
            
            <tr>
               <td>VALUE:</td>
               <td><input type = "text" name = "value" value="<?php echo $val; ?>"></td>
			   
            </tr>
			
			<tr>
               <td>CODE:</td>
               <td><input type = "text" name = "code" value="<?php echo $code; ?>"></td>
			   
            </tr>
			
			<tr>
               <td>PERCENTAGE:</td>
               <td><input type = "text" name = "percentage" value="<?php echo $row['percentage']; ?>"></td>
			   
            </tr>
			
			<tr>
               <td>NEW AMOUNT:</td>
               <td><input type = "text" name = "amount" value="<?php echo $new; ?>"></td>
			   
            </tr>
			<tr>
               <td>DISCOUNT:</td>
               <td><input type = "text" name = "discount" value="<?php echo $dis; ?>"></td>
			   
            </tr>
<tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit"> 
               </td>
            </tr>
			
			
               
         </table>
      </form>
      
   </body>
</html>