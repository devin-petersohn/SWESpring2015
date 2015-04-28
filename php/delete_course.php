<?php

include 'functions.php';

function deleteCourse($courseID, $section){
	$db = db_connect();
	pg_prepare($db, "q1", "DELETE FROM Course WHERE course_id = $1 AND section= $2");
	pg_execute($db, "q1", array($courseID, $section));
}


?>