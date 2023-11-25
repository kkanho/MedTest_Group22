$("#billing_data_output_head").hide();

// $("#billing").click(() => {
    $("#billing_data_output_head").show();
    fetch("/includes/secretaries/billing.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {

        let placeholder = document.querySelector("#billing_data_output");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Billing_id}}">
                <th scope="row">${row.Billing_id}</th>
                <td>${checkEmptyBlock(row.Patient_name)}</td>
                <td>${formatting.format(checkEmptyBlock(row.Amount))}</td>
                <td>${checkEmptyBlock(row.Payment_Status)}</td>
                <td>${checkEmptyBlock(row.Insurance_Status)}</td>
                <td>${checkEmptyBlock(row.Order_id)}</td>
                <td>
                    <button class="btn btn-outline-danger" id="${row.Billing_id}" type="button" onclick="deleteBillingRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        $('#billingTable tr:last').after(`
            <tr>
                <td>#</td>
                <td><input type="text" class="form-control" placeholder="Name" name="Patient_name" id="Patient_name"></td>
                <td><input type="text" class="form-control" placeholder="3000" name="Amount" id="Amount"></td>
                <td><input type="text" class="form-control" placeholder="Pending" name="Payment_Status" id="Payment_Status"></td>
                <td><input type="text" class="form-control" placeholder="Accepted" name="Insurance_Status" id="Insurance_Status"></td>
                <td><input type="text" class="form-control" placeholder="" name="Order_id" id="Order_id"></td>
                <td>
                    <button class="btn btn-outline-success w-100" id="billing_newRow" type='submit' form="insertBilling">Add Billing</button>
                </td>
            </tr>
        `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })

function deleteBillingRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    console.log(id)
    let formData = new FormData();
    formData.append('billingRowIndex', id);
    fetch('/includes/secretaries/billing.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // console.log(response.url);
        // alert("Remove Successful, refresh now")
        location.replace(response.url);
    });
}