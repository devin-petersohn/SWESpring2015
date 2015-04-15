CREATE TABLE Users (
sso VARCHAR(50) PRIMARY KEY NOT NULL,
domain VARCHAR(50) NOT NULL
);

CREATE TABLE Faculty (
sso VARCHAR(50) PRIMARY KEY REFERENCES Users(sso) ON DELETE CASCADE
);

CREATE TABLE Instructor (
sso VARCHAR(50) PRIMARY KEY REFERENCES Faculty(sso) ON DELETE CASCADE
);

CREATE TABLE Sys_Admin (
sso VARCHAR(50) PRIMARY KEY REFERENCES Faculty(sso) ON DELETE CASCADE
);

CREATE TABLE Admin (
sso VARCHAR(50) PRIMARY KEY REFERENCES Faculty(sso) ON DELETE CASCADE
);

CREATE TABLE Course (
course_id VARCHAR(50) NOT NULL,
section VARCHAR(5) NOT NULL,
slots_available int
PRIMARY KEY (course_id, section)
);

CREATE TABLE instructor_teaches (
instructor_sso VARCHAR(50) REFERENCES Instructor(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
section VARCHAR(5) NOT NULL,
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
submit_date DATE
);

CREATE TABLE applicant_prev_taught_course (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
semester_taught VARCHAR(20) NOT NULL,
PRIMARY KEY (sso, course_id)
);

CREATE TABLE applicant_other_workplaces (
sso VARCHAR(50) PRIMARY KEY REFERENCES Applicant(sso) ON DELETE CASCADE,
workplace VARCHAR(50)
);

CREATE TABLE applicant_curr_taught_courses (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
PRIMARY KEY (sso,course_id)
);

CREATE TABLE applicant_offer_received (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
section VARCHAR(5),
offer_accepted BOOLEAN,
PRIMARY KEY (sso, course_id)
);

CREATE TABLE applicant_wish_course (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
grade_received CHAR(2),
PRIMARY KEY (sso,course_id)
);

CREATE TABLE appliant_comments (
sso VARCHAR(50) REFERENCES Applicant(sso) ON DELETE CASCADE,
course_id VARCHAR(50) REFERENCES Course(course_id) ON DELETE CASCADE,
dates_taught VARCHAR(50),
instructor_sso VARCHAR(50) REFERENCES Instructor(sso) ON DELETE CASCADE,
comment VARCHAR(3000),
PRIMARY KEY (sso, course_id, dates_taught)
);

CREATE TABLE applicant_is_a_ugrad (
sso VARCHAR(50) PRIMARY KEY REFERENCES Applicant(sso) ON DELETE CASCADE,
program CHAR(2),
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