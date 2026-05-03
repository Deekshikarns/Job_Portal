CREATE DATABASE jobhiring;

USE jobhiring;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2020 at 11:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobhiring`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--
CREATE TABLE signup (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,  
    age INT CHECK (age >= 0),  
    dob DATE NOT NULL, 
    gender ENUM('Male', 'Female', 'Other') NOT NULL,  -- Adding gender field
    job ENUM('joblooking', 'jobhiring') NOT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    phone_number VARCHAR(15) DEFAULT NULL,  -- Adding phone_number field
    address TEXT DEFAULT NULL,  -- Adding address field
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Insert data into the `signup` table
INSERT INTO signup (id, name, email, password, job) 
VALUES 
    (1, 'Ram', 'Ram2@gmail.com', 'Ram@123', 'joblooking'),
    (2, 'Sita', 'sita23@gmail.com', 'Sita@345', 'jobhiring');


--

-- --------------------------------------------------------

--
-- Table structure for table `jobhiring`
--
CREATE TABLE jobhiring
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    image_file VARCHAR(255) NOT NULL,
    jobname VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    company VARCHAR(225) NOT NULL,
    location VARCHAR(255) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    description TEXT,
    vacancies INT NOT NULL,
    nature ENUM('full-time', 'part-time') NOT NULL,
    submission DATE NOT NULL,
    form_date DATE DEFAULT CURRENT_DATE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE signup ADD COLUMN job_type VARCHAR(20);
ALTER TABLE jobhiring ADD COLUMN experience VARCHAR(255) DEFAULT NULL;
ALTER TABLE jobhiring ADD COLUMN bond VARCHAR(255) DEFAULT NULL;
ALTER TABLE jobhiring ADD COLUMN courses VARCHAR(255) DEFAULT NULL;
ALTER TABLE jobhiring ADD COLUMN criteria VARCHAR(255) DEFAULT NULL;
ALTER TABLE signup ADD COLUMN interests TEXT DEFAULT NULL;
ALTER TABLE jobhiring ADD COLUMN tags TEXT DEFAULT NULL;


CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
     resume VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    email VARCHAR(150) NOT NULL,
    location VARCHAR(100) NOT NULL,
    linkedin VARCHAR(255),
    github VARCHAR(255),
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE jobhiring ADD COLUMN application_id INT DEFAULT NULL;

ALTER TABLE jobhiring ADD CONSTRAINT fk1 FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE SET NULL;
ALTER TABLE applications ADD COLUMN status VARCHAR(50) DEFAULT 'pending';
UPDATE jobhiring SET application_id = (
    SELECT id 
    FROM applications 
    WHERE applications.job_id = jobhiring.id 
    ORDER BY submission_date DESC 
    LIMIT 1
);
ALTER TABLE jobhiring ADD COLUMN user_id INT DEFAULT NULL;

ALTER TABLE jobhiring ADD CONSTRAINT fk2 FOREIGN KEY (user_id) REFERENCES signup(id) ON DELETE SET NULL;

ALTER TABLE applications ADD COLUMN userid INT DEFAULT NULL;
ALTER TABLE applications ADD CONSTRAINT fk3 FOREIGN KEY (userid) REFERENCES signup(id) ON DELETE SET NULL;

CREATE TABLE resume (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(250) NOT NULL,
    email VARCHAR(250) NOT NULL,
    mobile_no VARCHAR(15),
    dob DATE, 
    gender VARCHAR(50),
    religion VARCHAR(50),
    nationality VARCHAR(50),
    marital_status VARCHAR(50),
    hobbies VARCHAR(255), 
    languages VARCHAR(255), 
    address TEXT,
    objective TEXT,
    slug VARCHAR(250),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE experience (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Use AUTO_INCREMENT for unique experience ID
    resume_id INT NOT NULL,                    -- Foreign key to the resume table
    title VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    experience INT NOT NULL,                       -- Optional year or 'Present'
    FOREIGN KEY (resume_id) REFERENCES resume(id)  -- Foreign key relationship with resume
);

CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resume_id INT NOT NULL,                   -- Foreign key to resume table
    course VARCHAR(250),                      -- Course name (nullable if not always required)
    institute VARCHAR(250) NOT NULL,          -- Institute name
    year INT NOT NULL,                      -- Year of Graduation
    marks VARCHAR(255) NOT NULL,                       -- Completion date (nullable if ongoing)
    FOREIGN KEY (resume_id) REFERENCES resume(id)  -- Foreign key relationship with resume
);
ALTER TABLE education  ADD COLUMN year_of_graduation INT;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resume_id INT NOT NULL,  
    title VARCHAR(255) NOT NULL,
    projectlink VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    team_size INT NOT NULL,
    skills TEXT NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (resume_id) REFERENCES resume(id)
);




CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resume_id INT NOT NULL,                   -- Foreign key to resume table
    skill TEXT NOT NULL,                      -- Skill(s) listed in text
    FOREIGN KEY (resume_id) REFERENCES resume(id)  -- Foreign key relationship with resume
);


CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL UNIQUE
);

-- Table for questions
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    question TEXT NOT NULL,
    option1 VARCHAR(255) NOT NULL,
    option2 VARCHAR(255) NOT NULL,
    option3 VARCHAR(255) NOT NULL,
    option4 VARCHAR(255) NOT NULL,
    correct_option TINYINT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

ALTER TABLE courses ADD COLUMN duration INT DEFAULT 30; 

CREATE TABLE quiz_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    score INT NOT NULL,
    total_questions INT NOT NULL,
    percentage DECIMAL(5,2) NOT NULL,
    taken_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES signup(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);



CREATE TABLE interview_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    role VARCHAR(100),
    question TEXT,
    answer TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
