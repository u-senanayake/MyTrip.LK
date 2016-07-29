<?php
if(!isset($_SESSION[''])){
	session_start();
}
include_once('../ssi/db.php');
if(isset($_POST['login'])){
	$email = $_POST['email'];
	$pwd = $_POST['password'];
	$sql = "SELECT * FROM user WHERE email='".$email."'";
	$res = mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		while($row = mysqli_fetch_array($res)){
			$pd = $row['password'];
			$type = $row['type'];
			if($pwd == $pd){
				$_SESSION['email'] = $email;
				$_SESSION['type'] = $type;
				if($type == "guide"){
					header('Location:../guide-profile-page.php');
				} else if($type == "transport"){
					header('Location:../transport-profile-page.php');
				} else if($type == "restaurant"){
					header('Location:../restaurant-profile-page.php');
				} else if($type == "hotel"){
					header('Location:../hotel-profile-page.php');
				} else {
					header('Location:../traveller-profile-page.php');
				}
			} else {
				header('Location:../index.php');
			}
		}
	}
}
?>