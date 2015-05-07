<?php

include 'functions.php';

function deleteInstructor($sso){
	$db = db_connect();
	pg_prepare($db, "q0", "SELECT * from course") or die(header("Location:Error"));
	$SR = pg_execute($db, "q0", array()) or die(header("Location:Error"));
	while($SR2 = pg_fetch_array($SR, null, PGSQL_ASSOC))
	{
	    if(strcmp($SR2, $course_id) == 0)
	    {
	        pg_prepare($db, "q5", "DELETE FROM Faculty WHERE sso = $1") or die(header("Location:Error"));
	        pg_execute($db, "q5", array($sso)) or die(header("Location:Error"));
	        return;
	    }
	}
	
	echo "<p style='color:red;'>Error: Instructor does not exists</p>";
	return;
}

?>