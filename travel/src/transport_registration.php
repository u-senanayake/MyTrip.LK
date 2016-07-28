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
	if(mysqli_query($con, $query)){
		echo 'done';
	} else {
		echo mysqli_error($con);	
	}
}
?>