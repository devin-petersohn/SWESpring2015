<?php
	
	include 'functions.php';
	$db = db_connect();
	
	$course = pg_query($db, "SELECT endtime from time_window;;");
    $time=array();
    $i=0;
		while ($printedCourse = pg_fetch_row($course)) {
		    $time[$i]=$printedCourse;
		    $i++;
		}
		echo $time[2];
// 		echo "<\select>"



?>