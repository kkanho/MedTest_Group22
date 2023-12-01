<?php   //Interact with Database

declare(strict_types=1);

//for table fetching
function getAppointment(object $pdo): array {

    $aeskey = "GThKyaCpvHWlh9OW";

    $query = "SELECT Appointments.Appointment_id, Appointments.Sampling_type, Appointments.Appointments_datetime, Appointments.Patient_id, Patients.Patient_name, AES_DECRYPT(Patients.Email, :aeskey) AS Email
    FROM Appointments
    JOIN Patients
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
function getAvailableTest(object $pdo) {

    $query = "SELECT Test_id, Test_code, Test_name, Description, Cost FROM Tests";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getOrder(object $pdo) {

    // $aeskey = "GThKyaCpvHWlh9OW";

    $query = "SELECT Orders.Order_id, Orders.Order_date, Orders.Status, Patients.Patient_name, Staff.Staff_name, Staff.Position, Orders.Test_id 
    FROM Orders
    JOIN Patients
    ON Orders.Patient_id = Patients.Patient_id
    LEFT OUTER JOIN Staff
    ON Orders.Staff_id = Staff.Staff_id;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
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
    
    $query = "SELECT Results.Result_id, Results.Report_url, Results.Interpretation, Results.Order_id, Orders.Status, Staff.Staff_name, Staff.Position, AES_DECRYPT(Staff.Email, :aeskey) as Email
    FROM Results
    JOIN Orders
	ON Results.Order_id = Orders.Order_id
    LEFT OUTER JOIN Staff
	ON Orders.Staff_id = Staff.Staff_id";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":aeskey", $aesKey);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}


//for appointment
function insertAppointment(object $pdo, string $Sampling_type, string $Appointments_datetime, string $Patient_name) {

    $query = "INSERT INTO Appointments (Sampling_type, Appointments_datetime, Patient_id) VALUES (:Sampling_type, :Appointments_datetime, (SELECT Patient_id FROM Patients WHERE Patient_name = :Patient_name));";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Sampling_type", $Sampling_type);
    $stmt->bindParam(":Appointments_datetime", $Appointments_datetime);
    $stmt->bindParam(":Patient_name", $Patient_name);
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

//for order
function updateOrder(object $pdo, string $Order_id, string $Order_date, string $Status, string $Patient_name, string $Staff_name, string $Test_id) {

    $query = "UPDATE Orders SET Order_date = :Order_date, Status = :Status, Patient_id = (SELECT Patient_id FROM Patients WHERE Patient_name = :Patient_name), Staff_id = (SELECT Staff_id FROM Staff WHERE Staff_name = :Staff_name), Test_id = :Test_id WHERE Order_id = :Order_id;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $data = [
        'Order_id' => $Order_id,
        'Order_date' => $Order_date,
        'Status' => $Status,
        'Patient_name' => $Patient_name,
        'Staff_name' => $Staff_name,
        'Test_id' => $Test_id,
    ];
    
    $stmt->execute($data);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}
function insertOrder(object $pdo, string $Order_date, string $Status, string $Patient_name, string $Staff_name, ?string $Test_id) {

    $query = "INSERT INTO Orders (Order_date, Status, Patient_id, Staff_id, Test_id) VALUES (:Order_date, :Status, (SELECT Patient_id FROM Patients WHERE Patient_name = :Patient_name), (SELECT Staff_id FROM Staff WHERE Staff_name = :Staff_name), :Test_id);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Order_date", $Order_date);
    $stmt->bindParam(":Status", $Status);
    $stmt->bindParam(":Patient_name", $Patient_name);
    $stmt->bindParam(":Staff_name", $Staff_name);
    $stmt->bindParam(":Test_id", $Test_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}
function deleteOrder(object $pdo, int $rowIndex) {

    $query = "DELETE FROM Orders WHERE Order_id = :rowIndex;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":rowIndex", $rowIndex);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}

//for result
function insertResult(object $pdo, string $Report_url, string $Interpretation, string $Order_id, string $Staff_name) {

    $query = "INSERT INTO Results (Report_url, Interpretation, Order_id, Staff_id) VALUES (:Report_url, :Interpretation, :Order_id, (SELECT Staff_id FROM Staff WHERE Staff_name = :Staff_name));";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Report_url", $Report_url);
    $stmt->bindParam(":Interpretation", $Interpretation);
    $stmt->bindParam(":Order_id", $Order_id);
    $stmt->bindParam(":Staff_name", $Staff_name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}
function deleteResult(object $pdo, int $rowIndex) {

    $query = "DELETE FROM Results WHERE Result_id = :rowIndex;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":rowIndex", $rowIndex);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}

//for billing
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



function getPatientUserID(object $pdo, $Patient_name) {

    $query = "SELECT Patient_id FROM Patients WHERE Patient_name = :Patient_name;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Patient_name", $Patient_name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;

}
function getStaffUserID(object $pdo, $Staff_name) {

    $query = "SELECT Staff_id FROM Staff WHERE Staff_name = :Staff_name;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Staff_name", $Staff_name);
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
function getTestID(object $pdo, $Test_id) {

    $query = "SELECT Test_id FROM Tests WHERE Test_id = :Test_id;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":Test_id", $Test_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;

}