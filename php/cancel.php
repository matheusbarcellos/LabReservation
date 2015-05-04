<?php
	session_start();
	require_once("config.php");
	
	$idreservations = $_GET['idreservations'];
	
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}
	
	$qry = "DELETE FROM Reservations WHERE idReservations='$idreservations'";
	$result=mysqli_query($con, $qry);
	
	header("location: ../#!/Home");
?>	