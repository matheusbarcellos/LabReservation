<?php
	header('Access-Control-Allow-Origin: *');
	$idBuildings = $_GET['idBuildings'];
	
	session_start();
	
	require_once("config.php");

  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}

	$qry = "SELECT * FROM Rooms WHERE idBuildings='$idBuildings'";
	$result=mysqli_query($con, $qry);
	
	echo "<div class='wrapper'>
			<label class='room'>
				<span class='bg'>
					<select name='room' onchange='showSubmit()'>
						<option selected='0'>Select a Room</option>";
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='".$row['idRooms']."'>".$row['number']."</option>";
	}
	echo "
					</select> 
				</span>
				<span class='empty'>*Required</span>
			</label>
			</div>"	
?>