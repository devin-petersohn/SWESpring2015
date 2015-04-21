--contains plain text passwords
--TODO: hash passwords, add salt
--TODO: customize based on domain

CREATE TABLE mailumkcedu
(
	username varchar(8) PRIMARY KEY,
	password varchar(20)
);

CREATE TABLE missouriedu
(
	username varchar(8) PRIMARY KEY,
	password varchar(20)
);

CREATE TABLE mizzouedu
(
	username varchar(8) PRIMARY KEY,
	password varchar(20)
);

CREATE TABLE umkcedu
(
	username varchar(8) PRIMARY KEY,
	password varchar(20)
);

CREATE TABLE mailmissouriedu
(
	username varchar(8) PRIMARY KEY,
	password varchar(20)
);

CREATE TABLE umcusers
(
	username varchar(8) PRIMARY KEY
);

CREATE TABLE tigers
(
	username varchar(8) PRIMARY KEY
);