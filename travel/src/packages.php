<?php
if(!isset($_SESSION[''])){
	session_start();
}
if(isset($_POST['submit'])){
	$budget = $_POST['budget'];
	$type = $_POST['type'];
	$d1 = $_POST['d1'];
	$d2 = $_POST['d2'];
	echo $budget. " " . $type." " .$d1." " .$d2;
}
?>