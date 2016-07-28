<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
if(isset($_POST['btn'])){
	$nic = mysqli_real_escape_string($con,htmlspecialchars($_POST['nic']));
	$fname = mysqli_real_escape_string($con,htmlspecialchars($_POST['fname']));
	$lname = mysqli_real_escape_string($con,htmlspecialchars($_POST['lname']));
	$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
	$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
	$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
	$result = mysqli_query($con,"SELECT MAX(guide_id) as count FROM guide");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$restID = $row['count'];
		}
	} else {
		$restID = 'G-1';	
	}
	$value = split('G-',$restID);
	$num = $value[1] + 1;
	$guideId = 'G-'.$num;
	$query = "INSERT INTO guide VALUES ('".$guideId."','".$nic."','".$fname."','".$lname."','".$email."','".$contact."','".$address."')";
	if(mysqli_query($con, $query)){
		echo 'done';
	} else {
		echo mysqli_error($con);	
	}
}
?>