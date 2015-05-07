<?php
include 'insertUsers.php';
include 'functions.php';

$pw = 'test';
$username = 'zzff8';
$statement = 0;
$dbconn = db_connect();

generateRandomData($pw, $username, $statement, $dbconn);
?>