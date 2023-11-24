<?php   //Interact with Database

declare(strict_types=1);

function getAppointment(object $pdo): array {

    $aeskey = "GThKyaCpvHWlh9OW";

    $query = "SELECT Appointments.Appointment_id, Appointments.Sampling_type, Appointments.Appointments_datetime, Appointments.Patient_id, Patients.Patient_name, AES_DECRYPT(Patients.Email, :aeskey) AS Email
    FROM Appointments
    LEFT JOIN Patients
    ON Appointments.Patient_id = Patients.Patient_id";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":aeskey", $aeskey);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    return $result;
}
function getPatientsBilling(object $pdo): array {

    $query = "SELECT Billing.Billing_id, Billing.Amount, Billing.Payment_Status, Billing.Insurance_Status, Billing.Order_id, Patients.Patient_name 
    FROM Billing
    JOIN Orders
    ON Billing.Order_id = Orders.Order_id
    JOIN Patients
    ON Orders.Patient_id = Patients.Patient_id";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getSec_PatientsResults(object $pdo): array {

    $aesKey = "GThKyaCpvHWlh9OW"; //128bit aes key
    
    $query = "SELECT Results.Result_id, Results.Report_url, Results.Interpretation, Results.Order_id, Staff.Staff_name, Staff.Position, AES_DECRYPT(Staff.Email, :aeskey) as Email
    FROM Results
    JOIN Staff
    ON Results.Staff_id = Staff.Staff_id";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":aeskey", $aesKey);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}

function getPatientUserID(object $pdo, $Patient_name) {

    $query = "SELECT Patient_id FROM Patients WHERE Patient_name = :Patient_name;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Patient_name", $Patient_name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;

}

function insertAppointment(object $pdo, string $Sampling_type, string $Appointments_datetime, string $Patient_id) {

    $query = "INSERT INTO Appointments (Sampling_type, Appointments_datetime, Patient_id) VALUES (:Sampling_type, :Appointments_datetime, :Patient_id);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Sampling_type", $Sampling_type);
    $stmt->bindParam(":Appointments_datetime", $Appointments_datetime);
    $stmt->bindParam(":Patient_id", $Patient_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}
function deleteAppointment(object $pdo, int $rowIndex) {

    $query = "DELETE FROM Appointments WHERE Appointment_id = :rowIndex;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":rowIndex", $rowIndex);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}


function getOrderID(object $pdo, $Order_id) {

    $query = "SELECT Order_id FROM Orders WHERE Order_id = :Order_id;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Order_id", $Order_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;

}


function insertBilling(object $pdo, string $Amount, string $Payment_Status, string $Insurance_Status, int $Order_id) {

    $query = "INSERT INTO Billing (Amount, Payment_Status, Insurance_Status, Order_id) VALUES (:Amount, :Payment_Status, :Insurance_Status, :Order_id);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Amount", $Amount);
    $stmt->bindParam(":Payment_Status", $Payment_Status);
    $stmt->bindParam(":Insurance_Status", $Insurance_Status);
    $stmt->bindParam(":Order_id", $Order_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}
function deleteBilling(object $pdo, int $rowIndex) {

    $query = "DELETE FROM Billing WHERE Billing_id = :rowIndex;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":rowIndex", $rowIndex);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}