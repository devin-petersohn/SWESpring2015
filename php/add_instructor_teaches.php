<?php
if((include 'functions.php') != 1) header("Location:Error");

$db = db_connect();

function course_dropdown() {	
	$db = db_connect();
	$course = pg_query($db, "SELECT course_id FROM course WHERE slots_available > 0 ORDER BY course_id ASC;") or die(header("Location:Error"));
		echo "<select name='selectCourses' id='selection' value='selection' >";
		echo"<value='ERROR' disabled='disabled' seclected='selected'> Please select a course for the instructor to teach</option>";
		while ($printedCourse = pg_fetch_row($course)) {
		    echo "<option value = '".$printedCourse[0]."'>".$printedCourse[0]."</option>";
		}
		echo "<\select>";
}

function instructor_dropdown() {
	$db = db_connect();
	$instructor = pg_query($db, "SELECT sso FROM instructor ORDER BY sso ASC;") or die(header("Location:Error"));
		echo "<select name='selectInstructors' id='selection' value='selection' >";
		echo"<value='ERROR' disabled='disabled' seclected='selected'> Please select an instructor</option>";
		while ($printedInstructor = pg_fetch_row($instructor)) {
		    echo "<option value = '".$printedInstructor[0]."'>".$printedInstructor[0]."</option>";
		}
		echo "<\select>";
}


function add_instructor_teaches($sso, $course_id) {
    $db = db_connect();
    pg_prepare($db, "q1", "INSERT INTO instructor_teaches (instructor_sso, course_id) VALUES ($1,$2)") or die(header("Location:Error"));
    pg_execute($db, "q1", array($sso, $course_id)) or die(header("Location:Error"));
}

function test_dropdown() {
	$db = db_connect();
	$instructor = pg_query($db, "SELECT sso FROM instructor;") or die(header("Location:Error"));
		echo "<select name='selectInstructors' id='selection' value='selection' >";
		echo "<div class='btn-group'>
  			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
    			Action <span class='caret'></span>
  			</button>
  			<ul class='dropdown-menu' role='menu'>";
		while ($printedInstructor = pg_fetch_row($instructor)) {
		    echo "<li><option value = '".$printedInstructor[0]."'>".$printedInstructor[0]."</option></li>";
		}
		echo "</ul>
		</div>";
		echo "<\select>";



}

?>
