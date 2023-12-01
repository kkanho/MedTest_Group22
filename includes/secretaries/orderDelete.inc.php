<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$rowIndexSet = isset($_POST["orderRowIndex"]);
$dataToOrder = isset($_POST["Order_date"]) || isset($_POST["Status"]) || isset($_POST["Patient_name"]) || isset($_POST["Staff_name"]) || isset($_POST["Test_id"]);
$update = isset($_Post["Order_id_update"]);


if ($postRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }

    if ($rowIndexSet) {//delete data in the Order table
        $rowIndex = htmlspecialchars($_POST["orderRowIndex"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'secretariesM.inc.php';
            require_once 'secretariesV.inc.php';
            require_once 'secretariesC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (!isRowIndexInt($rowIndex)) {
                $ERRORS["row_Index_Not_Int"] = 'Incorrect row index!';
            } else {
                $rowIndex = intval($rowIndex);
            }

            if ($ERRORS) {
                $_SESSION["errors_deleteOrder"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            deleteOrder($pdo, $rowIndex);
            header("Location: ../../index.php?deleteOrder=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            $ERRORS = [];
            $ERRORS["Deletion_Fail"] = 'Unable to delete that row!';
            $_SESSION["errors_deleteOrder"] = $ERRORS;

            die("Query error: " . $e->getMessage());
        }
    }
}
backToHome();

function backToHome() {
    header("Location: ../../index.php");
    die();
}