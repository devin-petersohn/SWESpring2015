<?php
	
	include 'functions.php';
	$db = db_connect();

	$course = pg_query($db, "SELECT course_id FROM course WHERE slots_available > 0;");
		echo "<select name='selectCourses' id='selection' value='selection' >";
		foreach ($course as $printedCourse) {
			echo "<option value = '$printedCourse'>$printedCourse</option>";
		}
		echo "<\select>"



?>