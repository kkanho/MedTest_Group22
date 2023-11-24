<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$isLabStaff = isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff";
$rowIndexSet = isset($_POST["rowIndex"]);
$dataToLabTest = isset($_POST["Test_code"]) || isset($_POST["Test_name"]) || isset($_POST["Description"]) || isset($_POST["Cost"]);


if ($getRequest) {
    if (!($isLogin && $isLabStaff)) {//make sure user is logged in and their role is lab_staff
        backToHome();
        return;
    } 

    try {
        
        require_once '../dbh.inc.php';
        require_once 'lab_staffM.inc.php';
        require_once 'lab_staffV.inc.php';

        //Access all lab test
        $result = getLabTest($pdo);
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

if ($postRequest) { //Post request
    if (!($isLogin && $isLabStaff)) {//make sure user is logged in and their role is lab_staff
        backToHome();
        return;
    }

    if ($rowIndexSet) {//delete data in the lab test table
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
                $_SESSION["errors_deleteLabTest"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            deleteLabTest($pdo, $rowIndex);
            header("Location: ../../index.php?deleteLabTest=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
    }
    
    if ($dataToLabTest) { {//insert data in the lab test table
        $Test_code = htmlspecialchars($_POST["Test_code"]);
        $Test_name = htmlspecialchars($_POST["Test_name"]);
        $Description = htmlspecialchars($_POST["Description"]);
        $Cost = htmlspecialchars($_POST["Cost"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'lab_staffM.inc.php';
            require_once 'lab_staffV.inc.php';
            require_once 'lab_staffC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (isInputEmpty($Test_code, $Test_name, $Description, $Cost)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for Adding Lab Test!';
            }
            if (!isCostFloat($Cost)) {
                $ERRORS["cost_not_float"] = 'Please input numbers in cost field!';
            } else {
                $Cost = floatval($Cost);
            }

            if ($ERRORS) {
                $_SESSION["errors_insertLabTest"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            insertLabTest($pdo, $Test_code, $Test_name, $Description, $Cost);
            header("Location: ../../index.php?insertLabTest=success"); //redirect

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
