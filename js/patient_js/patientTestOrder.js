$("#patient_test_order_data_output_head").hide();

// $("#patientTestOrder").click(() => {
    $("#patient_test_order_data_output_head").show();
    fetch("/includes/patients/testOrder.inc.php")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            
            let placeholder = document.querySelector("#patient_test_order_data_output");
            let out = "";
            for(let row of data){
                out += `<tr>
                    <th scope="row">${checkEmptyBlock(row.Order_id)}</th>
                    <td>${checkEmptyBlock(row.Order_date)}</td>
                    <td>${checkEmptyBlock(row.Status)}</td>
                </tr>`;
            }
            placeholder.innerHTML = out;
        })
        .catch (e => {
            console.log("Error:", e)
        });
// })