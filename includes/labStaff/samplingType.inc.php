<?php 
//Access all appointments (sampling type)
header("content-type:application/json");

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$isLabStaff = isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff";

if ($getRequest) {
    if (!($isLogin && $isLabStaff)) {//make sure user is logged in and their role is lab_staff
        backToHome();
        return;
    }
        
    try {
        
        require_once '../dbh.inc.php';
        require_once 'lab_staffM.inc.php';
        require_once 'lab_staffV.inc.php';

        $result = getPatientsSamplingType($pdo);

        echo json_encode($result);//echo the data allow fetching using JS

        //close the connection
        $pdo = null;
        $stmt = null;
        die();

    }  catch (PDOException $e) {
        die("Query error: " . $e->getMessage());
    }

} 
backToHome();




function backToHome() {
    header("Location: ../../index.php");
    die();
}
