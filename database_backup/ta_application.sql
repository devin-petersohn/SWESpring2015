DROP TABLE IF EXISTS Instructors CASCADE;
DROP TABLE IF EXISTS Faculty CASCADE;
DROP TABLE IF EXISTS applicant_is_international CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Sys_Admin CASCADE;
DROP TABLE IF EXISTS Admin CASCADE;
DROP TABLE IF EXISTS Course CASCADE;
DROP TABLE IF EXISTS instructor_teaches CASCADE;
DROP TABLE IF EXISTS Applicant CASCADE;
DROP TABLE IF EXISTS applicant_prev_taught_course CASCADE;
DROP TABLE IF EXISTS applicant_other_workplaces CASCADE;
DROP TABLE IF EXISTS applicant_curr_taught_courses CASCADE;
DROP TABLE IF EXISTS applicant_offer_received CASCADE;
DROP TABLE IF EXISTS applicant_wish_course CASCADE;
DROP TABLE IF EXISTS appliant_comments CASCADE;
DROP TABLE IF EXISTS applicant_is_a_ugrad CASCADE;
DROP TABLE IF EXISTS applicant_is_a_grad CASCADE;
DROP TABLE IF EXISTS Time_window CASCADE;
DROP TABLE IF EXISTS applicant_course_assignments CASCADE;



CREATE TABLE Users (
sso VARCHAR(50) PRIMARY KEY NOT NULL,
domain VARCHAR(50) NOT NULL
);


CREATE TABLE Faculty (
sso VARCHAR(50) PRIMARY KEY REFERENCES Users(sso) ON DELETE CASCADE
);


CREATE TABLE Instructor (
sso VARCHAR(50) PRIMARY KEY REFERENCES Faculty(sso) ON DELETE CASCADE,
fname VARCHAR(50),
lname VARCHAR(50)
);


CREATE TABLE Sys_Admin (
sso VARCHAR(50) PRIMARY KEY REFERENCES Faculty(sso) ON DELETE CASCADE
fname VARCHAR(50),
lname VARCHAR(50)
);


CREATE TABLE Admin (
sso VARCHAR(50) PRIMARY KEY REFERENCES Faculty(sso) ON DELETE CASCADE
fname VARCHAR(50),
lname VARCHAR(50)
);


CREATE TABLE Course (
course_id VARCHAR(50) NOT NULL,
slots_available int,
PRIMARY KEY (course_id)
);


CREATE TABLE instructor_teaches (
instructor_sso VARCHAR(50) REFERENCES Instructor(sso) ON DELETE CASCADE,
course_id VARCHAR(50),
FOREIGN KEY (course_id) REFERENCES Course(course_id) ON DELETE CASCADE,
PRIMARY KEY (instructor_sso, course_id)
);


CREATE TABLE Applicant (
sso VARCHAR(50) PRIMARY KEY REFERENCES Users(sso) ON DELETE CASCADE,
id INT,
fname VARCHAR(50),
lname VARCHAR(50),
phone_number VARCHAR(50),
email VARCHAR(50),
expected_grad_date VARCHAR(50),
resume_filepath VARCHAR(50),
gpa FLOAT,
gato_req_met BOOLEAN,
app_submitted BOOLEAN,
submit_date DATE,
score INT
);


CREATE TABLE applicant_prev_taught_course (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course VARCHAR(50),
semester_taught VARCHAR(20),
PRIMARY KEY (sso, course, semester_taught)
);


CREATE TABLE applicant_other_workplaces (
sso VARCHAR(50) PRIMARY KEY REFERENCES Applicant(sso) ON DELETE CASCADE,
workplace VARCHAR(50)
);


CREATE TABLE applicant_curr_taught_courses (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course VARCHAR(50),
PRIMARY KEY (sso,course)
);


CREATE TABLE applicant_offer_received (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50),
section VARCHAR(50),
offer_accepted BOOLEAN,
assigned_to_course BOOLEAN,
FOREIGN KEY (course_id, section) REFERENCES Course(course_id, section) ON DELETE CASCADE,
PRIMARY KEY (sso, course_id, section)
);


CREATE TABLE applicant_wish_course (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50),
grade_received CHAR(2),
FOREIGN KEY (course_id) REFERENCES Course(course_id) ON DELETE CASCADE,
PRIMARY KEY (sso,course_id)
);


CREATE TABLE applicant_comments (
comment_id SERIAL PRIMARY KEY,
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50),
dates_taught VARCHAR(50),
instructor_sso VARCHAR(50) REFERENCES Instructor(sso) ON DELETE CASCADE,
comment VARCHAR(3000)
);


CREATE TABLE applicant_is_a_ugrad (
sso VARCHAR(50) PRIMARY KEY REFERENCES Applicant(sso) ON DELETE CASCADE,
program VARCHAR(50),
class VARCHAR(10)
);


CREATE TABLE applicant_is_a_grad (
sso VARCHAR(50) PRIMARY KEY REFERENCES Applicant(sso) ON DELETE CASCADE,
grad_program VARCHAR(15),
advisor_name VARCHAR(50)
);


CREATE TABLE applicant_is_international (
sso VARCHAR(50) PRIMARY KEY REFERENCES Applicant(sso) ON DELETE CASCADE,
speak_test_score VARCHAR(10),
speak_last_test_date DATE,
speak_req_met BOOLEAN,
speak_next_test_date DATE,
ointa_req_met BOOLEAN
);


CREATE TABLE Time_window (
windowName VARCHAR(50) PRIMARY KEY,
startTime DATE,
endTime DATE
);


CREATE TABLE applicant_course_assignments (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
PRIMARY KEY (sso, course_id)
);
