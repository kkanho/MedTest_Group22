$("#patients_results_head").hide();
$("#patientsResults_newRow").hide();

// $("#patientsResults").click(() => {
    $("#patients_results_head").show();
    $("#patientsResults_newRow").show();

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
                <td><a href="${checkEmptyBlock(row.Report_url)}">${checkEmptyBlock(row.Report_url)}</a></td>
                <td>${checkEmptyBlock(row.Interpretation)}</td>
                <td>${checkEmptyBlock(row.Order_id)}</td>
                <td>
                <button class="btn btn-outline-danger" id="${row.Result_id}" type='button' onclick="deletePatientResultRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        $('#patientsResultsTable tr:last').after(`
            <tr>
                <td>#</td>
                <td><input type="text" class="form-control" placeholder="https://github.com/kkanho" name="Report_url" id="Report_url"></td>
                <td><input type="text" class="form-control" placeholder="some interpretation" name="Interpretation" id="Interpretation"></td>
                <td colspan="2">
                    <button class="btn btn-outline-success w-100" id="patientsResults_newRow" type='submit' form="insertPatientResult">Add Result</button>
                </td>
            </tr>
        `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })

function deletePatientResultRow(row) {

    window.history.pushState(null, null, '/index.php');

    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    let formData = new FormData();
    formData.append('rowIndex', id);
    fetch('/includes/labStaff/patientsResults.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // console.log(response.url);
        // alert("Remove Successful, refresh now")
        location.replace(response.url);
    });
}