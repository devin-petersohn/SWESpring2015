<?php
require 'functions.php';
$conn = db_connect();
if($conn) {
    $sso = $_POST['sso'];
    $course_id = $_POST['course_id'];
    $dates_taught = $_POST['dates-taught'];
    $instructor_sso = $_SESSION['username'];
    $comment = $_POST['stu_comment'];
    
     $qry = 'INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment)
     VALUES ('.$sso.','. $course_id.','. $dates_taught.','. $instructor_sso.','. $comment.')
    '; 
    /*$qry = 'INSERT INTO applicant_comments (sso, course_id, instructor_sso, comment)
                VALUES ('.$sso.','. $course_id.','. $instructor_sso.','. $comment.')
               ';*/
    
    pg_prepare($conn, "add_comment", $qry);
    
    echo json_encode(
        array(
            "success" => "1",
            "course_id" => htmlentities($course_id), 
            "instructor_sso" => htmlentities($instructor_sso),
            "comment" => htmlentities($comment)
        )
    );
    
}
?>