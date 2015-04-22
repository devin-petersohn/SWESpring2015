<?php
require 'functions.php';
$conn = db_connect();
if($conn) {
    $standing = $_POST['selection'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gpa = $_POST['gpa'];
    $stu_ID = $_POST['stu_ID'];
    $major = $_POST['selectionmajor'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNum'];
    $grad_date = $_POST['gradDate'];
    $curr_teach = $_POST['currCourses'];
    $prev_taught = $_POST['precourse'];
    $course_wanted = $_POST['courseLike'];
    $other_work = $_POST['otherPlace'];
    $GATO = $_POST['selectiontwo'];
    $international_stat = $_POST['selectionifinternational'];
    $SPEAK_reg = $_POST['selectionthree'];
    $SPEAK_score = $_POST['sub1'];
    $SPEAK_semester = $_POST['sub2'];
    $SPEAK_time = $_POST['sub3'];
    
    $query = null;
    $result = pg_prepare($conn,'Save_App',$query);
    $result = pg_query($conn,$query);
    if($result) {
        echo $result . '\n';
    }
    
}


?>