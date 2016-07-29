<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
if(isset($_POST['btn'])){
	$fname = mysqli_real_escape_string($con,htmlspecialchars($_POST['fname']));
	$lname = mysqli_real_escape_string($con,htmlspecialchars($_POST['lname']));
	$nic = mysqli_real_escape_string($con,htmlspecialchars($_POST['nic']));
	$country = mysqli_real_escape_string($con,htmlspecialchars($_POST['country']));
	$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
	$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
	$pwd = mysqli_real_escape_string($con,htmlspecialchars($_POST['password']));
	$result = mysqli_query($con,"SELECT MAX(traveller_id) as count FROM traveller");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$restID = $row['count'];
		}
	}
	$value = split('T-',$restID);
	$num = $value[1] + 1;
	$travellerId = 'T-'.$num;
	$query = "INSERT INTO traveller VALUES ('".$nic."','".$fname."','".$lname."','".$country."','".$email."','".$contact."','".$travellerId."')";
	$query2 = "INSERT INTO user VALUES ('".$email."','".$pwd."','traveller')";
	if(mysqli_query($con, $query) && mysqli_query($con, $query2)){
		header('Location:../profile-page.php');
	} else {
		echo mysqli_error($con);	
	}
}
?>