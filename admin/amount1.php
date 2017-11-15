<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start: Header -->
<?php

include("header.php");
include_once('dbConfig.php')

?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php

include("sidemenu.php");

?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>

			

			
						
			
<script type="text/javascript"src="js/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function(){
	
	var total = 0;

	$(".abc").click(function(){
		
		if( this.checked )
		{
			var amt = $(this).val();
			
			var c_name = $(this).attr("title");
			
			console.log(c_name);
			
			var qty = $("."+c_name).val();
			
			console.log(qty);
			var sub = amt*qty;
			
			console.log(sub);	
			
			total += sub;
			
		}
		
		$("#amount").val(total);
		
	});
		
	
});

</script>

</head>

<form name="form1" METHOD="POST" ACTION="book_order.php">
<?php

if(isset($_POST['placecode']) && !empty($_POST['placecode']))
{
$sa=$_POST['placecode'];

}
else 
$sa=1;


$plc=$sa;
$query3 = $db->query("SELECT * FROM sabzi_price s INNER JOIN sabziz z  on s.sabzi_id = z.sabzi_id WHERE s.place_code= '$plc'");

$uid=$_POST['UID'];
$row = $query3->fetch_assoc();




?>

<label>UID:</label>
<input type="text" name="UID" value="<?php echo $uid;?>" readonly>
<br>

<br>

<label>place code:</label>
<input type="text" name="place" value="<?php echo $plc;?>" readonly>

<?php

	
	



?>





            
              





<h5>SELECT SABZIZS</h5>
<?php
 while($row = $query3->fetch_assoc())
{

$cat="sabzi_category".$row['sabzi_category'];
?>
<label>Subziwala:</label><br/>	
<select name="subziw[<?php echo  $row['sabzi_id'];?>]" id="subziw" class="demoInputBox">
    <option value="100">Select subziwala</option>
	
	<?php

$query4 = $db->query("SELECT svid,name FROM sabzi_wala WHERE place_code ='$plc' AND $cat='1'");	
 while($row4 = $query4->fetch_assoc())
 {	 
	
	?>
	

	<option value="<?php echo $row4["svid"];?>"><?php echo $row4["name"]; ?></option>


<?php
 }
 
 ?>
</select>
 <input type="text" style="display:none;" name="sabzi_name[<?php echo  $row['sabzi_id'];?>]" value="<?php echo $row['sabzi_name'];?>" readonly >
 <input type="text" name="price[<?php echo  $row['sabzi_id'];?>]" style="width: 70px" value="<?php echo $row['price_per_kg']; ?>" readonly> per kg
 Enter the quantity:<input type="text" name="qty[<?php echo  $row['sabzi_id'];?>]" class="<?php echo $row['sabzi_id']; ?>" style="width: 50px"/>
 <input type="checkbox" name="sabziz[<?php echo  $row['sabzi_id'];?>]" title="<?php echo $row['sabzi_id']; ?>" class="abc" id="sabziz" value="<?php echo  $row['price_per_kg'];?>"><?php echo $row['sabzi_name'];?></input></br>
 
 


<?php



}

 

?>
  
<strong>Amount :</strong>: <input type="text" name="amount" id="amount" />

           
            
               <h5>ENTER DELIVERY ADDRESS:</h5>
               <textarea name = "address" rows = "5" cols = "40" ></textarea><br>
			   
			   
		
			 
 <P align="center">
			 <input type = "submit" name = "btn1" value = "BOOK YOUR ORDER" >  








			 
</form>	

</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2016 <a href="http://kryptotech.co.in/">vegvendors Dashboard</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
		 
            
 