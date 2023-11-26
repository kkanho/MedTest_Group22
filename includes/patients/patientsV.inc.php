<?php

function patientPersonalInfo() {
    
    echo '
        <a id="patientData_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <table class="table table-striped table-hover mt-3">
                    <thead id="patient_info_data_output_head">
                        <tr class="col-6 col-md-2">
                            <th colspan="6" class="w-100 text-bg-info text-lg-center" id="patientData">Personal Data</th>
                        </tr>
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
function patientTestOrder() {
    
    echo '
        <a id="testOrder_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <table class="table table-striped table-hover mt-3">
                    <thead id="patient_test_order_data_output_head">
                        <tr class="col-6 col-md-2">
                            <th colspan="3" class="w-100 text-bg-info text-lg-center" id="patientTestOrder">Test Order</th>
                        </tr>
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
function patientTestResult() {
    
    echo '
        <a id="testResult_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <table class="table table-striped table-hover mt-3">
                <thead id="patient_test_result_data_output_head">
                    <tr class="col-6 col-md-2">
                        <th colspan="4" class="w-100 text-bg-info text-lg-center" id="patientTestResult">Test result</th>
                    </tr>
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
function patientBill() {
    
    echo '
        <a id="bill_section"></a><br><br><br>
        <div class="row pt-4">
            <div class="col-12 table-responsive card">
                <table class="table table-striped table-hover mt-3">
                    <thead id="bill_data_output_head">
                        <tr class="col-6 col-md-2">
                            <th colspan="4" class="w-100 text-bg-info text-lg-center" id="patientBill">Patient Bill</th>
                        </tr>
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