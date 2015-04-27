<?php
include 'functions.php';

$db = db_connect();

function addCourse($course_id, $section, $slots) {
    pg_prepare($db, "q1", "INSERT INTO Course (course_id, section, slots_available) VALUES ($1,$2,$3)");
    pg_execute($db, "q1", array($course_id, $section, $slots));
}

?>