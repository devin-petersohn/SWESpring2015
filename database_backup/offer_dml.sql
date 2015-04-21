#Applicant Offer table
INSERT INTO applicant_offer_received (sso, course_id, section) 
	VALUES ($sso, $course_id, $section);

#Applicant Accepts/Rejects offer
UPDATE applicant_offer_received SET offer_accepted = $offer_accepted WHERE sso = $sso;

#Applicant assigned to course
UPDATE applicant_offer_received SET assigned_to_course = $assigned_to_course WHERE sso = $sso;
INSERT INTO applicant_course_assignments (sso, course_id, section) VALUES ($sso, $course_id, $section);

