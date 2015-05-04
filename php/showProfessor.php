<?php
	header('Access-Control-Allow-Origin: *');
	$department = $_GET['department'];
	
	session_start();
	$_SESSION["test"] = 1;
	
	require_once("config.php");

  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}

	$qry = "SELECT * FROM Users WHERE department='$department' AND position=2";
	$result=mysqli_query($con, $qry);
	
	echo "<div class='wrapper'>
			<label class='professor'>
				<span class='bg'>
					<select name='professor' onchange='showCalendar(this.value)'>
						<option selected='0'> Select a professor</option>";
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='".$row['idUsers']."'>".$row['name']."</option>";
	}
	echo "
					</select> 
				</span>
				<span class='empty'>*Required</span>
			</label>
			</div>"
?>