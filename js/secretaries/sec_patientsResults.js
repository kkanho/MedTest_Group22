$("#sec_patients_results_head").hide();

// $("#sec_patientsResults").click(() => {
    $("#sec_patients_results_head").show();
    fetch("/includes/secretaries/sec_patientsResults.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {

        let placeholder = document.querySelector("#sec_patients_results");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Result_id}">
                <th scope="row">${row.Result_id}</th>
                <td><a href="${checkEmptyBlock(row.Report_url)}">${checkEmptyBlock(row.Report_url)}</a></td>
                <td>${checkEmptyBlock(row.Interpretation)}</td>
                <td>${checkEmptyBlock(row.Order_id)}</td>
                <td>${checkEmptyBlock(row.Staff_name)} [${checkEmptyBlock(row.Position)}]</td>
                <td>${checkEmptyBlock(row.Email)}</td>
                <td>
                    <button class="btn btn-outline-danger w-100" id="${row.Result_id}" type="button" onclick="deleteResultRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        // $('#resultTable tr:last').after(`
        //     <tr>
        //         <td>#</td>
        //         <td><input type="text" class="form-control shadow-sm" placeholder="URL" name="Report_url" id="Report_url"></td>
        //         <td><input type="text" class="form-control shadow-sm" placeholder="Interpretation" name="Interpretation" id="Interpretation"></td>
        //         <td><input type="text" class="form-control shadow-sm" placeholder="" name="Order_id" id="Order_id"></td>
        //         <td><input type="text" class="form-control shadow-sm" placeholder="Staff Name" name="Staff_name" id="Staff_name"></td>
        //         <td colspan="2">
        //             <button class="btn btn-outline-success w-100" id="result_newRow" type='submit' form="insertResult">Add</button>
        //         </td>
        //     </tr>
        // `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })

function deleteResultRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    console.log(id)
    let formData = new FormData();
    formData.append('resultRowIndex', id);
    fetch('/includes/secretaries/sec_patientsResults.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {

        location.replace(response.url);
    });
}