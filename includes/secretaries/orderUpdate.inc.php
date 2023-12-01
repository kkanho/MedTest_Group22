<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$dataToOrderUpdate = isset($_POST["Order_date"]) || isset($_POST["Status"]) || isset($_POST["Patient_name"]) || isset($_POST["Staff_name"]) || isset($_POST["Test_id"]) || isset($_Post["Order_id_update"]);


if ($postRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }

    if ($dataToOrderUpdate) { //update data in the Order table else {
        $Order_id = htmlspecialchars($_POST["Order_id_update"]);
        $Order_date = htmlspecialchars($_POST["Order_date"]);
        $Status = htmlspecialchars($_POST["Status"]);
        $Patient_name = htmlspecialchars($_POST["Patient_name"]);
        $Staff_name = htmlspecialchars($_POST["Staff_name"]);
        $Test_id = htmlspecialchars($_POST["Test_id"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'secretariesM.inc.php';
            require_once 'secretariesV.inc.php';
            require_once 'secretariesC.inc.php';
            
            //Handle errors
            $ERRORS = [];
            
            if (isOrderInputEmpty($Order_date, $Status, $Patient_name, $Staff_name)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for update Order!';
            }
            // if (!orderFound($pdo, $Patient_name)) {}
            if (!userFound($pdo, $Patient_name)) {
                $ERRORS["patient_notFound"] = 'Patient not found!';
            }
            if (!staffFound($pdo, $Staff_name)) {
                $ERRORS["staff_notFound"] = 'Staff not found!';
            }
            if (isset($Test_id) && $Test_id != '') {
                if (!isRowIndexInt($Test_id)) {
                    $ERRORS["Test_id_Not_Int"] = 'Test ID not Int!';
                } else {
                    $Test_id = intval($Test_id);
                }
                if (!testIDFound($pdo, $Test_id)) {
                    $ERRORS["test_notFound"] = 'Test not found!';
                }
            }
            
            if ($ERRORS) {
                $_SESSION["errors_updateOrder"] = $ERRORS;
    
                backToHome();
                die();
            }

            updateOrder($pdo, $Order_id, $Order_date, $Status, $Patient_name, $Staff_name, $Test_id);
            header("Location: ../../index.php?updateOrder=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        } catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        } 
    } else {
        $ERRORS = [];
        $ERRORS["Update_Fail"] = 'Wrong input!';
        $_SESSION["errors_updateOrder"] = $ERRORS;
        die();
    }
}

backToHome();


function backToHome() {
    header("Location: ../../index.php");
    die();
}
