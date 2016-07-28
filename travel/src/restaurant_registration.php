<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
//$_SESSION['hotelCount'] = 1;
if(isset($_POST['btn'])){
	$name = mysqli_real_escape_string($con,htmlspecialchars($_POST['name']));
	$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
	$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
	$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
	$lon = mysqli_real_escape_string($con,htmlspecialchars($_POST['lon']));
	$lat = mysqli_real_escape_string($con,htmlspecialchars($_POST['lat']));
	$rcount = $_SESSION['restCount'];
	$restId = 'R-'.$rcount;
	$query = "INSERT INTO restaurant VALUES ('".$restId."','".$name."','".$contact."','".$address."','".$lat."','".$lon."','".$email."')";
	if(mysqli_query($con, $query)){
		echo 'done';
		$_SESSION['restCount']++;
	} else {
		echo mysqli_error($con);	
	}
}
?>