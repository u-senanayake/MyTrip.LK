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
				header('Location:../profile-page.php');
			} else {
				header('Location:../index.php');
			}
		}
	}
}
?>