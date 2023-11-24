<?php 

session_start();//get server session data

$getRequest = $_SERVER["REQUEST_METHOD"] === "GET";
$postRequest = $_SERVER["REQUEST_METHOD"] === "POST";
$isLogin = isset($_SESSION["user_id"]);
$secretaries = isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries";
$rowIndexSet = isset($_POST["appointmentRowIndex"]);
$dataToAppointment = isset($_POST["Sampling_type"]) || isset($_POST["Appointments_datetime"]) || isset($_POST["Patient_name"]);

if ($getRequest) {
    if (!($isLogin && $secretaries)) {//make sure user is logged in and their role is secretaries
        backToHome();
    }
    try {
        
        require_once '../dbh.inc.php';
        require_once 'secretariesM.inc.php';
        require_once 'secretariesV.inc.php';

        //Access patients appointments
        $result = getAppointment($pdo);
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

    if ($rowIndexSet) {//delete data in the appointment table
        $rowIndex = htmlspecialchars($_POST["appointmentRowIndex"]);

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
                $_SESSION["errors_deleteAppointment"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }
            
            deleteAppointment($pdo, $rowIndex);
            header("Location: ../../index.php?deleteAppointment=success"); //redirect

            //close the connection
            $pdo = null;
            $stmt = null;
            die();

        }  catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
    }

    if ($dataToAppointment) { {//insert data in the appointment table
        $Sampling_type = htmlspecialchars($_POST["Sampling_type"]);
        $Appointments_datetime = htmlspecialchars($_POST["Appointments_datetime"]);
        $Patient_name = htmlspecialchars($_POST["Patient_name"]);

        try {
            
            require_once '../dbh.inc.php';
            require_once 'secretariesM.inc.php';
            require_once 'secretariesV.inc.php';
            require_once 'secretariesC.inc.php';

            //Handle errors
            $ERRORS = [];
            
            if (isInputEmpty($Sampling_type, $Appointments_datetime, $Patient_name)) {
                $ERRORS["empty_input"] = 'Please fill in all the required fields for Adding Appointment!';
            }
            if (!userFound($pdo, $Patient_name)) {
                $ERRORS["user_notFound"] = 'User not found!';
            }
            
            if ($ERRORS) {
                $_SESSION["errors_insertAppointment"] = $ERRORS;
    
                header("Location: ../../index.php");
                die();
            }

            $Patient_id = userFound($pdo, $Patient_name);
            
            insertAppointment($pdo, $Sampling_type, $Appointments_datetime, $Patient_id);
            header("Location: ../../index.php?insertAppointment=success"); //redirect

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
