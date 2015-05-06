<?php

if((include 'functions.php') != 1) header("Location:Error");
$db = db_connect();

function addInstructor($sso, $fname, $lname){
	$db = db_connect();
	pg_prepare($db, "q4", "INSERT INTO Instructor (sso, fname, lname) VALUES ($1,$2,$3)") or die(header("Location:Error"));
	pg_execute($db, "q4", array($sso, $fname, $lname)) or die(header("Location:Error"));
}

?>
