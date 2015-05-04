<?php
	header('Access-Control-Allow-Origin: *');
	
	session_start();
	
	require_once("config.php");

  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}

	$qry = "SELECT * FROM Buildings";
	$result=mysqli_query($con, $qry);
	
	echo "<div class='wrapper'>
			<label class='buildings2'>
				<span class='bg'>
					<select name='buildings2'>
						<option selected='0'>Select a building</option>";
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='".$row['idBuildings']."'>".$row['name']."</option>";
	}
	echo "
					</select> 
				</span>
				<span class='empty'>*Required</span>
			</label>
			</div>"	
?>