-- Patients 
CREATE TABLE Patients (
    Patient_id INT NOT NULL,
    Patient_Name VARCHAR(255) NOT NULL,
    DOB DATE NOT NULL,
    Contact VARCHAR(255) NOT NULL,
    Insurance VARCHAR(255) NOT NULL,
    Encrypted_password VARCHAR(255) NOT NULL,
    PRIMARY KEY (Patient_id)
);

-- Staff 
CREATE TABLE Staff (
    Staff_id INT NOT NULL,
    Staff_Name VARCHAR(255) NOT NULL,
    Position VARCHAR(255) NOT NULL,
    Contact VARCHAR(255) NOT NULL,
    Encrypted_password VARCHAR(255) NOT NULL,
    PRIMARY KEY (Staff_id)
);

-- Tests 
CREATE TABLE Tests (
    Test_code INT NOT NULL,
    Test_Name VARCHAR(255) NOT NULL,
    Test_Descrip TEXT NOT NULL,
    Cost DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (Test_code)
);

-- Orders 
CREATE TABLE Orders (
    Order_id INT NOT NULL,
    Patient_id INT NOT NULL,
    Test_code INT NOT NULL,
    Staff_id INT NOT NULL,
    Order_date DATE NOT NULL,
    Status VARCHAR(255) NOT NULL,
    PRIMARY KEY (Order_id),
    FOREIGN KEY (Patient_id) REFERENCES Patients(Patient_id),
    FOREIGN KEY (Test_code) REFERENCES Tests(Test_code),
    FOREIGN KEY (Staff_id) REFERENCES Staff(Staff_id)
);

-- Appointments 
CREATE TABLE Appointments (
    Appointment_id INT NOT NULL,
    Patient_id INT NOT NULL,
    Sampling_type VARCHAR(255) NOT NULL,
    Appointments_Date DATE NOT NULL,
    Appointments_Time TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (Appointment_id),
    FOREIGN KEY (Patient_id) REFERENCES Patients(Patient_id)
);

-- Results 
CREATE TABLE Results (
    Result_id INT NOT NULL,
    Order_id INT NOT NULL,
    Report_URL VARCHAR(255) NOT NULL,
    Interpretation VARCHAR(255) NOT NULL,
    Staff_id INT NOT NULL,
    PRIMARY KEY (Result_id),
    FOREIGN KEY (Order_id) REFERENCES Orders(Order_id),
    FOREIGN KEY (Staff_id) REFERENCES Staff(Staff_id)
);

-- Billing 
CREATE TABLE Billing (
    Bill_id INT NOT NULL,
    Order_id INT NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    Payment_Status VARCHAR(255) NOT NULL,
    Insurance_Status VARCHAR(255) NOT NULL,
    PRIMARY KEY (Result_id),
    FOREIGN KEY (Order_id) REFERENCES Orders(Order_id)
);

-- Lab_staff Role 
CREATE ROLE Lab_staff;
CREATE USER xxxx IDENTIFIED BY 'xxxxx';
GRANT Lab_staff TO xxxx;
GRANT SELECT, INSERT, UPDATE, DELETE ON Tests TO Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Appointments TO Lab_staff;
GRANT SELECT, INSERT, UPDATE, DELETE ON Results TO Lab_staff;

-- Secretaries Role
CREATE ROLE Secretaries;
CREATE USER xxxx IDENTIFIED BY 'xxxxx';
GRANT Secretaries TO xxxx;
GRANT SELECT, INSERT, UPDATE, DELETE ON Appointments TO Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Billing TO Secretaries;
GRANT SELECT, INSERT, UPDATE, DELETE ON Results TO Secretaries;

-- Patients Role
CREATE ROLE Patients;
CREATE USER xxxx IDENTIFIED BY 'xxxxx';
GRANT Patients TO xxxx;
GRANT SELECT ON Orders TO Patients;
GRANT SELECT ON Billing TO Patients;
GRANT SELECT ON Results TO Patients;