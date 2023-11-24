$("#patient_info_data_output_head").hide();

// $("#patientData").click(() => {
    $("#patient_info_data_output_head").show();
    fetch("/includes/patients/personalData.inc.php")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            console.log(data);
            let placeholder = document.querySelector("#patient_info_data_output");
            let out = "";
            for (let row of data) {
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
        .catch(e => {
            console.log("Error:", e)
        });
// })