#Page 1 of the application
INSERT INTO Applicant (sso) VALUES ($sso);
UPDATE Applicant SET fname = $fname, lname = $lname, gpa = $gpa WHERE sso = $sso;
INSERT INTO applicant_is_a_ugrad (sso) VALUES ($sso);

#Page 2 of the application
UPDATE Applicant SET id = $id, email = $email WHERE sso = $sso;
UPDATE applicant_is_a_ugrad SET program = $program;

#Page 3 of the application
UPDATE Applicant SET phone_number = $phone_number, expected_grad_date = $expected_grad_date;
INSERT INTO applicant_curr_taught_courses (sso, course) VALUES ($sso, $course);

#Page 4 of the application
INSERT INTO applicant_prev_taught_courses (sso, course_id, semester_taught) 
	VALUES ($sso, $course_id, $semester_taught);
INSERT INTO applicant_wish_courses (sso, course_id, grade_received) 
	VALUES ($sso, $course_id, $grade_received);
INSERT INTO applicant_other_workpalces (sso, workplace) VALUES ($sso, $workplace);

#Page 5 of the application
UPDATE Applicant SET gato_req_met = $gato_req_met WHERE sso = $sso;

#Page 6 of the application - International Students only
INSERT INTO applicant_is_international (sso, speak_test_score, speak_last_test_date, speak_req_met)
	VALUES ($sso, $speak_test_score, $speak_last_test_date, speak_req_met);

#Page 7 of the application - International Students only
UPDATE Applicant SET gato_req_met = $gato_req_met;
Update applicant_is_international SET ointa_req_met = $ointa_req_met;
