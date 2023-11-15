<?php //Interact with user's data (validation)

declare(strict_types=1);


function isInputEmpty(string $username, string $password, string $email): bool {
    if (empty($username) || empty($password) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function isUsernameTaken(object $pdo, string $username): bool {
    if (getUsername($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

function isEmailInvalid(string $email): bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function isEmailRegistered(object $pdo, string $email): bool {
    if (getEmail($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function createUser(object $pdo, string $username, string $password, string $email) {
    setUser($pdo, $username, $password, $email);
}
