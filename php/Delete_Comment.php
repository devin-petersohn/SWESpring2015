<?php
require 'functions.php';

$rm = $_GET('comment_id');

$conn = db_connect();
if($conn) {
    $qry = null;
    $result = pg_prepare($conn, "", $qry);
    $result = pg_execute($conn, "", array());
}


?>