<?php 
	session_start();
	require_once("config.php");
	error_reporting(1);
	if(isset($_GET['email']))
	{
		// Get registered info
		$email=$_GET['email'];
		$acode=$_GET['Acode'];
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
			$_SESSION['State'] = -2; // DB error
			header("Location: ../#!/Home");
  		}
		$query = mysqli_query($con,"select * from Users where email='$email' and aCode='$acode'")
			or die(mysqli_error($con)); 

 		if (mysqli_num_rows ($query)==1) 
 		{
			$datetime = date('Y-m-d H:i:s');
			$Acode = rand(); // Replace the old code
			// Activate account and update the activation time to the current time
			$query2 = mysqli_query($con,"update Users set status = 1, aDateTime='$datetime', aCode='$Acode' where email='$email'")
				or die(mysqli_error($con));
			$row = mysqli_fetch_array($con, $query);
			$_SESSION['Email']=$email;
			$_SESSION['State'] = 1; // Logged in
			header("Location: ../#!/Home");
		} else {
			$_SESSION['Email']=$email;
			$_SESSION['State'] = -2;
			header("location: ../#!/Home");
		}
	}
?>
