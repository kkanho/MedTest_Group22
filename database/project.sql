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




-- Patients 
CREATE TABLE Patients (
    Patient_id INT NOT NULL AUTO_INCREMENT,
    Patient_name VARCHAR(100) NOT NULL,     /*username*/
    Encrypted_password VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL,            /*Email as the contact information*/
    DOB DATE,
    Insurance VARCHAR(255),                 /*Null indicates no insurance*/
    Created_at DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (Patient_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Staff 
CREATE TABLE Staff (
    Staff_id INT NOT NULL AUTO_INCREMENT,
    Staff_name VARCHAR(100) NOT NULL,
    Encrypted_password VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL,            /*Email as the contact information*/
    Position VARCHAR(100) NOT NULL,             
    Created_at DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (Staff_id)
);

-- Tests 
CREATE TABLE Tests (
    Test_id INT NOT NULL AUTO_INCREMENT,
    Test_code VARCHAR(100) NOT NULL,
    Test_name VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    Cost DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (Test_id)
);

-- Orders 
CREATE TABLE Orders (
    Order_id INT NOT NULL AUTO_INCREMENT,
    Order_date DATE NOT NULL,
    Status VARCHAR(100) NOT NULL,
    Patient_id INT NOT NULL,
    Test_id INT NOT NULL,
    Staff_id INT NOT NULL,
    PRIMARY KEY (Order_id),
    FOREIGN KEY (Patient_id) REFERENCES Patients(Patient_id),
    FOREIGN KEY (Test_id) REFERENCES Tests(Test_id),
    FOREIGN KEY (Staff_id) REFERENCES Staff(Staff_id)
);

-- Appointments 
CREATE TABLE Appointments (
    Appointment_id INT NOT NULL AUTO_INCREMENT,
    Sampling_type VARCHAR(100) NOT NULL,
    Appointments_datetime DATETIME NOT NULL,
    Patient_id INT NOT NULL,
    PRIMARY KEY (Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES Patients(Patient_id)
);

-- Results 
CREATE TABLE Results (
    Result_id INT NOT NULL AUTO_INCREMENT,
    Report_url VARCHAR(255) NOT NULL,
    Interpretation VARCHAR(255) NOT NULL,
    Order_id INT NOT NULL,
    Staff_id INT NOT NULL,
    PRIMARY KEY (Result_id),
    FOREIGN KEY (Order_id) REFERENCES Orders(Order_id),
    FOREIGN KEY (Staff_id) REFERENCES Staff(Staff_id)
);

-- Billing 
CREATE TABLE Billing (
    Billing_id INT NOT NULL AUTO_INCREMENT,
    Amount DECIMAL(10, 2) NOT NULL,
    Payment_Status VARCHAR(255) NOT NULL,
    Insurance_Status VARCHAR(255) NOT NULL,
    Order_id INT NOT NULL,
    PRIMARY KEY (Billing_id),
    FOREIGN KEY (Order_id) REFERENCES Orders(Order_id)
);

-- Create pre-defined patient user
INSERT INTO Patients (Patient_id, Patient_name, Encrypted_password, Email, DOB, Insurance, Created_at) VALUES (NULL, "kan", "$2y$10$4K03dKIEiK28IriSPzguSOnuMF7dukMeYT/cqAkgTIWRVyLbG9DT6", "kan@gmail.com", NULL, NULL, CURRENT_TIMESTAMP);

-- Create pre-defined staff user
INSERT INTO Staff (Staff_id, Staff_name, Encrypted_password, Email, Position, Created_at) VALUES (NULL, "kan", "$2y$10$4K03dKIEiK28IriSPzguSOnuMF7dukMeYT/cqAkgTIWRVyLbG9DT6", "kan@gmail.com", "secretaries", CURRENT_TIMESTAMP), (NULL, "theo", "$2y$10$1L6ClloeqSAmJCKy67YDE.jDE7w3oRlFvfXMWnP326kRWMQ6a2mri", "theo@gmail.com", "lab_staff", CURRENT_TIMESTAMP);

-- Create dummy row
INSERT INTO Tests (Test_id, Test_code, Test_name, Description, Cost) VALUES (NULL, "test001", "A-Test", "A-Test is just a test", "1000"), (NULL, "test002", "B-Test", "B-Test is just another test", "5000");
INSERT INTO Orders (Order_id, Order_date, Status, Patient_id, Test_id, Staff_id) VALUES (NULL, "2023-11-15", "Done", "1", "1", "1"), (NULL, "2023-11-20", "Pending", "1", "2", "1");
INSERT INTO Results (Result_id, Report_url, Interpretation, Order_id, Staff_id) VALUES (NULL, "https://github.com/kkanho", "1st Dummy interpretation of the result", "1", "1"), (NULL, "https://github.com/kkanho", "2nd Dummy interpretation of the result", "2", "1");
INSERT INTO Billing (Billing_id, Amount, Payment_Status, Insurance_Status, Order_id) VALUES (NULL, "800", "Paid", "Accepted", "1");
INSERT INTO `Appointments` (`Appointment_id`, `Sampling_type`, `Appointments_datetime`, `Patient_id`) VALUES (NULL, 'Sampling Type A', '2023-11-08 23:13:46', '1'), (NULL, 'Sampling Type B', '2023-11-20 13:14:46', '1');

-- Lab_staff Role 
CREATE ROLE Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Tests TO Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Appointments TO Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Results TO Lab_staff;
-- CREATE USER xxxx IDENTIFIED BY "xxxxx";
-- GRANT Lab_staff TO xxxx;

-- Secretaries Role
CREATE ROLE Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Appointments TO Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Billing TO Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Results TO Secretaries;
-- CREATE USER xxxx IDENTIFIED BY "xxxxx";
-- GRANT Secretaries TO xxxx;

-- Patients Role
CREATE ROLE Patients;
GRANT SELECT ON Orders TO Patients;
GRANT SELECT ON Billing TO Patients;
GRANT SELECT ON Results TO Patients;
-- CREATE USER xxxx IDENTIFIED BY "xxxxx";
-- GRANT Patients TO xxxx;