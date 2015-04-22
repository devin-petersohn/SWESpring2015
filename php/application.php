<?php
	
	include 'functions.php';
	$db = db_connect();

	$sso = "dpvx8";


	if( $_POST['selection'] && $_POST['name'] && $_POST['gpa']){
		$temp = pg_query($db, "INSERT INTO Applicant (sso) VALUES ('".$sso."');");
		pg_query($db, "UPDATE Applicant SET fname = '". $_POST['name'] ."', lname = '". $_POST['name'] ."', 
			gpa = '". $_POST['gpa'] ."' WHERE sso = '". $sso ."';");
		if($_POST['selection'] == "TA")
			pg_query($db, "INSERT INTO applicant_is_a_ugrad (sso) VALUES (".$sso.");");
		else pg_query($db, "INSERT INTO applicant_is_a_grad (sso) VALUES (".$sso.");");
		
		return $temp;
	}

	if( $_POST['ID'] && $_POST['selectionmajor'] && $_POST['email']){
		pg_query($db, "UPDATE Applicant SET id = ". $_POST['ID'].", email = ". $_POST['email']. "WHERE sso = ".$sso.";");
		pg_query($db, "UPDATE applicant_is_a_ugrad SET program = ". $_POST['selectionmajor'].";");
	}

	if( $_POST['phoneNum'] && $_POST['gradDate'] && $_POST['currCourses']){
		pg_query($db, "UPDATE Applicant SET phone_number = ". $_POST['phoneNum'].",
			expected_grad_date = ". $_POST['gradDate'].";");
		pg_query($db, "INSERT INTO applicant_curr_taught_courses (sso, course) 
			VALUES (".$sso.", ". $_POST['currCourses'] .");");
	}

	if( $_POST['precourse'] && $_POST['courseLike'] && $_POST['otherPlace']){
		#need to fix semester taught
		pg_query($db, "INSERT INTO applicant_prev_taught_courses (sso, course_id, semester_taught) 
			VALUES (".$sso.", ".$_POST['precourse'].", ". $_POST['precourse'].");");
		#need to fix grade received
		pg_query($db, "INSERT INTO applicant_wish_courses (sso, course_id, grade_received) 
			VALUES (".$sso.", ". $_POST['courseLike'] .", ". "A+" . ");");
		pg_query($db, "INSERT INTO applicant_other_workpalces (sso, workplace) 
			VALUES (". $sso.", ". $_POST['otherPlace'] .");");
	}

	if( $_POST['selectiontwo']){
		if($_POST['selectiontwo'] == "rm"){
			pg_query($db, "UPDATE Applicant SET gato_req_met = TRUE WHERE sso = ".$sso.";");
		} else pg_query($db, "UPDATE Applicant SET gato_req_met = FALSE WHERE sso = ".$sso.";");
	}

	if( $_POST['selectionifinternational'] && $_POST['selectionthree'] && $_POST['speakScore'] && $_POST['semesterLast']){
		if($_POST['selectionifinternational'] == "yes"){
			pg_query($db, "INSERT INTO applicant_is_international (sso) VALUES (".$sso.");");
			if($_POST['selectionthree'] == "rm"){
				pg_query($db, "UPDATE applicant_is_international SET speak_test_score = ". $_POST['speakScore'].", 
					speak_last_test_date = ". $_POST['semesterLast'] .", speak_req_met = TRUE WHERE sso = ".$sso.";");
			} else pg_query($db, "UPDATE applicant_is_international SET speak_req_met = FALSE,
			#need to input date of next test when variable is created in the form
				************ WHERE sso = ".$sso.");");
		}
	}

	if( $_POST['selectionfour'] && $_POST['selectionfive']){
		if($_POST['selectionfour'] == "rm"){

		}

		if($_POST['selectionfive'] == "rm"){

		}
	}
?>