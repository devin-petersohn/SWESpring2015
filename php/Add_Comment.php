<?php
require 'functions.php';

$add = $_GET['comment'];
$conn = db_connect();
if($conn) {
    $qry = null;
    $result = pg_prepare($conn, "", $qry);
    $result = pg_execute($conn, "", array());
}
//---------------------------------------------------------Different Way
$conn = db_connect();
if($conn) {
    $action = $_GET['choice'];
    if($action == 'delete') {
        $qry = null;
        $result = pg_prepare($conn, "", $qry);
        $result = pg_execute($conn, "", array());
    }
    else if ($action == 'add') {
        $qry = null;
        $result = pg_prepare($conn, "", $qry);
        $result = pg_execute($conn, "", array());
    }
    else {
        echo "error. \n \n";
}

?>