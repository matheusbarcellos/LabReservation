<?php
	session_start();
	require_once("config.php");

  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}
	
	$Email = $_POST["Email"];
	$Paswd = $_POST["Password"];
    $qry = "SELECT * FROM Users WHERE email='$Email' AND password='$Paswd'";
    $result=mysqli_query($con, $qry);
	$_SESSION['State'] = 0;  //Not logged in yet or logged out
	
    if ($result) {   
		if (mysqli_num_rows($result) == 1) { //Login Successful
            session_regenerate_id();
            $dataset = mysqli_fetch_assoc($result);
			
			$_SESSION["Email"] = $dataset["email"];
			$_SESSION['Position'] = $dataset["position"];
			$_SESSION['ID'] = $dataset["idUsers"];
			
			if ($_SESSION['Position'] == 2) { //Professor
				$_SESSION['State'] = 2;
			} else {
				if ($_SESSION['Position'] == 3) { //Faculty
					$_SESSION['State'] = 3;
				} else {
					if ($_SESSION['Position'] == 4) { //Admins
						$_SESSION['State'] = 4;
					} else {
						$_SESSION['State'] = 1; //Student
					}
				}
			}
			
			// Create random number
			$rand = rand();
			$datetime = date('Y-m-d H:i:s');
			$qry2="UPDATE Users SET aCode='$rand', aDateTime='$datetime' where email='$Email'";
			$result=mysqli_query($con, $qry2);
            session_write_close();
			
            header("location: ../#!/Home");
	    } else {        //Login failed
			$_SESSION['State'] = -1;
			header("location: ../#!/Home");
		}  
	} else {
		$_SESSION['State'] = -2;
		header("location: ../#!/Home");
		exit();
	}
?>