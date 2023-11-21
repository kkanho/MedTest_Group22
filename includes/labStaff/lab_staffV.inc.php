<?php

function patientsSamplingType() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="samplingType">Patients Sampling Type</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="sampling_type_data_output_head">
                            <tr>
                                <th scope="col">Appointment_id</th>
                                <th scope="col">Sampling_type</th>
                                <th scope="col">Appointments_datetime</th>
                                <th scope="col">Patient_id</th>
                                <th scope="col">Patient_name</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="sampling_type_data_output">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#sampling_type_data_output_head").hide();

                $("#samplingType").click(() => {
                    $("#sampling_type_data_output_head").show();
                    fetch("/includes/labStaff/samplingType.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        
                        let placeholder = document.querySelector("#sampling_type_data_output");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th scope="row">${row.Appointment_id}</th>
                                <td>${checkEmptyBlock(row.Sampling_type)}</td>
                                <td>${checkEmptyBlock(row.Appointments_datetime)}</td>
                                <td>${checkEmptyBlock(row.Patient_id)}</td>
                                <td>${checkEmptyBlock(row.Patient_name)}</td>
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
function labTest() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="labTest">Lab Test</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="lab_test_head">
                            <tr>
                                <th scope="col">Test_id</th>
                                <th scope="col">Test_code</th>
                                <th scope="col">Test_name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Cost</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="lab_test">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#lab_test_head").hide();

                $("#labTest").click(() => {
                    $("#lab_test_head").show();
                    fetch("/includes/labStaff/labTest.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        
                        let placeholder = document.querySelector("#lab_test");
                        let out = "";
                        for(let row of data){
                            out += `<tr>
                                <th scope="row">${row.Test_id}</th>
                                <td>${checkEmptyBlock(row.Test_code)}</td>
                                <td>${checkEmptyBlock(row.Test_name)}</td>
                                <td>${checkEmptyBlock(row.Description)}</td>
                                <td>${formatting.format(checkEmptyBlock(row.Cost))}</td>
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
function patientsResults() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "lab_staff") {
        echo '
            <div class="row pt-4">
                <div class="col-6 col-md-2">
                    <button class="btn btn-outline-primary mt-4 mb-4" id="patientsResults">Patients Result</button>
                </div>
                <div class="col-12 col-md-10">
                    <table class="table">
                        <thead id="patients_results_head">
                            <tr>
                                <th scope="col">Result_id</th>
                                <th scope="col">Report_url</th>
                                <th scope="col">Interpretation</th>
                                <th scope="col">Order_id</th>
                                <th scope="col">Staff_id</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="patients_results">

                        </tbody>
                    </table>
                </div>
            </div>
            <script type="text/javascript">
                $("#patients_results_head").hide();

                $("#patientsResults").click(() => {
                    $("#patients_results_head").show();
                    fetch("/includes/labStaff/patientsResults.inc.php")
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        
                        let placeholder = document.querySelector("#patients_results");
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
