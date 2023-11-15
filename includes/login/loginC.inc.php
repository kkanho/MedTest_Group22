<?php

declare(strict_types=1);

function isInputEmpty(string $username, string $password):bool {
    if (empty($username) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

function isUsernameWrong($result):bool {
    if(!$result) {
        return true;
    } else {
        return false;
    }
}

function isPasswordWrong(string $password, string $hashedPassword):bool {

    if(!password_verify($password, $hashedPassword)) {
        return true;
    } else {
        return false;
    }
}