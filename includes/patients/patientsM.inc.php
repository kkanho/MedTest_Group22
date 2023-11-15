<?php   //Interact with Database

declare(strict_types=1);

function getUser(object $pdo, string $username): array {

    $query = "SELECT Patient_id, Patient_name, Email, Created_at FROM Patients WHERE Patient_name = :username;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = [];

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}