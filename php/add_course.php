<?php

$var = (include 'functions.php');
if($var != 'OK') header("Location:Error");
$db = db_connect();

function addCourse($course_id, $slots) {
    pg_prepare($db, "q0", "SELECT * from course");
    $SR = pg_execute($db, "q0", array());
    while($SR2 = pg_fetch_array($SR, null, PGSQL_ASSOC))
    {
        if(strcmp($SR2, $course_id) == 0)
        {
            echo "<p style='color:red;'>Error: Course already exists</p>";
            return;
        }
    }
    $db = db_connect();
    pg_prepare($db, "q1", "INSERT INTO Course (course_id, slots_available) VALUES ($1,$2)") or die(header("Location:Error"));
    pg_execute($db, "q1", array($course_id, $slots)) or die(header("Location:Error"));
}

?>
