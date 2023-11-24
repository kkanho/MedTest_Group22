<?php   //Interact with Database

declare(strict_types=1);

function getPatientUser(object $pdo, string $username) {

    $query = "SELECT Patient_id, Patient_name, Encrypted_password FROM Patients WHERE Patient_name = :username;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}

function getStaffUser(object $pdo, string $username) {
    
    $query = "SELECT * FROM Staff WHERE Staff_name = :username;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}