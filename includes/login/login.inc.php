<?php //login form handler

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $role = htmlspecialchars($_POST["role"]);

    try {
        
        require_once '../dbh.inc.php';
        require_once 'loginM.inc.php';
        require_once 'loginV.inc.php';
        require_once 'loginC.inc.php';

        //Handle errors
        $ERRORS = [];

        if (isInputEmpty($username, $password)) {
            $ERRORS["empty_input"] = 'Please fill in all the required fields!';
        }

        //role checking
        if ($role === '1') {
            $result = getPatientUser($pdo, $username); //getUser from patients table
        } else if ($role === '2') {
            $result = getStaffUser($pdo, $username); //getUser from staff table
        } else {
            $result = '';
        }
        
        if (isUsernameWrong($result)) {
            $ERRORS["login_incorrect"] = "Incorrect login!";
        }
        if (!isUsernameWrong($result) && isPasswordWrong($password, $result["Encrypted_password"])) {
            $ERRORS["login_incorrect"] = "Incorrect login!";
        }
        
        require_once '../config_session.inc.php';
        if ($ERRORS) {
            $_SESSION["errors_login"] = $ERRORS;

            header("Location: ../../index.php");
            die();
        }

        //generate session with id
        // $newSessionID = session_create_id();
        // $sessionID = $newSessionID . "_" . $result["user_id"];
        // session_id($sessionID);

        if ($role === '1') { //sign in the user [role = patients]
            $_SESSION["user_id"] = $result["Patient_id"];
            $_SESSION["user_username"] = htmlspecialchars($result["Patient_name"]);
            $_SESSION["role"] = 'patient';
            $_SESSION["lastGen"] = time();
        } else if ($role === '2') { //sign in the user [role = staff]
            $_SESSION["user_id"] = $result["Staff_id"];
            $_SESSION["user_username"] = htmlspecialchars($result["Staff_name"]);
            $_SESSION["role"] = htmlspecialchars($result["Position"]);
            $_SESSION["lastGen"] = time();
        }
        header("Location: ../../index.php?login=success");

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