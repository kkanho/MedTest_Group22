<?php 
//Access patients results
header("content-type:application/json");

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$isLabStaff = isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff";
$rowIndexSet = isset($_POST["rowIndex"]);
$dataToResultTable = isset($_POST["Report_url"]) || isset($_POST["Interpretation"]);

if ($getRequest) {
    if (!($isLogin && $isLabStaff)) {//make sure user is logged in and their role is lab_staff
        backToHome();
        return;
    }

    try {
        
        require_once '../dbh.inc.php';
        require_once 'lab_staffM.inc.php';
        require_once 'lab_staffV.inc.php';

        $result = getPatientsResult($pdo);

        echo json_encode($result);//echo the data allow fetching using JS

        //close the connection
        $pdo = null;
        $stmt = null;
        die();

    }  catch (PDOException $e) {
        die("Query error: " . $e->getMessage());
    }

}

if ($postRequest) { //Post request
    if (!($isLogin && $isLabStaff)) {//make sure user is logged in and their role is lab_staff
        backToHome();
        return;
    }
        
    if($rowIndexSet) {//delete data in the results table
        $rowIndex = htmlspecialchars($_POST["rowIndex"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'lab_staffM.inc.php';
            require_once 'lab_staffV.inc.php';
            require_once 'lab_staffC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (!isRowIndexInt($rowIndex)) {
                $ERRORS["row_Index_Not_Int"] = 'Incorrect row index!';
            } else {
                $rowIndex = intval($rowIndex);
            }

            if ($ERRORS) {
                $_SESSION["errors_deletePatientResult"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            deletePatientResult($pdo, $rowIndex);
            header("Location: ../../index.php?deletePatientResult=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }

    }
    if ($dataToResultTable) {//insert data in the result table
        $Report_url = htmlspecialchars($_POST["Report_url"]);
        $Interpretation = htmlspecialchars($_POST["Interpretation"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'lab_staffM.inc.php';
            require_once 'lab_staffV.inc.php';
            require_once 'lab_staffC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (isPRInputEmpty($Report_url, $Interpretation)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for Adding result!';
            }
            if (!isURL($Report_url)) {
                $ERRORS["not_url"] = 'Please input a valid url!';
            }

            if ($ERRORS) {
                $_SESSION["errors_insertPatientResult"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            insertPatientResult($pdo, $Report_url, $Interpretation);
            header("Location: ../../index.php?insertPatientResult=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }

    } 
}
backToHome();

function backToHome() {
    header("Location: ../../index.php");
    die();
}
