<?php

function patientsSamplingType() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="samplingType">Patients Sampling Type</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table" id="patientsSamplingTable">
                        <thead id="sampling_type_data_output_head">
                            <tr>
                                <th scope="col">Appointment ID</th>
                                <th scope="col">Sampling Type</th>
                                <th scope="col">Datetime</th>
                                <th scope="col">Patient Name</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="sampling_type_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript" src="./js/labStaff_js/patientsSamplingType.js"></script>
        ';
    }
}
function labTest() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="labTest">Lab Test</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <form action="includes/labStaff/labTest.inc.php" method="post" id="insertLabTest">
                        <table class="table" id="labTestTable">
                            <thead id="lab_test_head">
                                <tr>
                                    <th scope="col">Test ID</th>
                                    <th scope="col">Test Code</th>
                                    <th scope="col">Test Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="lab_test">

                            </tbody>

                        </table>
                    </form>
                </div>

            </div>
            <div class="row pt-4">
                
            </div>
            <script type="text/javascript" src="./js/labStaff_js/labTest.js"></script>
        ';
    }
}
function patientsResults() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientsResults">Patients Result</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <form action="includes/labStaff/patientsResults.inc.php" method="post" id="insertPatientResult">
                        <table class="table" id="patientsResultsTable">
                            <thead id="patients_results_head">
                                <tr>
                                    <th scope="col">Result ID</th>
                                    <th scope="col">Report URL</th>
                                    <th scope="col">Interpretation</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="patients_results">

                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <script type="text/javascript" src="./js/labStaff_js/patientsResult.js"></script>
        ';
    }
}



function checkInsertLabTestErrors() {
    if (isset($_SESSION["errors_insertLabTest"])) {
        $errors = $_SESSION["errors_insertLabTest"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_insertLabTest"]);
    } else if(isset($_GET["insertLabTest"])  && $_GET["insertLabTest"] === "success") {
        echo '<div class="form-error text-success mb-2">Add Lab Test successful!</div>';
    }
}
function checkDeleteLabTestErrors() {
    if (isset($_SESSION["errors_deleteLabTest"])) {
        $errors = $_SESSION["errors_deleteLabTest"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_deleteLabTest"]);
    } else if(isset($_GET["deleteLabTest"])  && $_GET["deleteLabTest"] === "success") {
        echo '<div class="form-error text-success mb-2">Delete Lab Test successful!</div>';
    }
}

function checkInsertPatientResultErrors() {
    if (isset($_SESSION["errors_insertPatientResult"])) {
        $errors = $_SESSION["errors_insertPatientResult"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_insertPatientResult"]);
    } else if(isset($_GET["insertPatientResult"])  && $_GET["insertPatientResult"] === "success") {
        echo '<div class="form-error text-success mb-2">Insert patient result successful!</div>';
    }
}
function checkDeletePatientResultErrors() {
    if (isset($_SESSION["errors_deletePatientResult"])) {
        $errors = $_SESSION["errors_deletePatientResult"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_deletePatientResult"]);
    } else if(isset($_GET["deletePatientResult"])  && $_GET["deletePatientResult"] === "success") {
        echo '<div class="form-error text-success mb-2">Delete patient result successful!</div>';
    }
}




// function checkDeleteSamplingTypeErrors() {
//     if (isset($_SESSION["errors_deleteSamplingType"])) {
//         $errors = $_SESSION["errors_deleteSamplingType"];

//         foreach ($errors as $error) {
//             echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
//         }

//         unset($_SESSION["errors_deleteSamplingType"]);
//     } else if(isset($_GET["deleteSamplingType"])  && $_GET["deleteSamplingType"] === "success") {
//         echo '<div class="form-error text-success mb-2">Delete Sampling Type successful!</div>';
//     }
// }