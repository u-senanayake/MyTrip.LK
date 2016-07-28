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
	$lon = mysqli_real_escape_string($con,htmlspecialchars($_POST['lon']));
	$lat = mysqli_real_escape_string($con,htmlspecialchars($_POST['lat']));
	$transport = mysqli_real_escape_string($con,htmlspecialchars($_POST['transport']));
	$guide = mysqli_real_escape_string($con,htmlspecialchars($_POST['guide']));
	$result = mysqli_query($con,"SELECT MAX(hotel_id) as count FROM hotel");
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$restID = $row['count'];
		}
	} else {
		$restID = 'H-1';	
	}
	$value = split('H-',$restID);
	$num = $value[1] + 1;
	$hotelId = 'H-'.$num;
	$query = "INSERT INTO hotel VALUES ('".$hotelId."','".$name."','".$contact."','".$address."','".$lat."','".$lon."','".$email."','".$guide."','".$transport."')";
	if(mysqli_query($con, $query)){
		echo 'done';
	} else {
		echo mysqli_error($con);	
	}
}
?>