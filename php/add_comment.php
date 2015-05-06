<?php
session_start();
if((include 'functions.php') != 1) { header("Location:Error"); }
$conn = db_connect();
if($conn) {
    $action = $_POST['action'];

    //echo $_POST['course_id'];
    //echo $_SESSION['username'];
    
    // $qry = '; 
    /*$qry = 'INSERT INTO applicant_comments (sso, course_id, instructor_sso, comment)
                VALUES ('.$sso.','. $course_id.','. $instructor_sso.','. $comment.')
               ';*/
    if($action == "add"){
        $sso = $_POST['sso'];
        $course_id = $_POST['course_id'];
        $dates_taught = $_POST['dates_taught'];
        $comment = $_POST['stu_comment'];
        $instructor_sso = $_SESSION['username'];
        $comment_id = time();
        
        pg_query($conn,"INSERT INTO applicant_comments (sso,course_id,dates_taught,instructor_sso,comment,comment_id) VALUES ('". $sso ."','". $course_id ."','". $dates_taught . "','". $instructor_sso ."','". $comment ."','". $comment_id ."');") or die(header("Location:Error");
       
        $arr = array(
                "success" => "1",
                "comment_id" => htmlentities($comment_id),
                "course_id" => htmlentities($course_id), 
                "instructor_sso" => htmlentities($instructor_sso),
                "comment" => htmlentities($comment)
                );
        
        echo json_encode($arr);
    }   
     
    else if($action == "delete"){
        $comment_id = $_POST['comment_id'];
        pg_query($conn, "DELETE FROM applicant_comments WHERE comment_id = ".$comment_id) or die(header("Location:Error");
        $arr = array(
                "success" => "1",
                "comment_id" => $comment_id
                );
        echo json_encode($arr);
    }
    
    else{
        $arr = array(
            "success" => "0",
            "comment_id" => "No data set"
        );
        echo json_encode($arr);
    }
}
else
{
header("Location:Error");
}
?>
