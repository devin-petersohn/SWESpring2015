<?php
include 'functions.php';

$db = db_connect();

function course_dropdown() {	
	$db = db_connect();
	$course = pg_query($db, "SELECT course_id FROM course WHERE slots_available > 0;");
		echo "<select name='selectCourses' id='selection' value='selection' >";
		while ($printedCourse = pg_fetch_row($course)) {
		    echo "<option value = '".$printedCourse[0]."'>".$printedCourse[0]."</option>";
		}
		echo "<\select>";
}

function instructor_dropdown() {
	$db = db_connect();
	$instructor = pg_query($db, "SELECT sso FROM instructor;");
		echo "<select name='selectInstructors' id='selection' value='selection' >";
		while ($printedInstructor = pg_fetch_row($instructor)) {
		    echo "<option value = '".$printedInstructor[0]."'>".$printedInstructor[0]."</option>";
		}
		echo "<\select>";
}


function add_instructor_teaches($sso, $course_id) {
    $db = db_connect();
    pg_prepare($db, "q1", "INSERT INTO instructor_teaches (instructor_sso, course_id) VALUES ($1,$2)");
    pg_execute($db, "q1", array($sso, $course_id));
}

function test_dropdown() {
	$db = db_connect();
	$instructor = pg_query($db, "SELECT sso FROM instructor;");
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