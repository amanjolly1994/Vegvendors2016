<?php
	
	include_once("dbConfig.php");

	$shownareacode = $_COOKIE["subareacode"];

	$query = $db->query("SELECT * FROM subareas WHERE sno = '$shownareacode'");

 	$rowCount = $query->num_rows;

 	if( $rowCount > 0 )
 	{
 		$row = $query->fetch_assoc();	 	
		$place_c = $row['place_code'];
	}

	if( !isset($_SESSION['cat1vendor']) )
	{
		$aquery = $db->query("SELECT * FROM sabzi_wala WHERE place_code = '$place_c' AND sabzi_category1 = 1 LIMIT 1");

		$arow = $aquery->fetch_assoc();
		$_SESSION['cat1vendor'] = $arow['svid'];	

		
		// echo $_SESSION['cat1vendor'];	
	}

	if( !isset($_SESSION['cat2vendor']) )
	{
		$aquery = $db->query("SELECT * FROM sabzi_wala WHERE place_code = '$place_c' AND sabzi_category2 = 1 LIMIT 1");

		$arow = $aquery->fetch_assoc();
		$_SESSION['cat2vendor'] = $arow['svid'];		
		// echo $_SESSION['cat2vendor'];
	}

	if( !isset($_SESSION['cat3vendor']) )
	{
		$aquery = $db->query("SELECT * FROM sabzi_wala WHERE place_code = '$place_c' AND sabzi_category3 = 1 LIMIT 1");

		$arow = $aquery->fetch_assoc();
		$_SESSION['cat3vendor'] = $arow['svid'];		
		// echo $_SESSION['cat3vendor'];
	}

	if( !isset($_SESSION['cat4vendor']) )
	{
		$aquery = $db->query("SELECT * FROM sabzi_wala WHERE place_code = '$place_c' AND sabzi_category4 = 1 LIMIT 1");

		$arow = $aquery->fetch_assoc();
		$_SESSION['cat4vendor'] = $arow['svid'];
		// echo $_SESSION['cat4vendor'];
	}

?>