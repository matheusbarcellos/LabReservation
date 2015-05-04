<?php
	header('Access-Control-Allow-Origin: *');
	$professor = $_GET['professor'];
	
	require_once("config.php");
	
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$con) { 
		die("Failed to connect to server:".mysql_error());
	}
	
	$qry = "SELECT * FROM Users WHERE idUsers='$professor'";
	$result=mysqli_query($con, $qry);
	
	$qry2 = "SELECT * FROM Reservations WHERE idProfessor='$professor'";
	$result2=mysqli_query($con, $qry2);
	
	while($row = mysqli_fetch_array($result)) {
		$days = $row['officeDays'];
		$officeHoursI = $row['officeHoursI'];
		$officeHoursF = $row['officeHoursF'];
	}
	
	//1 - no 2 - yes
	$sat = $days % 10;
	$days = $days / 10;
	$fri = $days % 10;
	$days = $days / 10;
	$thu = $days % 10;
	$days = $days / 10;
	$wed = $days % 10;
	$days = $days / 10;
	$tue = $days % 10;
	$days = $days / 10;
	$mon = $days % 10;
	$days = $days / 10;
	$sun = $days % 10;
	
	$datesReserved = array();
	$k = 0;
	while($row2 = mysqli_fetch_array($result2)) {
		$datesReserved[$k] = date('Y-m-d', strtotime($row2['date']));
		$k++;
	}
	
	if (!empty($_REQUEST['year']) && !empty($_REQUEST['month'])) {
		$day = date("d");
		$year = intval($_REQUEST['year']);
		$month = intval($_REQUEST['month']);
		$lastday = intval(strftime('%d', mktime(0, 0, 0, ($month == 12 ? 1 : $month + 1), 0, ($month == 12 ? $year + 1 : $year))));
		$dates = array();
		
		$test = date("m");
		if ($test == $month) {
			$test2 = $day + 1;
		} else {
			$test2 = 1;
		}
		
		for ($i = $test2; $i <= $lastday; $i++) {
			$date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
			$fullday = false;
			$reservation = 0;
			for($j = 0; $j <= $k; $j++) {
				if ($datesReserved[$j] == $date) {
					$reservation++;
				}
			}
			if ($reservation == ($officeHoursF - $officeHoursI + 1)) {
				$fullday = true;
				
			}
			$dw = date('w', strtotime($date));
			if (($dw == 0) && ($sun ==2) && (!$fullday)) {
				$dates[$i] = array(
					'date' => $date,
					'title' => 'Available Day',
				);
			} else {
				if (($dw == 1) && ($mon ==2) && (!$fullday)) {
					$dates[$i] = array(
						'date' => $date,
						'title' => 'Available Day',
					);
				}
				if (($dw == 2) && ($tue ==2) && (!$fullday)) {
					$dates[$i] = array(
						'date' => $date,
						'title' => 'Available Day',
					);
				}
				if (($dw == 3) && ($wed ==2) && (!$fullday)) {
					$dates[$i] = array(
						'date' => $date,
						'title' => 'Available Day',
					);
				}
				if (($dw == 4) && ($thu ==2) && (!$fullday)) {
					$dates[$i] = array(
						'date' => $date,
						'title' => 'Available Day',
					);
				}
				if (($dw == 5) && ($fri ==2) && (!$fullday)) {
					$dates[$i] = array(
						'date' => $date,
						'title' => 'Available Day',
					);
				}
				if (($dw == 6) && ($sat ==2) && (!$fullday)) {
					$dates[$i] = array(
						'date' => $date,
						'title' => 'Available Day',
					);
				}
			}
		}
		echo json_encode($dates);
	} else {
		echo json_encode(array());
	}
	
?>