<?php

include 'functions.php';

function deleteCourse($cid){
	$db = db_connect();
	pg_prepare($db, "q1", "DELETE FROM Course WHERE course_id = $1");
	pg_execute($db, "q1", array($cid));
}


?>