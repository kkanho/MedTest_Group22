<?php   //Signup form handler

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = htmlspecialchars($_POST["email"]);
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    try {
        
        require_once '../dbh.inc.php';
        require_once 'signupM.inc.php';
        require_once 'signupV.inc.php';
        require_once 'signupC.inc.php';

        //Handle errors
        $ERRORS = [];

        if (isInputEmpty($username, $password, $email)) {
            $ERRORS["empty_input"] = 'Please fill in all the required fields!';
        }
        if (isUsernameTaken($pdo, $username)) {
            $ERRORS["username_taken"] = 'Username have been taken!';
        }
        if (isEmailInvalid($email)) {
            $ERRORS["invalid_email"] = 'Invalid email!';
        }
        if (isEmailRegistered($pdo, $email)) {
            $ERRORS["email_registered"] = 'Email already registered!';
        }
        
        require_once '../config_session.inc.php';
        if ($ERRORS) {
            $_SESSION["errors_signup"] = $ERRORS;

            //keep users input if they have wrong inputs
            $signupData = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../../index.php");
            die();
        }

        //Create the user
        createUser($pdo, $username, $password, $email);
        header("Location: ../../index.php?signup=success"); //redirect
        
        //close the connection
        $pdo = null;
        $stmt = null;
        die();

    }  catch (PDOException $e) {
        die("Query error: " . $e->getMessage());
    }

} else {
    header("Location: ../../index.php");
    die();
}
