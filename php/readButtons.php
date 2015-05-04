<?php
	header('Access-Control-Allow-Origin: *');
	session_start();
	if (!isset($_SESSION["State"])) {
		echo "Null";
	} else {  
		echo $_SESSION["State"]." ".$_SESSION["Email"]." ".$_SESSION["Position"];
	}
?>
