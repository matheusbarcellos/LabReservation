<?php 
	session_start();
	require_once("config.php");
	error_reporting(1);
	if($_POST['submit']=='Register') {
		// Get registered info
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['pwd2'];
		
		// Connect to DB
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno()) {
			$_SESSION['State'] = -2; // DB error
			header("Location: ../#!/Home");
  		}
		$query = mysqli_query($con,"SELECT * from Users where email='$email'")
			or die(mysqli_error($con));
		$count = mysqli_num_rows($query);
		if ($count > 0) {	// Email already exists 
			$_SESSION['State']=-3;
			header("Location: ../#!/Home");
		}
		
		// Insert into DB but set status = 0 inactive
		$code = rand(); // Generate an activation code
		$datetime = date('Y-m-d H:i:s'); // Record registration datetime
		
		$query = mysqli_query($con,
			"INSERT INTO Users (name, email, password, rDateTime, status, aCode, aDateTime, position) values".
			"('$name','$email','$password','$datetime',0,'$code','$datetime',1);")
			or die(mysqli_error($con));
		
		// Send email to confirm registration
		$message="Please click the following link to activate your registration:".
			"http://cis-linux2.temple.edu/~tuf82846/LabReservation/php/".
			"confirmRegistration.php?email=$email&Acode=$code";
		$headers = 'From: labreservation@temple.edu' . "\r\n" .
    			'Reply-To: tuf82846@temple.edu' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();
		mail($email, "Account Activation Confirmation", $message,$headers);
		session_unset();
		$_SESSION['State'] = -4;
		header("Location: ../#!/Home");
	}
?>