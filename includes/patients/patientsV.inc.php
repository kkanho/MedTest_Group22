<?php

function showPatientInfo() {
    echo '
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
}