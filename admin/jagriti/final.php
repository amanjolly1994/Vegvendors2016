<?php

$phn=$_POST['phone'];
include('dbConfig.php');
$query1 = $db->query("SELECT distinct area FROM places");

?>
<html>
<head>
<title>jagriti</title>
	<!-- JAVASCRIPT LINKED HERE -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js" ></script>

<script>

$(document).ready(function(){
    $('#location-list').on('change',function(){
        var area = $(this).val();
        if(area){
            $.ajax({
                type:'POST',
                url:'get_state1.php',
                data:'area='+area,
                success:function(html){
                    $('#subarea-list').html(html);
               		alert("going"+area); 		
                }
				,
    error: function(XMLHttpRequest, errorThrown) { 
	alert("Error: " + errorThrown); 
    }       
		
    
            }); 
        }else{
            $('#subarea-list').html('<option value="">No area selected</option>');
            
        }
    });
});
</script>
</head>
<body>


<h3>DETAILS</h3>



<FORM NAME ="form1" METHOD ="POST" ACTION ="amount1.php">


<?php 
           
$query= $db->query("SELECT * FROM registered_users WHERE contact='$phn'");
			 while($row1=$query->fetch_assoc())
			 {            
            
      ?>    

<table>	  
            <tr>
               <td>UID:</td>
               <td><input type = "text" name = "UID" value="<?php echo $row1['uid']; ?>" readonly ></td>
			   
            </tr>
			
			
			
			 <tr>
               <td>USERNAME:</td>
               <td><input type = "text" name = "USERNAME" value="<?php echo $row1['user_name'];  ?>"  readonly></td>
			   
            </tr>
			
			
			 <tr>
               <td>EMAIL:</td>
               <td><input type = "text" name = "EMAIL" value="<?php echo $row1['email']; ?>" readonly></td>
			   
            </tr>
			
			
			 
			
			 <tr>
               <td>PHONE NO.:</td>
               <td><input type = "text" name = "phone" value="<?php echo $row1['contact']; ?>" readonly></td>
			   
            </tr>
			
			
			<tr>
               <td>ENTER DELIVERY ADDRESS:<td>
               <td><textarea name = "address"  rows = "5" cols = "40" ><?php echo $row1['delivery_address']?></textarea></td><br>
			   
			 </tr>  
			
			
			<?php
			
			 }
			 
			 

			 
			 ?>
			 
			 
			 </table>
			 
			 <h5>SELECT LOCATION:</h5> 
			  
               <div class="frmDronpDown">
<div class="row">
<label>Location</label><br/>
<select name="location" id="location-list" class="demoInputBox">
<option value="">Select location</option>
<?php
foreach($query1 as $location) {
?>
<option value="<?php echo $location['area']; ?>"><?php echo $location['area']; ?></option>
<?php
}
?>
</select>


</div>

<h5>SELECT  SUB AREA</h5>
			   
<div class="row">
<label>Sub Area:</label><br/>
<select name = "placecode" id="subarea-list" class="subarea-list">
<option value="">Select area first</option>
</select>
</div>








</div>

			 <P align="center">
			 <input type = "submit" name = "btn1" value = "Next" >
			 
		
			 </P>
			 
</form>
			  
			  
			  
					
								
</body>

</html>
