<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
if(isset($_POST['btn'])){
	$name = mysqli_real_escape_string($con,htmlspecialchars($_POST['name']));
	$email = mysqli_real_escape_string($con,htmlspecialchars($_POST['email']));
	$address = mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
	$contact = mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
	$pwd = mysqli_real_escape_string($con,htmlspecialchars($_POST['password']));
	$result = mysqli_query($con,"SELECT MAX(transport_id) as count FROM transport");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$restID = $row['count'];
		}
	} else {
		$restID = 'C-1';	
	}
	$value = split('C-',$restID);
	$num = $value[1] + 1;
	$transportId = 'C-'.$num;
	$query = "INSERT INTO transport VALUES ('".$transportId."','".$name."','".$contact."','".$address."','".$email."')";
	$query2 = "INSERT INTO user VALUES ('".$email."','".$pwd."','transport')";
	if(mysqli_query($con, $query) && mysqli_query($con, $query2)){
		header('Location:../profile-page.php');
	} else {
		echo mysqli_error($con);	
	}
}
?>