<?php
session_start();

include('dbConfig.php');

$shownArea = "";

if( $_POST && !empty($_POST) )
{
  unset($_SESSION['cat1vendor']);
  unset($_SESSION['cat2vendor']);
  unset($_SESSION['cat3vendor']);
  unset($_SESSION['cat4vendor']);

  $areaFull = explode('-', $_POST['area']);

  $areaName = $areaFull[0];
  $areaCode = $areaFull[1];

  $placeFull = explode('-', $_POST['subarea']);

  $place_code = $placeFull[0];
  $subareaName = $placeFull[1];
  $subareacode = $placeFull[2];

  $shownArea = $subareacode;
	$placeName = $areaName;

  setcookie("areaName", $areaName, time()+(86400 * 30), "/");
  setcookie("areaCode", $areaCode, time()+(86400 * 30), "/");

  setcookie("placeCode", $place_code, time()+(86400 * 30), "/");
  setcookie("subareaName", $subareaName, time()+(86400 * 30), "/");
  setcookie("subareacode", $subareacode, time()+(86400 * 30), "/");

  include_once('lang/phpFiles/autoVendor.php');
  //echo $_POST['area'].'<br>'.$_POST['subarea'];
}

else if( isset($_COOKIE["subareacode"]) )
{
  $shownArea = $_COOKIE["subareacode"];
	$place_code = $_COOKIE['placeCode'];
	$placeName = $_COOKIE['areaName'];
	$subareaName = $_COOKIE['subareaName'];
  include_once('lang/phpFiles/autoVendor.php');
}

else{
  redirect("/login.php");
}

?>
