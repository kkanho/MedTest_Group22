<?php

function patientsAppointment() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="appointment">All appointment</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="appointment_data_output_head">
                            <tr>
                                <th scope="col">Appointment_id</th>
                                <th scope="col">Sampling_type</th>
                                <th scope="col">Appointments_datetime</th>
                                <th scope="col">Patient_id</th>
                                <th scope="col">Patient_name</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="appointment_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#appointment_data_output_head").hide();

                $("#appointment").click(() => {
                    $("#appointment_data_output_head").show();
                    fetch("/includes/secretaries/appointment.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        console.log(data);
                        let placeholder = document.querySelector("#appointment_data_output");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th style="vertical-align: middle !important;" scope="row">${row.Appointment_id}</th>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Sampling_type)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Appointments_datetime)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Patient_id)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Patient_name)}</td>
                                <td>
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </td>
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
function patientsBilling() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="billing">All Billing</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="billing_data_output_head">
                            <tr>
                                <th scope="col">Billing_id</th>
                                <th scope="col">Patient_name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment_Status</th>
                                <th scope="col">Insurance_Status</th>
                                <th scope="col">Order_id</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="billing_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#billing_data_output_head").hide();

                $("#billing").click(() => {
                    $("#billing_data_output_head").show();
                    fetch("/includes/secretaries/billing.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        console.log(data);
                        let placeholder = document.querySelector("#billing_data_output");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th style="vertical-align: middle !important;" scope="row">${row.Billing_id}</th>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Patient_name)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Amount)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Payment_Status)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Insurance_Status)}</td>
                                <td style="vertical-align: middle !important;">${checkEmptyBlock(row.Order_id)}</td>
                                <td>
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </td>
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
function sec_PatientsResults() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "secretaries") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="sec_patientsResults">Patients Result</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="sec_patients_results_head">
                            <tr>
                                <th scope="col">Result_id</th>
                                <th scope="col">Report_url</th>
                                <th scope="col">Interpretation</th>
                                <th scope="col">Order_id</th>
                                <th scope="col">Staff_id</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="sec_patients_results">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#sec_patients_results_head").hide();

                $("#sec_patientsResults").click(() => {
                    $("#sec_patients_results_head").show();
                    fetch("/includes/secretaries/sec_PatientsResults.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        
                        let placeholder = document.querySelector("#sec_patients_results");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th scope="row">${row.Result_id}</th>
                                <td>${checkEmptyBlock(row.Report_url)}</td>
                                <td>${checkEmptyBlock(row.Interpretation)}</td>
                                <td>${checkEmptyBlock(row.Order_id)}</td>
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