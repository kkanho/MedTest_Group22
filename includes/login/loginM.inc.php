<?php   //Interact with Database

declare(strict_types=1);

function getUser(object $pdo, string $username) {

    $query = "SELECT * FROM Patients WHERE Patient_name = :username;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}