USE blogs;

CREATE TABLE authors (
    email VARCHAR(128) NOT NULL PRIMARY KEY,
    pass_hash varchar(255) NOT NULL, 
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
    biography TEXT NOT NULL,
	created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO authors (email, pass_hash, firstname, lastname, biography) VALUES ("A00205715@cambriancollege.ca", "jazz123", "Jasmeet", "Singh", "Student at Cambrian College.");
