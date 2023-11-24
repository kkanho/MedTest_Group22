<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$rowIndexSet = isset($_POST["billingRowIndex"]);
$dataToBilling = isset($_POST["Patient_name"]) || isset($_POST["Amount"]) || isset($_POST["Payment_Status"]) || isset($_POST["Insurance_Status"]) || isset($_POST["Order_id"]);

if ($getRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }
    try {
        
        require_once '../dbh.inc.php';
        require_once 'secretariesM.inc.php';
        require_once 'secretariesV.inc.php';

        //Access patients results
        $result = getPatientsBilling($pdo);
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
if ($postRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }

    if ($rowIndexSet) {//delete data in the Billing table
        $rowIndex = htmlspecialchars($_POST["billingRowIndex"]);

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
                $_SESSION["errors_deleteBilling"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            deleteBilling($pdo, $rowIndex);
            header("Location: ../../index.php?deleteBilling=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
    }

    if ($dataToBilling) { {//insert data in the Billing table
        $Patient_name = htmlspecialchars($_POST["Patient_name"]);
        $Amount = htmlspecialchars($_POST["Amount"]);
        $Payment_Status = htmlspecialchars($_POST["Payment_Status"]);
        $Insurance_Status = htmlspecialchars($_POST["Insurance_Status"]);
        $Order_id = htmlspecialchars($_POST["Order_id"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'secretariesM.inc.php';
            require_once 'secretariesV.inc.php';
            require_once 'secretariesC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (isBillingInputEmpty($Patient_name, $Amount, $Payment_Status, $Insurance_Status, $Order_id)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for Adding Billing!';
            }
            if (!userFound($pdo, $Patient_name)) {
                $ERRORS["user_notFound"] = 'User not found!';
            }
            if (!orderIDFound($pdo, $Order_id)) {
                $ERRORS["order_id_notFound"] = 'Order ID not found!';
            }
            if (!isRowIndexInt($Order_id)) {
                $ERRORS["order_id_Not_Int"] = 'Order ID not Int!';
            } else {
                $Order_id = intval($Order_id);
            }

            
            if ($ERRORS) {
                $_SESSION["errors_insertBilling"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }

            $Patient_id = userFound($pdo, $Patient_name);

            insertBilling($pdo, $Amount, $Payment_Status, $Insurance_Status, $Order_id);
            header("Location: ../../index.php?insertBilling=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

            }  catch (PDOException $e) {
                die("Query error: " . $e->getMessage());
            }

        }
    }

}
backToHome();




function backToHome() {
    header("Location: ../../index.php");
    die();
}
