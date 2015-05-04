<?php
	session_start(); 
	require_once("config.php");
	if($_POST['submit']=='Send')
	{
		$email=$_POST['email'];
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
		$query = mysqli_query($con,"select * from Users where email='$email'")
			or die(mysqli_error($con)); 

 		if (mysqli_num_rows ($query)==1) 
 		{
			$code=rand();
			$message="Please click the following link to reset password: http://cis-linux2.temple.edu/~tuf82846/LabReservation/php/passwordReset.php?Acode=$code";
			$headers = 'From: labreservation@temple.edu' . "\r\n" .
    				'Reply-To: tuf82846@temple.edu' . "\r\n" .
    				'X-Mailer: PHP/' . phpversion();
			mail($email, "Password Reset Request", $message,$headers);
			$datetime = date('Y-m-d H:i:s');
			
			$query2 = mysqli_query($con,"update Users set aCode='$code', aDateTime='$datetime' where email='$email'")
				or die(mysqli_error($con)); 
			$_SESSION['State']=-5;
		} else {
			$_SESSION['State']=-1;
		}
		header("location: ../#!/Home");
	}
?>