<?php
include 'functions.php';

$db = db_connect();

function assignApp($sso, $course) {
    $db = db_connect();
    pg_prepare($db, "assign", "UPDATE applicant_offer_received SET assigned_to_course = TRUE WHERE sso = $1 AND course_id = $2");
    pg_execute($db, "assign", array($sso, $course));
}

?>