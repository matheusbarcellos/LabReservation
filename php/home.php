<?php
	header('Access-Control-Allow-Origin: *');
	
	session_start();
	require_once("config.php");
	
	if (isset($_SESSION["State"])) {
		if ($_SESSION["State"] > 0) { 
			$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
			if (!$con) { 
				die("Failed to connect to server:".mysql_error());
			}
			
			if ($_SESSION["State"] == 1) { //student
				$Email = $_SESSION["Email"];
				
				$qry = "SELECT * FROM Users WHERE email='$Email'";
				$result=mysqli_query($con, $qry);
				
				while($row = mysqli_fetch_array($result)) {
					$name = $row['name'];
					$idusers = $row['idUsers'];
				}
				
				$k=0;
				$qry = "SELECT * FROM Reservations WHERE idUsers='$idusers'";
				$result=mysqli_query($con, $qry);
				while($row = mysqli_fetch_array($result)) {
					$k++;
				}
				
				$qry = "SELECT * FROM Reservations WHERE idUsers='$idusers'";
				$result=mysqli_query($con, $qry);
				
				echo "<h4> Welcome ".$name."</h4> <br />";
				
				if ($k!=0) {
					echo "Yours appointments: <br>
					<table width='100%'> 
						<tr>
							<td> Room </td>
							<td> Professor </td>
							<td> Date </td>
							<td> Status </td>
						</tr>";
					while($row = mysqli_fetch_array($result)) {
						$idroom = $row['idRooms'];
						$idprofessor = $row['idProfessor'];
						$date = date('m/d h:i A', strtotime($row['date']));
						$confirm = $row['confirm'];
						echo "<tr>";
							echo "<td>";
								$qry2 = "SELECT * FROM Rooms WHERE idRooms='$idroom'";
								$result2=mysqli_query($con, $qry2);
								while($row2 = mysqli_fetch_array($result2)) {
									$room = $row2['number'];
								}
								echo $room;
							echo "</td>";
							echo "<td>";
								$qry2 = "SELECT * FROM Users WHERE idUsers='$idprofessor'";
								$result2=mysqli_query($con, $qry2);
								while($row2 = mysqli_fetch_array($result2)) {
									$professor = $row2['name'];
								}
								echo $professor;
							echo "</td>
								<td>".$date."</td>";
								if ($confirm == 0) { 
									echo "<td><a href='php/cancel.php?idreservations=".$row['idReservations']."'><img src='images/close_active.gif'></a>
									</td>";
								} else {
									echo "<td>Confirmed</td>";
								}
						echo "</tr>";
					}
					echo "</table>";
				} else {
					echo "You don't have appointments";
				}
			} 
			if ($_SESSION["State"] == 2) { //professor
				$Email = $_SESSION["Email"];
			
				$qry = "SELECT * FROM Users WHERE email='$Email'";
				$result=mysqli_query($con, $qry);
				
				while($row = mysqli_fetch_array($result)) {
					$name = $row['name'];
					$idprofessor = $row['idUsers'];
				}
				
				$k=0;
				$pending = 0;
				$notpending = 0;
				$qry = "SELECT * FROM Reservations WHERE idProfessor='$idprofessor'";
				$result=mysqli_query($con, $qry);
				while($row = mysqli_fetch_array($result)) {
					$k++;
					$confirm = $row['confirm'];
					if ($confirm == 0) {
						$pending = 1;
					}
					if ($confirm == 1) {
						$notpending = 1;
					}
				}
				
				$qry = "SELECT * FROM Reservations WHERE idProfessor='$idprofessor'";
				$result=mysqli_query($con, $qry);
				
				echo "<h4> Welcome Professor ".$name."</h4> <br />";
				
				if ($k!=0) {
					if ($pending == 1) {
						echo "Pending appointments: <br>
						<table width='100%'> 
							<tr>
								<td> Room </td>
								<td> Student </td>
								<td> Date </td>
								<td> Confirm </td>
							</tr>";
						while($row = mysqli_fetch_array($result)) {
							$confirm = $row['confirm'];
							if ($confirm == 0) {
								$idroom = $row['idRooms'];
								$idstudent = $row['idUsers'];
								$date = date('m/d h:i A', strtotime($row['date']));
								echo "<tr>";
									echo "<td>";
										$qry2 = "SELECT * FROM Rooms WHERE idRooms='$idroom'";
										$result2=mysqli_query($con, $qry2);
										while($row2 = mysqli_fetch_array($result2)) {
											$room = $row2['number'];
										}
										echo $room;
									echo "</td>";
									echo "<td>";
										$qry2 = "SELECT * FROM Users WHERE idUsers='$idstudent'";
										$result2=mysqli_query($con, $qry2);
										while($row2 = mysqli_fetch_array($result2)) {
											$student = $row2['name'];
										}
										echo $student;
									echo "</td>
										<td>".$date."</td>
										<td><a href='php/confirm.php?idreservations=".$row['idReservations']."'><img src='images/confirm.png' style='width: 15px'></a>
									</td>";
								echo "</tr>";
							}
						}
						echo "</table>";
					}
					if ($notpending == 1) {
						echo "Confirmed appointments: <br>
						<table width='100%'> 
							<tr>
								<td> Room </td>
								<td> Student </td>
								<td> Date </td>
							</tr>";
						while($row = mysqli_fetch_array($result)) {
							$confirm = $row['confirm'];
							if ($confirm == 1) {
								$idroom = $row['idRooms'];
								$idstudent = $row['idUsers'];
								$date = date('m/d h:i A', strtotime($row['date']));
								echo "<tr>";
									echo "<td>";
										$qry2 = "SELECT * FROM Rooms WHERE idRooms='$idroom'";
										$result2=mysqli_query($con, $qry2);
										while($row2 = mysqli_fetch_array($result2)) {
											$room = $row2['number'];
										}
										echo $room;
									echo "</td>";
									echo "<td>";
										$qry2 = "SELECT * FROM Users WHERE idUsers='$idstudent'";
										$result2=mysqli_query($con, $qry2);
										while($row2 = mysqli_fetch_array($result2)) {
											$student = $row2['name'];
										}
										echo $student;
									echo "</td>
										<td>".$date."</td>
									";
								echo "</tr>";
							}
						}
						echo "</table>";
					}
				} else {
					echo "You don't have appointments";
				}
			}
			if ($_SESSION["State"] == 3) { //faculty
			
			}
			if ($_SESSION["State"] == 4) { //Admin
				
			}
		} else {
			if ($_SESSION["State"] == -1) { //Wrong password/email
				echo "<h4> Login failed </h4> <br />
					Wrong Email or password. <br>
					Try <a href='#!/Login'>again</a>
				";
			}
			if ($_SESSION["State"] == -4) { //Confirm registration
				echo "<h4> We're almost done... </h4> <br />
					An email was sent to you with the activation link for your account.
					Please, check your email and complete the registration.
				";
			}
			if ($_SESSION["State"] == -5) { //Password Reset
				echo "<h4> We're almost done... </h4> <br />
					An email was sent to you with the to change your password.
					Please, check your email and reset your password.
				";
			}
			if ($_SESSION["State"] == -6) { //Password Reset
				echo "
					<h4> Password Reset </h4> <br />
					<form action='http://cis-linux2.temple.edu/~tuf82846/LabReservation/php/passwordReset.php' data-ajax='false' method='POST' onsubmit='return checkFormReset(this);'>
						<div class='wrapper'>
							<label class='email'>
								<span class='bg'><input type='email' name='email' placeholder='Enter email again' required /></span>
								<span class='empty'>*Required</span>
							</label>
						</div>
						<div class='wrapper'>
							<label class='password'>
								<span class='bg'><input type='password' name='pass1' placeholder='Enter New Password' required /></span>
								<span class='empty'>*Required</span>
							</label>
						</div>
						<div class='wrapper'>
							<label class='password'>
								<span class='bg'><input type='password' name='pass' placeholder='Enter New Password Again' required /></span>
								<span class='empty'>*Required</span>
							</label>
						</div>
						<br> <input type='submit' name='submit' value='Reset' /> </span>
					</form>
				";
			}
		}
	} else {
		echo "<h4> Lab Reservation App </h4> <br />
			Welcome! This APP requires that you are logged in. <br>
			Navigate through the menu or click <a href='#!/Login'>here</a>.";
	}
?>