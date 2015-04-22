#Instructor Comments
INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment) 
	VALUES ($sso, $course_id, $dates_taught, $instructor_sso, $comment);

#Get all Comments from a specific student
SELECT * FROM applicant_comments WHERE sso = $sso;
SELECT fname, lname FROM Applicant WHERE sso = $sso;

