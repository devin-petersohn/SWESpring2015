<?php
	
	include 'functions.php';
	$db = db_connect();
	
	$course = pg_query($db, "SELECT endtime from time_window;;");
		echo $course['apply'];
// 		while ($printedCourse = pg_fetch_row($course)) {
// 		    echo "<option value = '".$printedCourse[0]."'>".$printedCourse[0]."</option>";
// 		}
// 		echo "<\select>"



?>