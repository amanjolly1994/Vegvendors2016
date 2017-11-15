<html>
<head>
<title>jagriti</title>
</head>
<body>
<?php

$phn=$_POST['phone'];
include('dbConfig.php');


?>

<h3>DETAILS</h3>



<FORM NAME ="form1" METHOD ="POST" ACTION ="details.php">


<?php 
include('dbConfig.php');           
$query1 = $db->query("SELECT * FROM registered_users WHERE contact='$phn'");
			 while($row1=$query1->fetch_assoc())
			 {            
            
      ?>    

<table>	  
            <tr>
               <td>UID:</td>
               <td><input type = "text" name = "UID" value="<?php echo $row1['uid']; ?>"></td>
			   
            </tr>
			
			
			
			 <tr>
               <td>USERNAME:</td>
               <td><input type = "text" name = "USERNAME" value="<?php echo $row1['user_name']; ?>"></td>
			   
            </tr>
			
			
			 <tr>
               <td>EMAIL:</td>
               <td><input type = "text" name = "EMAIL" value="<?php echo $row1['email']; ?>"></td>
			   
            </tr>
			
			
			 <tr>
               <td>PLACE CODE:</td>
               <td><input type = "text" name = "PLACE" value="<?php echo $row1['place_code']; ?>"></td>
			   
            </tr>
			
			
			 <tr>
               <td>PHONE NO.:</td>
               <td><input type = "text" name = "phone" value="<?php echo $row1['contact']; ?>"></td>
			   
            </tr>
			
			 <tr>
               <td>DELIVERY ADDRESS:</td>
               <td><input type = "text" name = "DELIVERY"value="<?php echo $row1['delivery_address']; ?>"></td>
			   
            </tr>
			
			<?php
			
			 }
			 
			 ?>
			 
			 
			 </table>

			 <P align="center">
			 <input type = "submit" name = "btn1" value = "Next" >
			 
		
			 </P>
			 
			 </form>
			  
			  
			  
					
								
</body>

</html>