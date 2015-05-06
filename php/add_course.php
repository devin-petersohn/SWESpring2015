<?php
if((include 'php/functions.php' != 1)) header("Location:error");

$db = db_connect();

function addCourse($course_id, $slots) {
    $db = db_connect();
    pg_prepare($db, "q1", "INSERT INTO Course (course_id, slots_available) VALUES ($1,$2)") or die(header("Location:Error"));
    pg_execute($db, "q1", array($course_id, $slots)) or die(header("Location:Error"));
}

?>
