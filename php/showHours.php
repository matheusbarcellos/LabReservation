<?php
	header('Access-Control-Allow-Origin: *');
	$idusers2 = $_GET['idusers'];
	$dateClicked = $_GET['date'];
	
	$dateClickedDay = date('d', strtotime($dateClicked));
	
	require_once("config.php");

  	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}
	
	$qry = "SELECT * FROM Users WHERE idUsers='$idusers2'";
	$result=mysqli_query($con, $qry);
	
	$qry2 = "SELECT * FROM Reservations WHERE idProfessor='$idusers2'";
	$result2=mysqli_query($con, $qry2);
	
	$hour = array();
	$k = 0;
	while($row2 = mysqli_fetch_array($result2)) {
		$dateReserved = date('d', strtotime($row2['date']));
		if ($dateClickedDay == $dateReserved) {
			$hour[$k] = date('H', strtotime($row2['date']));
			$k++;
		}
	}
	
	echo "<div class='wrapper'>
			<label class='hour'>
				<span class='bg'>
					<select name='hour' onchange='showBuildings(".$idusers2.")'>
						<option selected='0'> Select the time</option>";
						$i = 0;
						while($row = mysqli_fetch_array($result)) {
							$officeI = $row['officeHoursI'];
							$officeF = $row['officeHoursF'];		
							while ($officeI < $officeF) {
								$officeI = $officeI + $i;
								if ($officeI == 9) {
									$displayH = "09:00 AM";
								}
								if ($officeI == 10) {
									$displayH = "10:00 AM";
								}
								if ($officeI == 11) {
									$displayH = "11:00 AM";
								}
								if ($officeI == 12) {
									$displayH = "12:00 PM";
								}
								if ($officeI == 13) {
									$displayH = "01:00 PM";
								}
								if ($officeI == 14) {
									$displayH = "02:00 PM";
								}
								if ($officeI == 15) {
									$displayH = "03:00 PM";
								}
								if ($officeI == 16) {
									$displayH = "04:00 PM";
								}
								if ($officeI == 17) {
									$displayH = "05:00 PM";
								}
								$show = true;
								for($j = 0; $j <= $k; $j++) {
									if ($hour[$j] == $officeI) {
										$show = false;
									}
								}
								if ($show) {
									echo "<option value='".$officeI."'>".$displayH."</option>";
								}
								$i = 1;
							}
						}
	echo "
					</select> 
				</span>
				<span class='empty'>*Required</span>
			</label>
		</div>";
?>