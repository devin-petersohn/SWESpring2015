<?php
include 'functions.php';

$db = db_connect();

function addCourse($course_id, $slots) {
    $db = db_connect();
    pg_prepare($db, "q1", "INSERT INTO Course (course_id, slots_available) VALUES ($1,$2)");
    pg_execute($db, "q1", array($course_id, $slots));
}

?>