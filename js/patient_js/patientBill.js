$("#bill_data_output_head").hide();

// $("#patientBill").click(() => {
    $("#bill_data_output_head").show();
    fetch("/includes/patients/bill.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        
        let placeholder = document.querySelector("#bill_data_output");
        let out = "";
        for(let row of data){
            out += `<tr>
                <th scope="row">${row.Billing_id}</th>
                <td>${formatting.format(checkEmptyBlock(row.Amount))}</td>
                <td>${checkEmptyBlock(row.Payment_Status)}</td>
                <td>${checkEmptyBlock(row.Insurance_Status)}</td>
            </tr>`;
        }
        placeholder.innerHTML = out;
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })