<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
//$_SESSION['guideCount'] = 1;
if(isset($_POST['btn'])){
	$nic = mysqli_real_escape_string($con,htmlspecialchars($_POST['nic']));
	$fname = mysqli_real_escape_string($con,htmlspecialchars($_POST['fname']));
	$lname = mysqli_real_escape_string($con,htmlspecialchars($_POST['lname']));
	$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
	$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
	$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
	$gcount = $_SESSION['guideCount'];
	$guideId = 'G-'.$gcount;
	$query = "INSERT INTO guide VALUES ('".$guideId."','".$nic."','".$fname."','".$lname."','".$email."','".$contact."','".$address."')";
	if(mysqli_query($con, $query)){
		echo 'done';
		$_SESSION['guideCount']++;
	} else {
		echo mysqli_error($con);	
	}
}
?>