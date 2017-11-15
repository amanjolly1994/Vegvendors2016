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
               		alert("selected area code"+area); 		
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

<?php

require_once("header.php");
require_once('dbConfig.php');








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

<?php
if (isset($_POST["placecode"])&&(!empty($_POST["placecode"])))
{
	
	$placecode=$_POST["placecode"];
	$query1 = $db->query("SELECT * FROM sabzi_price sp inner join sabziz s on s.sabzi_id=sp.sabzi_id where place_code=$placecode");
	$query2 = $db->query("SELECT * FROM  timeslot_availability where place_code=$placecode");


?>


					<div>
					<div class="box-content">
						<h1>Toggle Sabzi Availability</h1>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>sabzi id</th>
								  <th>place code</th>
								  <th>sabzi</th>
								  <th>price per kg</th>
								  <th>Availability</th>
								  <th>Toggle Availability</th>
								  
								  
								  
								  
							  </tr>
						  </thead>   
						  <tbody>
						  
			<?php			
	



while($row= $query1->fetch_assoc())
	
	{				

							if ($row['availability']==1)
							{
								$button="<span class='label label-success'>Availabile</span>";
								$t=0;
							}
							else
							{	
								$button="<span class='label label-important'>NOT Availabile</span>";
								$t=1;

							}	

      
			 
      
			 

			?>	


							<tr>
								<td><?php echo $row['sabzi_id']; ?></td>
							    <td><?php echo $row['place_code']; ?></td>
								<td><?php echo $row['sabzi_name']; ?></td>
								
								<td><?php echo $row['price_per_kg']; ?></td>
								
								<td><?php echo $button ?></td>
								<td class="center">
									<a class="btn btn-success" href="toggle_sabzi_availability.php?sno=<?php echo $row['prsno'];?>&t=<?php echo $t;?>">

										<i class="halflings-icon play-circle"></i>  
									</a>

								</td> 
								
							</tr>
						
		 
				
					 

<?php

	}


?>	
	 </table> 				
	 
	 </div>
	</div>

<?php
}




?>
<div>
					<div class="box-content">
						<h1>Toggle Timeslot Availability</h1>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Timeslot id</th>
								  <th>place code</th>
								  <th>Timeslot</th>
							
								  <th>Availability</th>
								  <th>Toggle Availability</th>
								  
								  
								  
								  
							  </tr>
						  </thead>   
						  <tbody>
						  
			<?php			
	



while($row= $query2->fetch_assoc())
	
	{

      
			 if ($row['availability']==1)
							{
								$button2="<span class='label label-success'>Availabile</span>";
								$t2=0;
							}
							else
							{	
								$button2="<span class='label label-important'>NOT Availabile</span>";
								$t2=1;

							}


			?>	


							<tr>
								<td><?php echo $row['timeslot_id']; ?></td>
							    <td><?php echo $row['place_code']; ?></td>
								<td><?php echo timestot($row['timeslot_id']); ?></td>
								
								
								
								<td><?php echo $button2 ?></td>
								<td class="center">
									<a class="btn btn-success" href="toggle_timeslot_availability.php?sno=<?php echo $row['sno'];?>&t=<?php echo $t2;?>">

										<i class="halflings-icon play-circle"></i>  
									</a>

								</td> 
								
							</tr>
						
		 
				
					 

<?php

	}


?>	
	 </table> 				
	 
	 </div>
	</div>

<?php

 function timestot($id)

{
      		if ($id==1)
							{
								$timestot="07 AM - 10 AM";
							}
			elseif ($id==2)
							{	
								$timestot="01 PM - 02 PM";

							}
			elseif ($id==3)
							{	
								$timestot="6 PM - 09 PM";

							}
			elseif ($id==4)
							{	
								$timestot="07 AM - 10 AM Tommorow";

							}								
			 elseif ($id==5)
							{	
								$timestot="01 PM - 02 PM Tommorow";

							}
			elseif ($id==6)
							{	
								$timestot="6 PM - 09 PM Tommorow";

							}	
		
								return $timestot;
		
		}			



?>

		   


	

	
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
			  
			  
					
								
