<?php
include 'insertUsers.php';
include 'functions.php';

$pw = 'test';
$username = 'ftp123';
$statement = 0;
$dbconn = db_connect();

generateRandomData($pw, $username, $statement, $dbconn);
?>