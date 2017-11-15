<?php
	//Include Database configuration File dbConfig.php
	session_start();
	include('dbConfig.php');
	
	// Checking whether a location cookie is set or not
	$shownArea = "";

	if( isset($_COOKIE["subareacode"]) )
	{
		$shownArea = $_COOKIE["subareacode"];
	}

	else 
	{	
		redirect("login.php");		
	}

	//Getting the name of subarea using subarea code
	 $query = $db->query("SELECT * FROM subareas WHERE sno = '$shownArea'");

	 $rowCount = $query->num_rows;

	 if( $rowCount > 0 )
	 {
	 	$row = $query->fetch_assoc();
	 	$subareaName = $row['subareas'];
		$place_code = $row['place_code']; 
	 }

	 else
	 	redirect("login.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-wdith, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />

	<!-- SEO SECTION -->
		<?php
		
		include("seo.php");
		
		
		?>

	<title>Online Vegetable Store to Order from Local Vendors - Veg Vendors</title>
	<link rel="shortcut icon" href="favicon.png" />

	<!-- Style Links -->

	<link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

	<!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
	<script type="text/javascript" src="/lang/js/h-basket.vvg.js" ></script>
	
	
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>

	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/registration_ajax.js"></script>
	<script type="text/javascript" src="/lang/ajax/login_ajax_script.js"></script>
	
	<!-- AJAX CONFIGURATION FOR AREA SECTION -->
	<script type="text/javascript">
	$(document).ready(function(){
	// Select Location Loading
		$(".tunnel-row-1").on("change", "#areaSelect", function(){		
			var area = $(this).val();
			if(area){
				$.ajax({
					type: 'POST',
					url: '/lang/ajax/ajaxAreaSelector.php',
					data: 'area='+area,
					success:function(html){
						$("#subAreaSelect").html(html);
						$("#subAreaSelect").selectpicker('refresh');
					}
				});
			}
			else{
				$("#subAreaSelect").html('<option value="">Select Area First</option>');
			}
		});

		// Change Vendor 
		$(".changeSelectedVendor").click(function(){
			$(".mainPage").css({left: '-400px', opacity: '0.5'});
			$(".tunnel").css({right: '0px'});
			$(".tunnel-row-1").load("changeVendor.php?cat=<?php echo $_GET['cat']; ?> #changeVendorDiv", function(){

			});
		});

	});
	</script>

	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>

</head>

<body class="no-class common">

<div class="mainPage">
	<header>
		<?php
include("header.php")		
		
		?>
	</header>

	<section>

		<!-- PAGE SECTION GOES HERE FOR NEW PAGE -->

		<div class="row">

			<div class="col-3">
			<?php
			$id=$_GET['id'];
			 $query1 = $db->query("select * FROM sabzi_wala WHERE svid = '$id'");
		while($row=$query1->fetch_assoc())
		{  
			
			
			?>
				<div class="vendorProfilePhoto">
					<img src="<?php echo $row['pic']; ?>" />
					

					<p class="availTab">
					
					<?php if ($row['available']==1)
						{
							echo "Available";
						}
						else echo "Unavailable"; ?>
						
					</p>
				</div>
			</div>
			<div class="col-3 vendorProfileInfo">
				<h2 class="vendorProfileName"><?php echo $row['name']; ?></h2>
				<p>Vendor Id- <span>VT98YI02<?php echo $row['svid']; ?></span> | Gender- <span><?php echo $row['gender']; ?></span></p>
				<p>Area- <span><?php 
				$query1 = $db->query("select * FROM places p INNER JOIN subareas s on p.place_code = s.place_code where s.sno = '$shownArea'");
				while($row1=$query1->fetch_assoc())
				{
				echo $row1['area']; 
				}
				?>
				
				</span></p>
				<p>SubArea- <span>
				<?php 
				
				echo $subareaName;
				
				 ?></span></p>
				<p>Deals in- <span>
				
						
						
						
						<?php
						
						
						
						$category1 = "";
						$category2 = "";
						$category3 = "";
						$category4 = "";
						
						if ($row['sabzi_category1']==1)
						{
							$category1="Lifeline Veggies";
						}
						if ($row['sabzi_category2']==1)
						{
							$category2="Green Veggies";
						}
						if ($row['sabzi_category3']==1)
						{
							$category3="Green Veggies 2";
						}
						if ($row['sabzi_category4']==1)
						{
							$category4="Chutney Items";
						}


						echo $category1." ".$category2." ".$category3." ".$category4 ;

						 ?>
						 
						 </span></p>
				<p>Timing- <span>9 AM - 7 PM</span></p>
			</div>

			<div class="col-3">
				<div class="reviewVendor">
					<p>Review this vendor</p>

					<div id="stars-default">
						<input type="hidden" name="rating" />
					</div>
				</div>
			</div>

			<div class="clear"></div>
<?php
				
					}
	 

	
	
				?>
		</div>

		<!-- NEW PAGE ENDS -->

	</section>

	<?php
	include_once("footer.php");
	?>

</div>

<!-- SIDE TUNNEL STARTS HERE -->

<div class="tunnel">
	
	<div class="tunnelPage">

		<div class="tunnel-arrow">
			<span class="icon-arrow-left"></span>
		</div>

		<div class="tunnel-row-1">

		</div>

		<div class="tunnel-row-2">

			

		</div>

	</div>

</div>

<!-- SIDE TUNNEL ENDS -->

<div class="clear"></div>	

</body>

</html>
