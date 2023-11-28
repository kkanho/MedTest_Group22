-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Nov 06, 2023 at 01:34 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: lamp_docker
--

-- --------------------------------------------------------


SET GLOBAL general_log = 'ON';

-- Patients 
CREATE TABLE Patients (
    Patient_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Patient_name VARCHAR(100) NOT NULL UNIQUE,     /*username*/
    Encrypted_password VARCHAR(255) NOT NULL,
    Email VARBINARY(255) NOT NULL,            /*Email as the contact information*/
    DOB DATE NULL,
    Insurance VARCHAR(255) NULL,                 /*Null indicates no insurance*/
    Created_at DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (Patient_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Staff 
CREATE TABLE Staff (
    Staff_id INT NOT NULL AUTO_INCREMENT UNIQUE,
    Staff_name VARCHAR(100) NOT NULL UNIQUE,
    Encrypted_password VARCHAR(255) NOT NULL,
    Email VARBINARY(255) NOT NULL,            /*Email as the contact information*/
    Position VARCHAR(100) NOT NULL,             
    Created_at DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (Staff_id)
);

-- Tests 
CREATE TABLE Tests (
    Test_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Test_code VARCHAR(100) NOT NULL,
    Test_name VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    Cost DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (Test_id)
);

-- Orders 
CREATE TABLE Orders (
    Order_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Order_date DATE NOT NULL,
    Status VARCHAR(100) NOT NULL,
    Patient_id INT NOT NULL,
    Staff_id INT NULL,
    Test_id INT NULL,
    PRIMARY KEY (Order_id),
    FOREIGN KEY (Patient_id) REFERENCES Patients(Patient_id),
    FOREIGN KEY (Test_id) REFERENCES Tests(Test_id),
    FOREIGN KEY (Staff_id) REFERENCES Staff(Staff_id)
);

-- Appointments 
CREATE TABLE Appointments (
    Appointment_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Sampling_type VARCHAR(100) NOT NULL,
    Appointments_datetime DATETIME NOT NULL,
    Patient_id INT NULL,
    PRIMARY KEY (Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES Patients(Patient_id)
);

-- Results 
CREATE TABLE Results (
    Result_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Report_url VARCHAR(255) NOT NULL,
    Interpretation VARCHAR(255) NOT NULL,
    Order_id INT NULL,
    PRIMARY KEY (Result_id),
    FOREIGN KEY (Order_id) REFERENCES Orders(Order_id)
);

-- Billing 
CREATE TABLE Billing (
    Billing_id INT NOT NULL UNIQUE AUTO_INCREMENT,
    Amount DECIMAL(10, 2) NOT NULL,
    Payment_Status VARCHAR(255) NOT NULL,
    Insurance_Status VARCHAR(255),
    Order_id INT NOT NULL,
    PRIMARY KEY (Billing_id),
    FOREIGN KEY (Order_id) REFERENCES Orders(Order_id)
);

-- Create pre-defined patient user
INSERT INTO Patients (Patient_id, Patient_name, Encrypted_password, Email, DOB, Insurance, Created_at) VALUES 
(NULL, "kan", "$2y$10$4K03dKIEiK28IriSPzguSOnuMF7dukMeYT/cqAkgTIWRVyLbG9DT6", AES_ENCRYPT("kan@gmail.com", "GThKyaCpvHWlh9OW"), NULL, "Some Company", CURRENT_TIMESTAMP),
(NULL, "chloe", "$2y$10$/mgQjcVRWaBZa5S11wQ2LOHl8l59jDXQczuO13lni1x47wfYdMly6", AES_ENCRYPT("chloe@gmail.com", "GThKyaCpvHWlh9OW"), NULL, "ABC Company", CURRENT_TIMESTAMP),
(NULL, "A", "$2y$10$fp23Vi1bkhM03CZV17qCTuTUXi82M8k5iTpSPHQ0Bm90Tn.W4t.S.", AES_ENCRYPT("A@gmail.com", "GThKyaCpvHWlh9OW"), NULL, NULL, CURRENT_TIMESTAMP),
(NULL, "B", "$2y$10$n1kyetRfrloRrvyt5UHTs.LixKUrSfLZUDgJnBBVzItW2Uq7bvtDa", AES_ENCRYPT("B@gmail.com", "GThKyaCpvHWlh9OW"), NULL, NULL, CURRENT_TIMESTAMP),
(NULL, "C", "$2y$10$eg8iiGjIiD3ve4ZIHtcT9uwRTPS2SbtuD6xRl9KodKS8PErB4vbme", AES_ENCRYPT("C@gmail.com", "GThKyaCpvHWlh9OW"), NULL, NULL, CURRENT_TIMESTAMP);

-- Create pre-defined staff user
INSERT INTO Staff (Staff_id, Staff_name, Encrypted_password, Email, Position, Created_at) VALUES 
(NULL, "kan", "$2y$10$4K03dKIEiK28IriSPzguSOnuMF7dukMeYT/cqAkgTIWRVyLbG9DT6", AES_ENCRYPT("kan@gmail.com", "GThKyaCpvHWlh9OW"), "secretaries", CURRENT_TIMESTAMP), 
(NULL, "theo", "$2y$10$1L6ClloeqSAmJCKy67YDE.jDE7w3oRlFvfXMWnP326kRWMQ6a2mri", AES_ENCRYPT("theo@gmail.com", "GThKyaCpvHWlh9OW"), "lab_staff", CURRENT_TIMESTAMP),
(NULL, "X", "$2y$10$HV5BPMYKMYQdJmmPSvgGgu49SLoFBch4qV2x0HqNqi.1utOWaw0am", AES_ENCRYPT("X@gmail.com", "GThKyaCpvHWlh9OW"), "doctor", CURRENT_TIMESTAMP), 
(NULL, "Y", "$2y$10$oRS86M4vyE.Ul1Q4196aEuNgsHIMO6IoPPX7IJ9zgik2CLudjrhuO", AES_ENCRYPT("Y@gmail.com", "GThKyaCpvHWlh9OW"), "doctor", CURRENT_TIMESTAMP), 
(NULL, "Z", "$2y$10$7qV6wfvr7BYwtJ672yOuuOWlF9TQH64YNJRkp5XVyL4AwqYYM.Voq", AES_ENCRYPT("Z@gmail.com", "GThKyaCpvHWlh9OW"), "doctor", CURRENT_TIMESTAMP);

-- Create dummy row
INSERT INTO Tests (Test_id, Test_code, Test_name, Description, Cost) VALUES (NULL, "Test001", "A-Test", "Blood sampling", "1000"), 
(NULL, "Test002", "B-Test", "X-ray A", "3000"),
(NULL, "Test003", "C-Test", "Blood sampling, X-ray A", "4000"),
(NULL, "Test004", "D-Test", "Blood sampling, X-ray B", "4000");

INSERT INTO Orders (Order_id, Order_date, Status, Patient_id, Test_id, Staff_id) VALUES 
(NULL, "2023-11-15", "Done", "1", "1", NULL), 
(NULL, "2023-11-20", "Bill Pending", "1", "2", NULL),
(NULL, "2023-11-20", "Done", "2", "1", NULL),
(NULL, "2023-11-20", "Bill Pending", "2", "2", NULL),
(NULL, "2023-11-20", "Test Pending", "3", "3", "2"),
(NULL, "2023-12-12", "Result Pending", "2", "4", "4");

INSERT INTO Results (Result_id, Report_url, Interpretation, Order_id) VALUES 
(NULL, "https://github.com/kkanho", "Interpretation of A-Test", "1"), 
(NULL, "https://github.com/kkanho", "Interpretation of B-Test", "2"),
(NULL, "https://github.com/kkanho", "Interpretation of A-Test", "3"),
(NULL, "https://github.com/kkanho", "Interpretation of B-Test", "4"),
(NULL, "https://github.com/kkanho", "Interpretation of D-Test", "5");

INSERT INTO Billing (Billing_id, Amount, Payment_Status, Insurance_Status, Order_id) VALUES 
(NULL, "1200", "Paid", "Claimed", "1"),
(NULL, "1800", "Not Paid", "Accepted", "2"),
(NULL, "1200", "Paid", "Claimed", "3"),
(NULL, "1500", "Not Paid", "Accepted", "4");

INSERT INTO Appointments (`Appointment_id`, `Sampling_type`, `Appointments_datetime`, `Patient_id`) VALUES (NULL, 'Blood', '2023-11-08 08:30', '1'), 
(NULL, 'X-ray A', '2023-11-16 08:30', '1'),
(NULL, 'Blood', '2023-11-08 09:30', '2'),
(NULL, 'X-ray B', '2023-11-16 09:30', '2'),
(NULL, 'Blood', '2023-11-08 10:30', '3'),
(NULL, 'X-ray A', '2023-11-16 10:30', '3'),
(NULL, 'Blood', '2023-11-08 11:30', '4'),
(NULL, 'X-ray B', '2023-11-16 11:30', '4');


-- the following will not work since admin don't have the privilege to grant privileges for other users
-- However, admin is able to perform create
-- Lab_staff Role 
CREATE ROLE Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Tests TO Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Appointments TO Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Results TO Lab_staff;
CREATE USER 'theo' IDENTIFIED BY 'theo';
GRANT Lab_staff TO 'theo';

-- Secretaries Role
CREATE ROLE Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Appointments TO Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Billing TO Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Results TO Secretaries;
CREATE USER 'kan' IDENTIFIED BY 'kan';
GRANT Secretaries TO 'kan';

-- Patients Role
CREATE ROLE Patients;
GRANT SELECT ON Orders TO Patients;
GRANT SELECT ON Billing TO Patients;
GRANT SELECT ON Results TO Patients;
CREATE USER 'chloe' IDENTIFIED BY 'chloe';
GRANT Patients TO 'chloe';