<!-- Change/Select Vendor  -->
<?php	
session_start();
	include_once('dbConfig.php');

	if( isset($_GET['cat']) )
		$cat = $_GET['cat'];

	else if( isset($_GET['name']) )
	{
		$name = $_GET['name'];
		$sq = $db->query("SELECT * FROM sabziz WHERE sabzi_name='$name'");
		$sr = $sq->fetch_assoc();
		$cat = $sr['sabzi_category'];
	}

	$shownArea = $_COOKIE["subareacode"];

	$query = $db->query("SELECT * FROM subareas WHERE sno = '$shownArea'");

 	$rowCount = $query->num_rows;

 	if( $rowCount > 0 )
 	{
 		$row = $query->fetch_assoc();	 	
		$place_c = $row['place_code'];
	}
	

	$retCat = "";
	$sesCat = "";

	if($cat == 1){
		$retCat = "sabzi_category1";
		$sesCat = "cat1vendor";
	}
	else if($cat == 2){
		$retCat = "sabzi_category2";
		$sesCat = "cat2vendor";
	}
	else if($cat == 3){
		$retCat = "sabzi_category3";
		$sesCat = "cat3vendor";
	}
	else if($cat == 4){
		$retCat = "sabzi_category4";
		$sesCat = "cat4vendor";
	}

?>

<div class="changeVendorDiv" id="changeVendorDiv">
	<p>Select a vendor from your area</p>

	<?php
		$vquery = $db->query("SELECT * FROM sabzi_wala WHERE place_code = '$place_c' AND `$retCat` = 1");
		$vrowCount = $vquery->num_rows;

		if( $vrowCount > 0 )
		{
			while( $vrow = $vquery->fetch_assoc() )
			{
				?>
				<div class="leave10 click2changeVendor" data-vendid="<?php echo $vrow['svid']; ?>" data-category="<?php echo $_GET['cat']; ?>">
					<div class="selectedVendorPic left" title="Change Vendor">
						<img src="<?php echo $vrow['pic']; ?>" />
					</div>

					<div class="selectedVendorInfo left">
						<div class="selectedVendorName">
							<span class="mls"><?php echo $vrow['name']; ?> - [id: <?php echo $vrow['svid']; ?>]</span>
						</div>
						<div class="selectedVendorClick availableGreen">
							<span class="mls">Available</span>
						</div>
					</div>

					<div class="selectTick right <?php if(isset($_SESSION[$sesCat])){ if( $vrow['svid']==$_SESSION[$sesCat] ) echo "selected"; } ?>" title="Selected">
						<span class="icon-check-alt"></span>
					</div>

					<div class="clear"></div>
				</div>
				<?php
			}
		}

	?>
	

	
</div>
<!-- Change/Select Vendor Ends -->