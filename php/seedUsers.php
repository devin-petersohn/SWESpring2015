<?php
include 'insertUsers.php';
include 'functions.php';

$pw = 'test';
$username = 'schyulerj';
$statement = 1;
$dbconn = db_connect();

generateRandomData($pw, $username, $statement, $dbconn);
?>