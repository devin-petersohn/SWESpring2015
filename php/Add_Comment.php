<?php
require 'functions.php';

$add = $_GET['comment'];
$conn = db_connect();
if($conn) {
    $sso = $_GET['sso'];
    $course_id = $_GET['course_id'];
    $dates_taught = $_GET['dates-taught'];
    $instructor_sso = $_GET['instructor_sso'];
    
    $qry = 'INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment)
            VALUES ('.$sso.','. $course_id.','. $dates_taught.','. $instructor_sso.','. $comment.')
           ';
    $result = pg_prepare($conn, "add_comment", $qry);
    $result = pg_execute($conn, "add_comment", array());
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
}

?>