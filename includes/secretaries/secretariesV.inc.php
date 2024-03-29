<?php

function patientsAppointment() {
    echo '
        <a id="appointment_section"></a><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card shadow bg-light">
            <form action="includes/secretaries/appointment.inc.php" method="post" id="insertAppointment">
                <table class="table table-striped table-hover mt-3" id="appointmentTable">
                    <thead id="appointment_data_output_head">
                        <tr class="col-6 col-md-2" id="appointment">
                            <th colspan="6" class="w-100 text-bg-primary text-lg-center">Appointment</th>
                        </tr>
                        <tr>
                            <th scope="col">Appointment ID</th>
                            <th scope="col">Sampling Type</th>
                            <th scope="col">Appointments Datetime</th>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Patient Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="appointment_data_output">

                    </tbody>
                </table>
            </form>
            </div>
        </div>
        <script type="text/javascript" src="./js/secretaries/appointment.js"></script>
    ';
}
function availableTest() {
    echo '
        <a id="test_section"></a><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card shadow bg-light">

                <table class="table table-striped table-hover mt-3" id="availableTestTable">
                    <thead id="availableTest_data_output_head">
                        <tr class="col-6 col-md-2" id="availableTest">
                            <th colspan="6" class="w-100 text-bg-primary text-lg-center">Test Available</th>
                        </tr>
                        <tr>
                            <th scope="col">Test ID</th>
                            <th scope="col">Test Code</th>
                            <th scope="col">Tests name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Cost</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="availableTest_data_output">

                    </tbody>
                </table>

            </div>
        </div>
        <script type="text/javascript" src="./js/secretaries/availableTest.js"></script>
    ';
}
function order() {
    
    echo '
        <a id="order_section"></a><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card shadow bg-light">
                <form action="includes/secretaries/order.inc.php" method="post" id="insertOrder">
                    <table class="table table-striped table-hover mt-3" id="orderTable">
                        <thead id="order_data_output_head">
                            <tr class="col-6 col-md-2" id="order">
                                <th colspan="8" class="w-100 text-bg-primary text-lg-center">Order</th>
                            </tr>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Staff Name [POS]</th>
                                <th scope="col">Test Id</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="order_data_output">

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="./js/secretaries/order.js"></script>
    ';
}
function sec_PatientsResults() {
    
    echo '
        <a id="patientsResult_section"></a><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card shadow bg-light">
                <form action="includes/secretaries/sec_patientsResults.inc.php" method="post" id="insertResult">
                    <table class="table table-striped table-hover mt-3" id="resultTable">
                        <thead id="sec_patients_results_head">
                            <tr class="col-6 col-md-2" id="sec_patientsResults">
                                <th colspan="7" class="w-100 text-bg-primary text-lg-center">Patients Result</th>
                            </tr>
                            <tr>
                                <th scope="col">Result ID</th>
                                <th scope="col">Report URL</th>
                                <th scope="col">Interpretation</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Staff Name [POS]</th>
                                <th scope="col">Staff Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="sec_patients_results">

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="./js/secretaries/sec_patientsResults.js"></script>
    ';
}
function patientsBilling() {
    
    echo '
        <a id="billing_section"></a><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card shadow bg-light">
                <form action="includes/secretaries/billing.inc.php" method="post" id="insertBilling">
                    <table class="table table-striped table-hover mt-3" id="billingTable">
                        <thead id="billing_data_output_head">
                        <tr class="col-6 col-md-2" id="billing">
                            <th colspan="7" class="w-100 text-bg-primary text-lg-center">Billing</th>
                        </tr>
                            <tr>
                                <th scope="col">Billing ID</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Insurance Status</th>
                                <th scope="col">Order ID</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="billing_data_output">

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="./js/secretaries/billing.js"></script>
    ';
}

function checkInsertAppointmentErrors() {
    if (isset($_SESSION["errors_insertAppointment"])) {
        $errors = $_SESSION["errors_insertAppointment"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_insertAppointment"]);
    } else if(isset($_GET["insertAppointment"])  && $_GET["insertAppointment"] === "success") {
        echo '<div class="form-error text-success mb-2">Insert appointment successful!</div>';
    }
}
function checkDeleteAppointmentErrors() {
    if (isset($_SESSION["errors_deleteAppointment"])) {
        $errors = $_SESSION["errors_deleteAppointment"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_deleteAppointment"]);
    } else if(isset($_GET["deleteAppointment"])  && $_GET["deleteAppointment"] === "success") {
        echo '<div class="form-error text-success mb-2">Delete appointment successful!</div>';
    }
}

function checkInsertOrderErrors() {
    if (isset($_SESSION["errors_insertOrder"])) {
        $errors = $_SESSION["errors_insertOrder"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_insertOrder"]);
    } else if(isset($_GET["insertOrder"])  && $_GET["insertOrder"] === "success") {
        echo '<div class="form-error text-success mb-2">Insert order successful!</div>';
    }
}
function checkDeleteOrderErrors() {
    if (isset($_SESSION["errors_deleteOrder"])) {
        $errors = $_SESSION["errors_deleteOrder"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_deleteOrder"]);
    } else if(isset($_GET["deleteOrder"])  && $_GET["deleteOrder"] === "success") {
        echo '<div class="form-error text-success mb-2">Delete order successful!</div>';
    }
}
function checkUpdateOrderErrors() {
    if (isset($_SESSION["errors_updateOrder"])) {
        $errors = $_SESSION["errors_updateOrder"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_updateOrder"]);
    } else if(isset($_GET["updateOrder"])  && $_GET["updateOrder"] === "success") {
        echo '<div class="form-error text-success mb-2">Update patient result successful!</div>';
    }
}

function checkInsertResultErrors() {
    if (isset($_SESSION["errors_insertResult"])) {
        $errors = $_SESSION["errors_insertResult"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_insertResult"]);
    } else if(isset($_GET["insertResult"])  && $_GET["insertResult"] === "success") {
        echo '<div class="form-error text-success mb-2">Insert patient result successful!</div>';
    }
}
function checkDeleteResultErrors() {
    if (isset($_SESSION["errors_deleteResult"])) {
        $errors = $_SESSION["errors_deleteResult"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_deleteResult"]);
    } else if(isset($_GET["deleteResult"])  && $_GET["deleteResult"] === "success") {
        echo '<div class="form-error text-success mb-2">Delete patient result successful!</div>';
    }
}

function checkInsertBillingErrors() {
    if (isset($_SESSION["errors_insertBilling"])) {
        $errors = $_SESSION["errors_insertBilling"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_insertBilling"]);
    } else if(isset($_GET["insertBilling"])  && $_GET["insertBilling"] === "success") {
        echo '<div class="form-error text-success mb-2">Insert billing successful!</div>';
    }
}
function checkDeleteBillingErrors() {
    if (isset($_SESSION["errors_deleteBilling"])) {
        $errors = $_SESSION["errors_deleteBilling"];

        foreach ($errors as $error) {
            echo '<div class="form-error text-danger mb-2">'. $error . '</div>';
        }

        unset($_SESSION["errors_deleteBilling"]);
    } else if(isset($_GET["deleteBilling"])  && $_GET["deleteBilling"] === "success") {
        echo '<div class="form-error text-success mb-2">Delete billing successful!</div>';
    }
}