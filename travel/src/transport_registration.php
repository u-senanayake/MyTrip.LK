<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
//$_SESSION['transportCount'] = 1;
if(isset($_POST['btn'])){
	$name = mysqli_real_escape_string($con,htmlspecialchars($_POST['name']));
	$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
	$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
	$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
	$tcount = $_SESSION['transportCount'];
	$transportId = 'C-'.$tcount;
	$query = "INSERT INTO transport VALUES ('".$transportId."','".$name."','".$contact."','".$address."','".$email."')";
	if(mysqli_query($con, $query)){
		echo 'done';
		$_SESSION['transportCount']++;
	} else {
		echo mysqli_error($con);	
	}
}
?>