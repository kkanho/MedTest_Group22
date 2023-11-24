<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$rowIndexSet = isset($_POST["patientsResultRowIndex"]);
$dataToPatientsResult = isset($_POST["Patient_name"]) || isset($_POST["Amount"]) || isset($_POST["Payment_Status"]) || isset($_POST["Insurance_Status"]) || isset($_POST["Order_id"]);


if ($getRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }
    try {
        
        require_once '../dbh.inc.php';
        require_once 'secretariesM.inc.php';
        require_once 'secretariesV.inc.php';

        //Access patients results
        $result = getSec_PatientsResults($pdo);
        header("content-type:application/json");
        echo json_encode($result);//echo the data allow fetching using JS

        //close the connection
        $pdo = null;
        $stmt = null;
        die();

    }  catch (PDOException $e) {
        die("Query error: " . $e->getMessage());
    }        
}

if($postRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }
}

backToHome();


function backToHome() {
    header("Location: ../../index.php");
    die();
}
