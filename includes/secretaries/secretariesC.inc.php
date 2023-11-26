<?php 

declare(strict_types=1);

//for Appointment
function isInputEmpty(string $Sampling_type, string $Appointments_datetime, string $Patient_name): bool {
    if (empty($Sampling_type) || empty($Appointments_datetime) || empty($Patient_name)) {
        return true;
    } else {
        return false;
    }
}


//for order
function isOrderInputEmpty(string $Order_date, string $Status, string $Patient_name, string $Staff_name): bool {
    if (empty($Order_date) || empty($Status) || empty($Patient_name) || empty($Staff_name)) {
        return true;
    } else {
        return false;
    }
}

//for result
function isResultInputEmpty(string $Report_url, string $Interpretation, string $Order_id, string $Staff_name): bool {
    if (empty($Report_url) || empty($Interpretation) || empty($Order_id) || empty($Staff_name)) {
        return true;
    } else {
        return false;
    }
}

//for Billing
function isBillingInputEmpty(string $Patient_name, string $Amount, string $Payment_Status, string $Insurance_Status, string $Order_id): bool {
    if (empty($Patient_name) || empty($Amount) || empty($Payment_Status) || empty($Insurance_Status) || empty($Order_id)) {
        return true;
    } else {
        return false;
    }
}
function orderIDFound(object $pdo, string $Order_id): bool {

    $row = getOrderID($pdo, $Order_id);
    
    if ($row) {
        return true;
    } else {
        return false;
    }
}
function testIDFound(object $pdo, string $Test_id): bool {

    $row = getTestID($pdo, $Test_id);
    
    if ($row) {
        return true;
    } else {
        return false;
    }
}


function userFound(object $pdo, string $Patient_name): bool {

    $row = getPatientUserID($pdo, $Patient_name);
    
    if ($row) {
        return true;
    } else {
        return false;
    }
}
function staffFound(object $pdo, string $Staff_name): bool {

    $row = getStaffUserID($pdo, $Staff_name);
    
    if ($row) {
        return true;
    } else {
        return false;
    }
}
function isRowIndexInt(string $rowIndex): bool {
    if (is_numeric($rowIndex)) {
        return true;
    } else {
        return false;
    }
}