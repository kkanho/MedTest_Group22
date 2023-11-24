$("#sampling_type_data_output_head").hide();

// $("#samplingType").click(() => {
    $("#sampling_type_data_output_head").show();
    fetch("/includes/labStaff/samplingType.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        
        let placeholder = document.querySelector("#sampling_type_data_output");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Appointment_id}">
                <th scope="row">${row.Appointment_id}</th>
                <td>${checkEmptyBlock(row.Sampling_type)}</td>
                <td>${checkEmptyBlock(row.Appointments_datetime)}</td>
                <td>${checkEmptyBlock(row.Patient_name)}</td>
            </tr>`;

        }
        placeholder.innerHTML = out;
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })
