<?php   //Interact with Database

declare(strict_types=1);

function getUserPersonalData(object $pdo, string $username): array {

    $aesKey = "GThKyaCpvHWlh9OW"; //128bit aes key

    $query = "SELECT AES_DECRYPT(Email, :aeskey) as Email, Patient_id, Patient_name, Created_at FROM Patients WHERE Patient_name = :username;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":aeskey", $aesKey);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getUserTestOrder(object $pdo, string $username): array {

    $query = "SELECT Orders.Order_id, Orders.Order_date, Orders.Status
    FROM Orders 
    JOIN Results
    ON Orders.Order_id = Results.Order_id
    WHERE Patient_id = (SELECT Patient_id FROM Patients WHERE Patient_name = :username);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getUserTestResult(object $pdo, string $username): array {

    $query = "SELECT Results.Result_id, Results.Report_url, Results.Interpretation, Staff.Staff_name 
    FROM Orders 
    JOIN Results
    ON Orders.Order_id = Results.Order_id
    JOIN Staff
    ON Results.Staff_id = Staff.Staff_id
    WHERE Patient_id = (SELECT Patient_id FROM Patients WHERE Patient_name = :username);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}

function getUserBill(object $pdo, string $username): array {

    $query = "SELECT Billing.Billing_id, Billing.Amount, Billing.Payment_Status, Billing.Insurance_Status 
    FROM Billing 
    JOIN Orders
    ON Billing.Order_id = Orders.Order_id
    WHERE Patient_id = (SELECT Patient_id FROM Patients WHERE Patient_name = :username);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}