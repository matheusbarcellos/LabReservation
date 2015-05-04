<?php 
	session_start();
	require_once("config.php");
	error_reporting(1);
	if($_POST['submit']=='Make it!')
	{
		// Get registered info
		$email = $_SESSION["Email"];
		$idStudent = $_SESSION['ID'];
		$idRoom = $_POST['room'];
		$idProfessor = $_POST['professor']; 
		$date = $_POST['dateClicked']." ".$_POST['hour'].":00:00";

		// Connect to DB
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
		// Check connection
		if (mysqli_connect_errno())
  		{
			$_SESSION['State'] = -2; // DB error
			header("Location: ../#!");
  		}		
		
		$query = mysqli_query($con,
			"INSERT INTO Reservations (idUsers, idRooms, idProfessor, date) values".
			"('$idStudent','$idRoom','$idProfessor','$date');")
			or die(mysqli_error($con));
		
		$qry = "SELECT * FROM Users WHERE idUsers='$idProfessor'";
		$result=mysqli_query($con, $qry);
		while($row = mysqli_fetch_array($result)) {
			$professorName = $row['name'];
		}
		
		$qry = "SELECT * FROM Rooms WHERE idRooms='$idRoom'";
		$result=mysqli_query($con, $qry);
		while($row = mysqli_fetch_array($result)) {
			$idBuilding = $row['idBuildings'];
			$numberRoom = $row['number'];
		}
		
		$qry = "SELECT * FROM Buildings WHERE idBuildings='$idBuilding'";
		$result=mysqli_query($con, $qry);
		while($row = mysqli_fetch_array($result)) {
			$nameBuilding = $row['name'];
			$location = $row['location'];
		}
		
		// Send email to confirm registration
		$message="You have made an appointment through Lab Reservation App. Details:
			Date: $dateFinal
			Professor's name: $professorName
			Building: $nameBuilding
			Room: $numberRoom
			Location: http://maps.google.com/?q=$location";
			
		$headers = 'From: labreservation@temple.edu' . "\r\n" .
    			'Reply-To: tuf82846@temple.edu' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();
		mail($email, "Appointment Confirmation", $message,$headers);
		header("location: ../#!/Home");
	}
?>