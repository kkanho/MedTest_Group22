<?php   //Interact with Database

declare(strict_types=1);

function getAppointment(object $pdo): array {

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

    $query = "SELECT Result_id, Report_url, Interpretation, Order_id, Staff_id FROM Results";

    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}