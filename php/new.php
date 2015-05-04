<?php 
	session_start();
	require_once("config.php");
	error_reporting(1);
	if($_POST['submit']=='NewBuilding') {
		// Get registered info
		$name=$_POST['name'];
		$location=$_POST['location'];
		$department=$_POST['department'];
		
		// Connect to DB
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
			$_SESSION['State'] = -2; // DB error
			header("Location: ../#!/Home");
  		}
		$query = mysqli_query($con,"SELECT * from Buildings where name='$name'")
			or die(mysqli_error($con));
		$count = mysqli_num_rows($query);
		if ($count > 0)
		{	// Building already exists 
			$_SESSION['State']=-3;
			header("Location: ../#!/Home");
		}

		$query = mysqli_query($con,
			"INSERT INTO Buildings (name, location, department) values".
			"('$name','$location','$department');")
			or die(mysqli_error($con));
		
		header("Location: ../#!/Home");
		
	} else if ($_POST['submit']=='NewRoom') {
		// Get registered info
		$number=$_POST['number'];
		$idBuildings=$_POST['buildings2'];
		
		// Connect to DB
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
			$_SESSION['State'] = -2; // DB error
			header("Location: ../#!/Home");
  		}
		$query = mysqli_query($con,"SELECT * from Rooms where number='$name' AND idBuildings='$idBuildings'")
			or die(mysqli_error($con));
		$count = mysqli_num_rows($query);
		if ($count > 0)
		{	// Building already exists 
			$_SESSION['State']=-3;
			header("Location: ../#!/Home");
		}

		$query = mysqli_query($con,
			"INSERT INTO Rooms (number, idBuildings) values".
			"('$number','$idBuildings');")
			or die(mysqli_error($con));
		
		header("Location: ../#!/Home");
		
	} else if ($_POST['submit']=='NewProfessor') {
		// Get registered info
		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$department=$_POST['department'];
		$officeDays = "";
		$notAday = "1";
		//Sunday:
		if ($_POST['sun'] == "2") {
			$officeDays = $officeDays.$_POST['sun'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		//Monday:
		if ($_POST['mon'] == "2") {
			$officeDays = $officeDays.$_POST['mon'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		//Tuesday:
		if ($_POST['tue'] == "2") {
			$officeDays = $officeDays.$_POST['tue'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		//Wednesday:
		if ($_POST['wed'] == "2") {
			$officeDays = $officeDays.$_POST['wed'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		//Thursday:
		if ($_POST['thu'] == "2") {
			$officeDays = $officeDays.$_POST['thu'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		//Friday:
		if ($_POST['fri'] == "2") {
			$officeDays = $officeDays.$_POST['fri'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		//Saturday:
		if ($_POST['sat'] == "2") {
			$officeDays = $officeDays.$_POST['sat'];
		} else {
			$officeDays = $officeDays.$notAday;
		}
		$officeHoursI = $_POST['officeHoursI'];
		$officeHoursF = $_POST['officeHoursF'];
		
		// Connect to DB
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
			$_SESSION['State'] = -2; // DB error
			header("Location: ../#!/Home");
  		}
		$query = mysqli_query($con,"SELECT * from Users where email='$email'")
			or die(mysqli_error($con));
		$count = mysqli_num_rows($query);
		if ($count > 0)
		{	// Building already exists 
			$_SESSION['State']=-3;
			header("Location: ../#!/Home");
		}

		// Insert into DB but set status = 0 inactive
		$code = rand(); // Generate an activation code
		$datetime = date('Y-m-d H:i:s'); // Record registration datetime
		
		$query = mysqli_query($con,
			"INSERT INTO Users (name, email, password, rDateTime, status, aCode, aDateTime, position, department, officeDays, officeHoursI, officeHoursF) values".
			"('$name','$email','$password','$datetime',1,'$code','$datetime',2,'$department','$officeDays','$officeHoursI','$officeHoursF');")
			or die(mysqli_error($con));
		
		header("Location: ../#!/Home");
		
	}
?>