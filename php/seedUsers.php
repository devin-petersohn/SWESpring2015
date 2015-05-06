<?php
include 'insertUsers.php';
include 'functions.php';

$pw = 'test';
$username = 'mmhkw9';
$statement = 0;
$dbconn = db_connect();

generateRandomData($pw, $username, $statement, $dbconn);
?>