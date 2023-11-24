$("#patient_test_result_data_output_head").hide();

// $("#patientTestResult").click(() => {
    $("#patient_test_result_data_output_head").show();
    fetch("/includes/patients/testResult.inc.php")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            console.log(data)
            let placeholder = document.querySelector("#patient_test_result_data_output");
            let out = "";
            for(let row of data){
                out += `<tr>
                    <th scope="row">${checkEmptyBlock(row.Result_id)}</th>
                    <td><a href="${row.Report_url}">${checkEmptyBlock(row.Report_url)}</a></td>
                    <td>${checkEmptyBlock(row.Interpretation)}</td>
                    <td>${checkEmptyBlock(row.Staff_name)}</td>
                </tr>`;
            }
            placeholder.innerHTML = out;
        })
        .catch (e => {
            console.log("Error:", e)
        });
// })