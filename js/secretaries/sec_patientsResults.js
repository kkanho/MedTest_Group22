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
            out += `<tr>
                <th scope="row">${row.Result_id}</th>
                <td><a href="${checkEmptyBlock(row.Report_url)}">${checkEmptyBlock(row.Report_url)}</a></td>
                <td>${checkEmptyBlock(row.Interpretation)}</td>
                <td>${checkEmptyBlock(row.Order_id)}</td>
                <td>${checkEmptyBlock(row.Staff_name)}[${checkEmptyBlock(row.Position)}]</td>
                <td>${checkEmptyBlock(row.Email)}</td>
            </tr>`;
        }
        placeholder.innerHTML = out;
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })