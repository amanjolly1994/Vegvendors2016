<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0">

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
session_start();
include('dbConfig.php');
include("header.php");

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
				<li><a href="#">Tables</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							 <tr>
								  <th>order_id</th>
								  <th>uid</th>

								  <th>USER</th>
								  <th>Email</th>
								  <th>contact</th>

								  <th>total_price</th>
								  <th>order_date</th>
								  <th>timeslot_id</th>
								  <th>type_of_delivery</th>
								
								  <th>delivery @</th>
								  <th>controls</th>
								  
								  
								  
								  
							  </tr>
						  </thead>   
						  <tbody>
						  
			<?php			
	
 $result = mysqli_query($db,"CALL main_orders_JOIN_registered_users('SELECT',null,null)") or die("Query fail: " . mysqli_error());
while( $row = $result->fetch_assoc() )
{

  if ($row['delivery_status']==0)
  {

  		if ($row['type_of_delivery']==1)
  		{
  			$delivery_type="cash";
  		}
  		elseif ($row['type_of_delivery']==2)
  		{
  			$delivery_type="paytm";
  		}
  		elseif ($row['type_of_delivery']==3)
  		{
  			$delivery_type="online payment";
  		}
  		elseif ($row['type_of_delivery']==0)
  		{
  			$delivery_type="not defined";
  		}



      
			 
      
			 

			?>	


							<tr>
								
								<td><?php echo $row['order_id']; ?>

									<a class="btn btn-success" href="suborders.php?id=<?php  echo $row['order_id'] ;?>">
									
								
								 
									
								
										<i class="halflings-icon white zoom-in"></i>  
									</a>

								</td>
							  
								<td><?php echo $row['uid']; ?></td>
							    
								<td><?php echo $row['user_name']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['contact']; ?></td>


								<td><?php echo $row['total_price']; ?></td>
								<td><?php echo $row['order_date']; ?></td>
								<td><?php echo $row['timeslot_id']; ?></td>
								<td><?php echo $delivery_type; ?></td>
								
								<td><?php echo $row['delivery_address']; ?></td>

										 <td class="center">
									<a class="btn btn-success" href="confirm_mainorders.php?sno=<?php echo $row['order_id'];?>&id=<?php  echo $row['order_id'] ;?>">

										<i class="halflings-icon ok"></i>  
									</a>
									
									<a class="btn btn-danger" href="delete.php?id=<?php  echo $row['order_id'] ;?>">
										<i class="halflings-icon white trash"></i> 
									</a>
									<a class="btn btn-info" href="subedit.php?id=<?php echo $row['order_id'] ;?>">
										<i class="halflings-icon white edit"></i>  
									</a>
								</td> 


								 
								
							</tr>
						
		 
				
					 

<?php

	}
}

?>	

	 </table> 				
	 
	 </div>
				</div><!--/span-->
			
			</div>
			<!--/row-->

		
			
			<!--/span-->
			
			<!--/row-->
			
		<!--/row-->
    

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
