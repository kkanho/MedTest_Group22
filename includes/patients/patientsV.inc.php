<?php

function patientPersonalInfo() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientData">Patient personal data</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table">
                        <thead id="patient_info_data_output_head">
                            <tr>
                                <th scope="col">Patient ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Day of Birth</th>
                                <th scope="col">Insurance</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="patient_info_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript" src="./js/patient_js/patientPersonalInfo.js"></script>
        ';
    }
}
function patientTestOrder() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientTestOrder">Test order</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table">
                        <thead id="patient_test_order_data_output_head">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="patient_test_order_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript" src="./js/patient_js/patientTestOrder.js"></script>
        ';
    }
}
function patientTestResult() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientTestResult">Test result</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table">
                    <thead id="patient_test_result_data_output_head">
                        <tr>
                            <th scope="col">Result ID</th>
                            <th scope="col">Report URL</th>
                            <th scope="col">Interpretation</th>
                            <th scope="col">Staff Name</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="patient_test_result_data_output">

                    </tbody>
                </table>
                </div>
            </div>
            <script type="text/javascript" src="./js/patient_js/patientTestResult.js"></script>
        ';
    }
}
function patientBill() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientBill">Patient Bill</button>
                </div>
                <div class="col-12 col-md-10 table-responsive">
                    <table class="table">
                        <thead id="bill_data_output_head">
                            <tr>
                                <th scope="col">Billing Id</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Insurance Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="bill_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript" src="./js/patient_js/patientBill.js"></script>
        ';
    }
}