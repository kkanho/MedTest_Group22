<?php //Interact with Database

declare(strict_types=1);

function getEmail(object $pdo, string $email) {

    $query = "SELECT Email FROM Patients WHERE Email = :email;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}

function getUsername(object $pdo, string $username) {

    $query = "SELECT Patient_name FROM Patients WHERE Patient_name = :username;";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}

function setUser($pdo, $username, $password, $email) {

    $query = "INSERT INTO Patients (Patient_name, Encrypted_password, Email) VALUES (:username, :password, :email);";
    
    //prevent SQL injection
    $stmt = $pdo->prepare($query);

    //hash the password
    $options = [
        'cost' => 12
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);//get the first result
    return $result;
}