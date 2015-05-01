<?php
	session_start();
	include 'functions.php';

	function acceptance($choice) {
		$db = db_connect();

		$sso = $_SESSION['username'];

		pg_prepare($db, 'UPDATE applicant_offer_received SET offer_accepted = $1 WHERE sso = $2');
		pg_execute($db, "q1", array($choice, $sso));
	}
?>