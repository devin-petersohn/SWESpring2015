<?php
	
	include 'functions.php';
	$db = db_connect();
	
	$course = pg_query($db, "SELECT course_id FROM course WHERE slots_available > 0;");
		echo "<select name='selectCourses' id='courseLike'".$_POST['iCnt']." value='selection' >";
		while ($printedCourse = pg_fetch_row($course)) {
		    echo "<option value = '".$printedCourse[0]."'>".$printedCourse[0]."</option>";
		}
		echo "<\select>"



?>