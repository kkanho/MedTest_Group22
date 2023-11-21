<?php   //patients personal data handler
//Access their personal data
header("content-type:application/json");

session_start();//get server session data

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_SESSION["user_id"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {//make sure user is logged in and their role is patient
    
        try {
            
            require_once '../dbh.inc.php';
            require_once 'patientsM.inc.php';
            require_once 'patientsV.inc.php';

            //Since user have already logged in, we can assess their username by session
            $username = $_SESSION["user_username"];

            $result = getUserPersonalData($pdo, $username);

            echo json_encode($result);//echo the data allow fetching using JS

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }

    } else {
        backToHome();
    }

} else {
    backToHome();
}

function backToHome() {
    header("Location: ../../index.php");
    die();
}
