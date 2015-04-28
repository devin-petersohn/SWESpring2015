<?php

include 'functions.php';
$db = db_connect();

function addInstructor($sso, $fname, $lname){
	$db = db_connect();
	pg_prepare($db, "q1", "INSERT INTO Instructor (sso, fname, lname) VALUES ($1,$2,$3)");
	pg_execute($db, "q1", array($sso, $fname, $lname));
}

?>