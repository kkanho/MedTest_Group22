<?php

function patientsSamplingType() {

    echo '
        <a id="sampling_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <table class="table table-striped table-hover mt-3" id="patientsSamplingTable">
                    <thead id="sampling_type_data_output_head">
                        <tr class="col-6 col-md-2">
                            <th colspan="4" class="w-100 text-bg-warning text-lg-center" id="samplingType">Orders</th>
                        </tr>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
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
function labTest() {

    echo '
        <a id="labTest_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <form action="includes/labStaff/labTest.inc.php" method="post" id="insertLabTest">
                    <table class="table table-striped table-hover mt-3" id="labTestTable">
                        <thead id="lab_test_head">
                            <tr class="col-6 col-md-2">
                                <th colspan="6" class="w-100 text-bg-warning text-lg-center" id="labTest">Lab Test</th>
                            </tr>
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
function patientsResults() {

    echo '
        <a id="patientsResult_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <form action="includes/labStaff/patientsResults.inc.php" method="post" id="insertPatientResult">
                    <table class="table table-striped table-hover mt-3" id="patientsResultsTable">
                        <thead id="patients_results_head">
                            <tr class="col-6 col-md-2">
                                <th colspan="6" class="w-100 text-bg-warning text-lg-center" id="patientsResults">Patients Result</th>
                            </tr>
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