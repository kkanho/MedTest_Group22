<?php 

declare(strict_types=1);

function checkLoginErrors() {
    if (isset($_SESSION["errors_login"])) { //Errors
        $errors = $_SESSION["errors_login"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }
        unset($_SESSION["errors_login"]);
    } else if(isset($_GET["login"])  && $_GET["login"] === "success") {
        echo '<div class="form-error text-success mb-2">Login successful!</div>';
    }
}

function ErrorsInLogin(): bool {
    if (isset($_SESSION["errors_login"])) { //Errors
        return true;
    }  else {
        return false;
    }
}

function promptUsername() {
    if(isset($_SESSION["user_id"])) {
        echo '<div class="me-2">You are now logged in as ' . $_SESSION["user_username"] . '[' . $_SESSION["role"] . ']' . '</div>';
    } else {
        echo '<div class="me-2">Please login!</div>';
    }
}