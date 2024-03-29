<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$rowIndexSet = isset($_POST["resultRowIndex"]);
$dataToResult = isset($_POST["Report_url"]) || isset($_POST["Interpretation"]) || isset($_POST["Order_id"]) || isset($_POST["Staff_name"]);


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

    if ($rowIndexSet) {//delete data in the Result table
        $rowIndex = htmlspecialchars($_POST["resultRowIndex"]);

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
                $_SESSION["errors_deleteResult"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            deleteResult($pdo, $rowIndex);
            header("Location: ../../index.php?deleteResult=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
    }

    if ($dataToResult) { {//insert data in the Result table
        $Report_url = htmlspecialchars($_POST["Report_url"]);
        $Interpretation = htmlspecialchars($_POST["Interpretation"]);
        $Order_id = htmlspecialchars($_POST["Order_id"]);
        $Staff_name = htmlspecialchars($_POST["Staff_name"]);


        try {
            
            require_once '../dbh.inc.php';
            require_once 'secretariesM.inc.php';
            require_once 'secretariesV.inc.php';
            require_once 'secretariesC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (isResultInputEmpty($Report_url, $Interpretation, $Order_id, $Staff_name)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for Adding Result!';
            }
            if (!orderIDFound($pdo, $Order_id)) {
                $ERRORS["order_id_notFound"] = 'Order ID not found!';
            }
            if (!isRowIndexInt($Order_id)) {
                $ERRORS["order_id_Not_Int"] = 'Order ID not Int!';
            } else {
                $Order_id = intval($Order_id);
            }
            if (!staffFound($pdo, $Staff_name)) {
                $ERRORS["staff_notFound"] = 'Staff not found!';
            }

            
            if ($ERRORS) {
                $_SESSION["errors_insertResult"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }

            insertResult($pdo, $Report_url, $Interpretation, $Order_id, $Staff_name);
            header("Location: ../../index.php?insertResult=success"); //redirect

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
