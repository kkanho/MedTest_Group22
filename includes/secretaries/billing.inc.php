<?php 
//Access patients results
header("content-type:application/json");

session_start();//get server session data

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_SESSION["user_id"]) && isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries") {//make sure user is logged in and their role is secretaries
    
        try {
            
            require_once '../dbh.inc.php';
            require_once 'secretariesM.inc.php';
            require_once 'secretariesV.inc.php';

            $result = getPatientsBilling($pdo);

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
