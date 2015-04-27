<?php
	
	include 'functions.php';
	$db = db_connect();
	
	$course = pg_query($db, "SELECT course_id FROM course WHERE slots_available > 0;");
		echo "<select name='selectCourses' id='selection' value='selection' >";
		while ($printedCourse = pg_fetch_row($course)) {
		    echo "<option value = '".$i."'>".$printedCourse[0]."</option>";
		}
		echo "<\select>"



?>