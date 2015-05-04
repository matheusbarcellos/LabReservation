<?php
	header('Access-Control-Allow-Origin: *');
	$professor = $_GET['professor'];
	
	session_start();
	
	require_once("config.php");

  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}

	$qry = "SELECT * FROM Reservations WHERE idProfessor='$professor'";
	$result=mysqli_query($con, $qry);
	
	$qry2 = "SELECT * FROM Users WHERE idUsers='$professor'";
	$result2=mysqli_query($con, $qry2);
	
	while($row = mysqli_fetch_array($result2)) {
		$department = $row['department'];
	}

	$qry3 = "SELECT * FROM Buildings WHERE department='$department'";
	$result3=mysqli_query($con, $qry3);
	
	echo "<div class='wrapper'>
			<label class='buildings'>
				<span class='bg'>
					<select name='buildings' onchange='showRoom(this.value)'>
						<option selected='0'>Select a building</option>";
	while($row2 = mysqli_fetch_array($result3)) {
		echo "<option value='".$row2['idBuildings']."'>".$row2['name']."</option>";
	}
	echo "
					</select> 
				</span>
				<span class='empty'>*Required</span>
			</label>
			</div>"	
?>