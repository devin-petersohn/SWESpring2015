<?php

session_start();
include 'functions.php';
$db = db_connect();

$sso = $_SESSION['username'];


pg_prepare($db, "q1", "INSERT INTO Instructor (sso, fname, lname) VALUES ($1,$2,$3)");
pg_execute($db, "q1", array($_POST['instructor_sso'], $_POST['instructor_fname'], $_POST['instructor_lname']));

?>