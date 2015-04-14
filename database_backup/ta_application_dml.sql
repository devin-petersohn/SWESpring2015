CREATE OR REPLACE FUNCTION insert_into_faculty()
	RETURNS trigger AS
$BODY$
BEGIN
	INSERT INTO users(sso,domain) VALUES(NEW.sso, 'missouri.edu');
	INSERT INTO faculty(sso) VALUES(NEW.sso);
	RETURN NEW;
END;
$BODY$

CREATE OR REPLACE FUNCTION insert_into_users()
	RETURNS trigger AS
$BODY$
BEGIN
	INSERT INTO users(sso,domain) VALUES(NEW.sso, 'mail.missouri.edu');
	RETURN NEW;
END;
$BODY$

CREATE TRIGGER instructor_faculty BEFORE INSERT ON Instructor 
	FOR EACH ROW EXECUTE PROCEDURE insert_into_faculty;
CREATE TRIGGER sys_admin_faculty BEFORE INSERT ON Sys_Admin 
	FOR EACH ROW EXECUTE PROCEDURE insert_into_faculty;
CREATE TRIGGER admin_faculty BEFORE INSERT ON Admin 
	FOR EACH ROW EXECUTE PROCEDURE insert_into_faculty;
CREATE TRIGGER applicant_user BEFORE INSERT ON Applicant 
	FOR EACH ROW EXECUTE PROCEDURE insert_into_faculty;

INSERT INTO Instructor (sso) VALUES ($sso);
INSERT INTO Sys_Admin (sso) VALUES ($sso);
INSERT INTO Admin (sso) VALUES ($sso);
INSERT INTO Applicant(sso) VALUES ($sso);

INSERT INTO Course(course_id, section, slots_available) 
	VALUES ($course_id, $section, $slots_available);
INSERT INTO instructor_teaches (instructor_sso, course_id, section) 
	VALUES ($instructor_sso, $course_id, $section)

#Initial creation of time windows.  After this, they should only be updated
INSERT INTO Time_window(windowName, startTime, endTime) 
	VALUES ($windowName, $startTime, $endTime);
#Updating time windows
UPDATE Time_window SET startTime = $startTime, endTime = $endTime WHERE windowName = $windowName;

#Page 1 of the application
UPDATE Applicant SET fname = $fname, lname = $lname, phone_number = $phone_number, 
	email = $email WHERE sso = $sso;

#Page 2 of the application
UPDATE Applicant SET expected_grad_date = $expected_grad_date, gpa = $gpa WHERE sso = $sso;
#Choose one of the next 2 based on application input
INSERT INTO applicant_is_a_ugrad (sso, program, class) 
	VALUES($sso, $program, $class);
#INSERT INTO applicant_is_a_grad (sso, grad_program, advisor_name) VALUES ($sso, $grad_program, $advisor_name);

#Page 3 of the application only if applicant is international
INSERT INTO applicant_is_international (sso, speak_test_score, speak_last_test_date, speak_req_met, speak_next_test_date, ointa_req_met)
	VALUES ($sso, $speak_test_score, $speak_last_test_date, $speak_req_met, $speak_next_test_date, $ointa_req_met);

#Page 4 of the application
INSERT INTO applicant_wish_courses (sso, course_id, grade_received) 
	VALUES ($sso, $course_id, $grade_received);
INSERT INTO applicant_prev_taught_courses (sso, course_id, semester_taught) 
	VALUES ($sso, $course_id, $semester_taught);
INSERT INTO applicant_curr_taught_courses (sso, course_id) 
	VALUES (sso, course_id);

#Page 5 of the application
UPDATE Applicant SET gato_req_met = $gato_req_met, resume_filepath = $resume_filepath, 
	submit_date = $submit_date, app_submitted = $app_submitted WHERE sso = $sso;

#Instructor Comments
INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment) 
	VALUES ($sso, $course_id, $dates_taught, $instructor_sso, $comment);

#Applicant Offer table
INSERT INTO applicant_offer_received (sso, course_id, section) 
	VALUES ($sso, $course_id, $section);

#Applicant Accepts/Rejects offer
UPDATE applicant_offer_received SET offer_accepted = $offer_accepted WHERE sso = $sso;