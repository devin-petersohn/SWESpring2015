<?php
	session_start();
	if((include 'functions.php') != 1) header("Location:Error");

	function acceptance($choice) {
		$db = db_connect();

		$sso = $_SESSION['username'];

		pg_prepare($db, 'UPDATE applicant_offer_received SET assigned_to_course = $1 WHERE sso = $2') or die(header("Location:Error"));
		pg_execute($db, "q1", array($choice, $sso)) or die(header("Location:Error"));
	}
?>
