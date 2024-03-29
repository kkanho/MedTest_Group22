<?php   //Interact with Database

declare(strict_types=1);

function getPatientsSamplingType(object $pdo, string $Staff_id): array {

    

    // $query = "SELECT Appointments.Appointment_id, Appointments.Sampling_type, Appointments.Appointments_datetime, Appointments.Patient_id, Patients.Patient_name
    // FROM Appointments
    // LEFT OUTER JOIN Patients
    // ON Appointments.Patient_id = Patients.Patient_id";

    $query = "SELECT Orders.Order_id, Tests.Test_name, Orders.Status, Orders.Order_date, Patients.Patient_name
    FROM Orders
    LEFT OUTER JOIN Patients
    ON Orders.Patient_id = Patients.Patient_id
    LEFT OUTER JOIN Tests
    ON Orders.Test_id = Tests.Test_id
    WHERE Orders.Staff_id = :Staff_id;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Staff_id", $Staff_id);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getLabTest(object $pdo): array {

    $query = "SELECT Test_id, Test_code, Test_name, Description, Cost FROM Tests";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getPatientsResult(object $pdo, string $Staff_id): array {

    $query = "SELECT Results.Result_id, Results.Report_url, Results.Interpretation, Results.Order_id
    FROM Results 
    LEFT OUTER JOIN Orders 
    ON Results.Order_id = Orders.Order_id 
    WHERE Orders.Staff_id = :Staff_id;";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Staff_id", $Staff_id);
    $stmt->execute();
    
    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}




function insertLabTest(object $pdo, string $Test_code, string $Test_name, string $Description, float $Cost) {

    $query = "INSERT INTO Tests (Test_code, Test_name, Description, Cost) VALUES (:Test_code, :Test_name, :Description, :Cost);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":Test_code", $Test_code);
    $stmt->bindParam(":Test_name", $Test_name);
    $stmt->bindParam(":Description", $Description);
    $stmt->bindParam(":Cost", $Cost);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}
function deleteLabTest(object $pdo, int $rowIndex) {

    $query = "DELETE FROM Tests WHERE Test_id = :rowIndex;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":rowIndex", $rowIndex);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}



function insertPatientResult(object $pdo, string $Report_url, string $Interpretation, int $Order_id) {

    $query = "INSERT INTO Results (Report_url, Interpretation, Order_id) VALUES (:Report_url, :Interpretation, :Order_id);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":Report_url", $Report_url);
    $stmt->bindParam(":Interpretation", $Interpretation);
    $stmt->bindParam(":Order_id", $Order_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;

}
// function insertPatientResult(object $pdo, string $Report_url, string $Interpretation) {

//     $query = "INSERT INTO Results (Report_url, Interpretation) VALUES (:Report_url, :Interpretation);";
    
//     //prevent SQL injection
//     $stmt = $pdo->prepare($query);


//     $stmt->bindParam(":Report_url", $Report_url);
//     $stmt->bindParam(":Interpretation", $Interpretation);

//     $stmt->execute();

//     $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
//     return $result;

// }
function deletePatientResult(object $pdo, int $rowIndex) {

    $query = "DELETE FROM Results WHERE Result_id = :rowIndex;";
    
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