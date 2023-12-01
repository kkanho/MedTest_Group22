<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$rowIndexSet = isset($_POST["orderRowIndex"]);
$dataToOrder = isset($_POST["Order_date"]) || isset($_POST["Status"]) || isset($_POST["Patient_name"]) || isset($_POST["Staff_name"]) || isset($_POST["Test_id"]);
$update = isset($_Post["Order_id_update"]);

if ($getRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }
    try {
        
        require_once '../dbh.inc.php';
        require_once 'secretariesM.inc.php';
        require_once 'secretariesV.inc.php';

        //Access patients results
        $result = getOrder($pdo);
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
            $ERRORS["Deletion Fail"] = 'Unable to delete that row!';
            $_SESSION["errors_deleteOrder"] = $ERRORS;
            die("Query error: " . $e->getMessage());
        }
    }

    else if ($dataToOrder) { {//insert data in the Order table
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
            
            //Test_id is not required, it can be null when test report of the user is not generated by lab_staff yet
            if (isOrderInputEmpty($Order_date, $Status, $Patient_name, $Staff_name)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for Adding Order!';
            }
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
                $_SESSION["errors_insertOrder"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }

            insertOrder($pdo, $Order_date, $Status, $Patient_name, $Staff_name, $Test_id);
            header("Location: ../../index.php?insertOrder=success"); //redirect

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
