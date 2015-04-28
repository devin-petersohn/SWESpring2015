<?php
require 'functions.php';
$conn = db_connect();
if($conn) {
    $sso = $_POST['sso'];
    $course_id = $_POST['course_id'];
    //$dates_taught = $_POST['dates-taught'];
    $instructor_sso = $_SESSION['username'];
    $comment = $_POST['stu_comment'];
    
    /* $qry = 'INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment)
     VALUES ('.$sso.','. $course_id.','. $dates_taught.','. $instructor_sso.','. $comment.')
    '; */
    $qry = 'INSERT INTO applicant_comments (sso, course_id, instructor_sso, comment)
                VALUES ('.$sso.','. $course_id.','. $instructor_sso.','. $comment.')
               ';
    
    pg_prepare($conn, "add_comment", $qry);
    if(pg_execute($conn, "add_comment", array())) {
        echo "Comment added.\n";
        header ('Location: swespring2015-grouph.rhcloud.com/swespring2015/comments ');
        
    }
    else {
        echo "Delete Failed <br />";
        header ('Location: swespring2015-grouph.rhcloud.com/swespring2015/comments ');
    }
}
?>