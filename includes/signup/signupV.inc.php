<?php   //Show data in the browser

declare(strict_types=1);


function checkSignupErrors() {
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_signup"]);
    } else if(isset($_GET["signup"])  && $_GET["signup"] === "success") {
        echo '<div class="form-error text-success mb-2">Signup successful! Please login</div>';
    }
};


function ErrorsInSignup(): bool {
    if (isset($_SESSION["errors_signup"])) { //Errors
        return true;
    }  else {
        return false;
    }
}

function signupInput() {

    if (isset($_SESSION["signup_data"]["username"])) {
        echo '
        <div class="form-floating mb-2">
            <input class="form-control shadow-sm" id="username" name="username" placeholder="Username">
            <label for="username value="' . $_SESSION["signup_data"]["username"] . '">Username</label>
        </div>';
    } else {
        echo '
        <div class="form-floating mb-2">
            <input class="form-control shadow-sm" id="username" name="username" placeholder="Username">
            <label for="username">Username</label>
        </div>';
    }

    echo '<div class="form-floating mb-2">
        <input class="form-control shadow-sm" id="password" name="password" placeholder="Password">
        <label for="password" class="form-label">Password</label>
    </div>';

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["invalid_email"]) && !isset($_SESSION["errors_signup"]["email_registered"])) {
        echo '
        <div class="form-floating mb-2">
            <input class="form-control shadow-sm" id="email" name="email" placeholder="Email">
            <label for="email" class="form-label" value="' . $_SESSION["signup_data"]["email"] . '">Email</label>
        </div>';
    } else {
        echo '
        <div class="form-floating mb-2">
            <input class="form-control shadow-sm" id="email" name="email" placeholder="Email">
            <label for="email" class="form-label">Email</label>
        </div>';
    }
}