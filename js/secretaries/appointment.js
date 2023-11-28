$("#appointment_data_output_head").hide();

// $("#appointment").click(() => {
    $("#appointment_data_output_head").show();
    fetch("/includes/secretaries/appointment.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {

        let placeholder = document.querySelector("#appointment_data_output");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Appointment_id}">
                <th scope="row">${row.Appointment_id}</th>
                <td>${checkEmptyBlock(row.Sampling_type)}</td>
                <td>${checkEmptyBlock(row.Appointments_datetime)}</td>
                <td>${checkEmptyBlock(row.Patient_name)}</td>
                <td>${checkEmptyBlock(row.Email)}</td>
                <td>
                    <button class="btn btn-outline-danger w-100" id="${row.Appointment_id}" type="button" onclick="deleteAppointmentRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        $('#appointmentTable tr:last').after(`
            <tr>
                <td>#</td>
                <td><input type="text" class="form-control shadow-sm" placeholder="Test Type" name="Sampling_type" id="Sampling_type"></td>
                <td>
                    <input type="datetime-local" my-date-format="DD/MM/YYYY, hh:mm:ss" class="form-control shadow-sm" placeholder="some description" name="Appointments_datetime" id="Appointments_datetime">
                </td>
                <td><input type="text" class="form-control shadow-sm" placeholder="Patient Name" name="Patient_name" id="Patient_name"></td>
                <td colspan="2">
                    <button class="btn btn-outline-success w-100" id="appointment_newRow" type='submit' form="insertAppointment">Add</button>
                </td>
            </tr>
        `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })


function deleteAppointmentRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    let formData = new FormData();
    formData.append('appointmentRowIndex', id);
    fetch('/includes/secretaries/appointment.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // console.log(response.url);
        // alert("Remove Successful, refresh now")
        location.replace(response.url);
    });
}