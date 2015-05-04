CREATE OR REPLACE FUNCTION archive_faculty()
	RETURNS trigger AS $$
BEGIN
	INSERT INTO archived_users(sso,domain) VALUES(OLD.sso, 'missouri.edu');
	RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION archive_applicants()
	RETURNS trigger AS $$
BEGIN
	INSERT INTO archived_users(sso,domain) VALUES(OLD.sso, 'mail.missouri.edu');
	INSERT INTO Archived_Applicant (sso, id, fname, lname, phone_number, email, expected_grad_date, gpa, gato_req_met, submit_date, score) 
		VALUES (OLD.sso, OLD.id, OLD.fname, OLD.lname, OLD.phone_number, OLD.email, OLD.expected_grad_date, 
		OLD.gpa, OLD.gato_req_met, OLD.submit_date, OLD.score);
	RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION delete_from_users()
	RETURNS trigger AS $$
BEGIN
	DELETE FROM Users WHERE sso = OLD.sso;
	RETURN OLD;
END;
$$ LANGUAGE plpgsql;


CREATE TRIGGER remove_faculty AFTER DELETE ON Faculty
	FOR EACH ROW EXECUTE PROCEDURE delete_from_users;

CREATE TRIGGER remove_applicant AFTER DELETE ON Archived_Applicant
	FOR EACH ROW EXECUTE PROCEDURE delete_from_users;

CREATE TRIGGER archive_user BEFORE DELETE ON Faculty
	FOR EACH ROW EXECUTE PROCEDURE archive_faculty;

CREATE TRIGGER archive_applicant BEFORE DELETE ON Archived_Applicant
	FOR EACH ROW EXECUTE PROCEDURE archive_applicants;


CREATE TABLE Archived_Users (
sso VARCHAR(50) PRIMARY KEY NOT NULL,
domain VARCHAR(50) NOT NULL
);

CREATE TABLE Archived_Applicant (
sso VARCHAR(50) PRIMARY KEY REFERENCES Users(sso) ON DELETE CASCADE,
id INT,
fname VARCHAR(50),
lname VARCHAR(50),
phone_number VARCHAR(50),
email VARCHAR(50),
expected_grad_date VARCHAR(50),
gpa FLOAT,
gato_req_met BOOLEAN,
submit_date DATE,
score INT
);
