<?php

function patientPersonalInfo() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientData">Patient personal data</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="patient_info_data_output_head">
                            <tr>
                                <th scope="col">Patient_id</th>
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
            <script type="text/javascript">
                $("#patient_info_data_output_head").hide();

                $("#patientData").click(() => {
                    $("#patient_info_data_output_head").show();
                    fetch("/includes/patients/personalData.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        
                        let placeholder = document.querySelector("#patient_info_data_output");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th scope="row">${row.Patient_id}</th>
                                <td>${checkEmptyBlock(row.Patient_name)}</td>
                                <td>${checkEmptyBlock(row.Email)}</td>
                                <td>${checkEmptyBlock(row.DOB)}</td>
                                <td>${checkEmptyBlock(row.Insurance)}</td>
                                <td>${checkEmptyBlock(row.Created_at)}</td>
                            </tr>`;
                        }
                        placeholder.innerHTML = out;
                    })
                    .catch (e => {
                        console.log("Error:", e)
                    });
                })
            </script>
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
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="patient_test_order_data_output_head">
                            <tr>
                                <th scope="col">Order_id</th>
                                <th scope="col">Order_date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="patient_test_order_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#patient_test_order_data_output_head").hide();

                $("#patientTestOrder").click(() => {
                    $("#patient_test_order_data_output_head").show();
                    fetch("/includes/patients/testOrder.inc.php")
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            
                            let placeholder = document.querySelector("#patient_test_order_data_output");
                            let out = "";
                            for(let row of data){
                                out += `<tr>
                                    <th scope="row">${checkEmptyBlock(row.Order_id)}</th>
                                    <td>${checkEmptyBlock(row.Order_date)}</td>
                                    <td>${checkEmptyBlock(row.Status)}</td>
                                </tr>`;
                            }
                            placeholder.innerHTML = out;
                        })
                        .catch (e => {
                            console.log("Error:", e)
                        });
                })
            </script>
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
                <div class="col-12 col-md-10">
                    <table class="table">
                    <thead id="patient_test_result_data_output_head">
                        <tr>
                            <th scope="col">Result_id</th>
                            <th scope="col">Report_url</th>
                            <th scope="col">Interpretation</th>
                            <th scope="col">Staff_id</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="patient_test_result_data_output">

                    </tbody>
                </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#patient_test_result_data_output_head").hide();

                $("#patientTestResult").click(() => {
                    $("#patient_test_result_data_output_head").show();
                    fetch("/includes/patients/testResult.inc.php")
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
                            
                            let placeholder = document.querySelector("#patient_test_result_data_output");
                            let out = "";
                            for(let row of data){
                                out += `<tr>
                                    <th scope="row">${checkEmptyBlock(row.Result_id)}</th>
                                    <td><a href="${row.Report_url}">${checkEmptyBlock(row.Report_url)}</a></td>
                                    <td>${checkEmptyBlock(row.Interpretation)}</td>
                                    <td>${checkEmptyBlock(row.Staff_id)}</td>
                                </tr>`;
                            }
                            placeholder.innerHTML = out;
                        })
                        .catch (e => {
                            console.log("Error:", e)
                        });
                })
            </script>
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
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="bill_data_output_head">
                            <tr>
                                <th scope="col">Billing_id</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment_Status</th>
                                <th scope="col">Insurance_Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="bill_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#bill_data_output_head").hide();

                $("#patientBill").click(() => {
                    $("#bill_data_output_head").show();
                    fetch("/includes/patients/bill.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        
                        let placeholder = document.querySelector("#bill_data_output");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th scope="row">${row.Billing_id}</th>
                                <td>${checkEmptyBlock(row.Amount)}</td>
                                <td>${checkEmptyBlock(row.Payment_Status)}</td>
                                <td>${checkEmptyBlock(row.Insurance_Status)}</td>
                            </tr>`;
                        }
                        placeholder.innerHTML = out;
                    })
                    .catch (e => {
                        console.log("Error:", e)
                    });
                })
            </script>
        ';
    }
}