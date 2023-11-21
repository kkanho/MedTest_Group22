<?php   //Interact with Database

declare(strict_types=1);

function getPatientsSamplingType(object $pdo): array {

    $query = "SELECT Appointments.Appointment_id, Appointments.Sampling_type, Appointments.Appointments_datetime, Appointments.Patient_id, Patients.Patient_name
    FROM Appointments
    LEFT JOIN Patients
    ON Appointments.Patient_id = Patients.Patient_id";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

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
function getPatientsResult(object $pdo): array {

    $query = "SELECT Result_id, Report_url, Interpretation, Order_id, Staff_id FROM Results";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}