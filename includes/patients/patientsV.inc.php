<?php

function patientPersonalInfo() {
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "patient") {
        echo '
            <button class="btn btn-outline-primary mt-4 mb-4" id="usersData">Fetch data</button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Day of Birth</th>
                        <th scope="col">Insurance</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody id="data-output">

                </tbody>
            </table>
        ';
    } else {
        echo 'You are not patient!';
    }
}