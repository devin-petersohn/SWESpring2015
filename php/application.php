<?php
	session_start();
	include 'functions.php';
	$db = db_connect();

	$sso = $_SESSION['username'];

	#$paw = $_SESSION['username']; // This is how we will get their pawprint/SSO
	#echo $paw;
	
	if( $_POST['selection'] && $_POST['fname'] && $_POST['lname'] && $_POST['gpa']){
		#pg_query($db, "INSERT INTO Applicant (sso) VALUES ('".$sso."');");
		pg_prepare($db, "q2", 'UPDATE Applicant SET fname = $1, lname = $2, gpa = $3 WHERE sso = $4;');
		pg_execute($db, "q2", array($_POST['fname'], $_POST['lname'], $_POST['gpa'], $sso));
		#pg_query($db, "UPDATE Applicant SET fname = '". $_POST['fname'] ."', lname = '". $_POST['lname'] ."', 
		#	gpa = '". $_POST['gpa'] ."' WHERE sso = '". $sso ."';");
		if($_POST['selection'] != "TA"){
			pg_prepare($db, "q3", 'INSERT INTO applicant_is_a_ugrad (sso) VALUES ($1);');
			pg_execute($db, "q3", array($sso));
		}
			#pg_query($db, "INSERT INTO applicant_is_a_ugrad (sso) VALUES ('".$sso."');");
		else {
			pg_prepare($db, "q4", 'INSERT INTO applicant_is_a_grad (sso) VALUES ($1);');
			pg_execute($db, "q4", array($sso));
		}
			#pg_query($db, "INSERT INTO applicant_is_a_grad (sso) VALUES ('".$sso."');");
		
	}

	if( $_POST['ID'] && $_POST['selectionmajor'] && $_POST['advisorname'] && $_POST['email'] && $_POST['masterphd'] && $_POST['selection']){
		pg_prepare($db, "q5", 'UPDATE Applicant SET id = $1, email = $2 WHERE sso = $3;');
		pg_execute($db, "q5", array($_POST['ID'], $_POST['email'], $sso));
		#pg_query($db, "UPDATE Applicant SET id = '". $_POST['ID']."', email = '". $_POST['email']. "' WHERE sso = '".$sso."';");
		if($_POST['selection'] != "TA"){
			pg_prepare($db, "q6", 'UPDATE applicant_is_a_ugrad SET program = $1;');
			pg_execute($db, "q6", array($_POST['selectionmajor']));
			#pg_query($db, "UPDATE applicant_is_a_ugrad SET program = '". $_POST['selectionmajor']."';");
		} else { 
			pg_prepare($db, "q7", 'UPDATE applicant_is_a_grad SET advisor_name = $1, grad_program = $2 WHERE sso = $3;');
			pg_execute($db, "q7", array($_POST['advisorname'], $_POST['masterphd']));
			#pg_query($db, "UPDATE applicant_is_a_grad SET advisor_name = '". $_POST['advisorname']."' WHERE sso = '".$sso."';");
			#pg_query($db, "UPDATE applicant_is_a_grad SET grad_program = '". $_POST['masterphd']."' WHERE sso = '".$sso."';");
		}
	}

	if($_POST['phoneNum'] && $_POST['gradDate'] && $_POST['currCourses']){
		pg_prepare($db, "q8", 'UPDATE Applicant SET phone_number = $1, expected_grad_date = $2 WHERE sso = $3');
		pg_execute($db, "q8", array($_POST['phoneNum'], $_POST['gradDate'], $sso));
		#pg_query($db, "UPDATE Applicant SET phone_number = '". $_POST['phoneNum']."',
		#	expected_grad_date = '". $_POST['gradDate']."';");
		pg_prepare($db, "q9", 'INSERT INTO applicant_curr_taught_courses (sso, course) VALUES ($1, $2)');
		pg_execute($db, "q9", array($sso, $_POST['currCourses']));
		#pg_query($db, "INSERT INTO applicant_curr_taught_courses (sso, course) 
		#	VALUES ('".$sso."', '". $_POST['currCourses'] ."');");
	}

	if( $_POST['iCnt'] && $_POST['courseLike'] && $_POST['grade'] && $_POST['precourse'] && $_POST['otherPlace']) {
		$wish_courses = $_POST['courseLike'];
		$grades = $_POST['grade'];

		pg_prepare($db, "q10", 'INSERT INTO applicant_prev_taught_course (sso, course) 
			VALUES ($1, $2);');
		pg_execute($db, "q10", array($sso, $_POST['precourse']));
		
		pg_prepare($db, "q11", 'INSERT INTO applicant_other_workplaces (sso, workplace) VALUES ($1, $2)');
		pg_execute($db, "q11", array($sso, $_POST['otherPlace']));
		//pg_query($db, "INSERT INTO applicant_other_workpalces (sso, workplace) 
		//	VALUES ('". $sso."', '". $_POST['otherPlace'] ."');");
		pg_prepare($db, "q12", 'INSERT INTO applicant_wish_course (sso, course_id, grade_received) VALUES ($1, $2, $3)');
		for($i=0;$i<$_POST['iCnt'];$i++){
			pg_execute($db, "q12", array($sso, $wish_courses[$i], $grades[$i]));
		}
	}
/*
	if( $_POST['precourse'] && $_POST['courseLike'] && $_POST['otherPlace']){
		#need to fix semester taught
		#pg_query($db, "INSERT INTO applicant_prev_taught_courses (sso, course_id, semester_taught) 
		#	VALUES ('".$sso."', '".$_POST['precourse']."', '". $_POST['precourse']."');");
		#need to fix grade received
		pg_query($db, "INSERT INTO applicant_wish_courses (sso, course_id, grade_received) 
			VALUES ('".$sso."', '". $_POST['courseLike'] ."', '". "A+" ."');");
		
	}
*/
	if( $_POST['selectiontwo']){
		if($_POST['selectiontwo'] == "rm"){
			pg_query($db, "UPDATE Applicant SET gato_req_met = TRUE WHERE sso = '".$sso."';");
		} else pg_query($db, "UPDATE Applicant SET gato_req_met = FALSE WHERE sso = '".$sso."';");
	}

	if($_POST['timetoregister'] && $_POST['selectionthree'] && $_POST['speakScore'] && $_POST['semesterLast']){
		pg_query($db, "DELETE FROM applicant_is_international WHERE sso = ". $sso.";");
		pg_query($db, "INSERT INTO applicant_is_international (sso) VALUES ('".$sso."');");
		if($_POST['selectionthree'] == "rm"){
			pg_query($db, "UPDATE applicant_is_international SET speak_test_score = '". $_POST['speakScore']."', 
				speak_last_test_date = '". $_POST['semesterLast'] ."', speak_req_met = TRUE WHERE sso = '".$sso."';");
		} else pg_query($db, "UPDATE applicant_is_international SET speak_req_met = FALSE,
		     speak_next_test_date = ".$_POST['timetoregister']." WHERE sso = '".$sso."');");
	}
	
	if($_POST['submit_date']) {
	    pg_query($db, "UPDATE applicant set submit_date = ".$_POST['submit_date']." WHERE sso = '".$sso."';");
	}

	if( $_POST['selectionfour'] && $_POST['selectionfive']){
		if($_POST['selectionfour'] == "rm"){

		}

		if($_POST['selectionfive'] == "rm"){

		}
	}
?>
