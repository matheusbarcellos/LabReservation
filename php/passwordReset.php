<?php
	session_start();
	require_once("config.php");
	if (isset($_GET["Acode"])) {
		$_SESSION["Acode"] = $_GET['Acode'];
	}
	if(isset($_POST['pass'])){
    	$pass = $_POST['pass'];
		$email = $_POST['email'];
		$acode = $_SESSION["Acode"];

		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
		$query = mysqli_query($con,"select * from Users where aCode='$acode' and email='$email';")
			or die(mysqli_error($con));
 		if (mysqli_num_rows ($query)==1) 
		{
			$rand = rand();
			$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
			$startTime = $row["ADatetime"];
			$now = date('Y-m-d H:i:s');
			if ((round(abs($now - $startTime),2)/60) > 120) {
				$_SESSION['State'] = -6; // reset time expired
			} else {
				$query3="update Users set password='$pass', aCode='$rand' where aCode='$acode' and email='$email'";
				$result = mysqli_query($con, $query3) 
					or die(mysqli_error($con));
				// Log in:
				$_SESSION["Email"] = $row['Email'];
				$_SESSION['Position'] = $row["position"];
				$_SESSION['ID'] = $row['ID'];
				
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
				header("location: ../#!/Home");
			}
		} else {
			$_SESSION['State'] = -4; // Acode not match
		}
		header("location: ../#!/Home");
	} else {
		$_SESSION['State'] = -6;
		header("location: ../#!/Home");
	}

?>