$("#order_data_output_head").hide();

// $("#order").click(() => {
    $("#order_data_output_head").show();
    fetch("/includes/secretaries/order.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {

        let placeholder = document.querySelector("#order_data_output");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Order_id}">
                <th scope="row">${row.Order_id}</th>
                <td>${checkEmptyBlock(row.Order_date)}</td>
                <td>${checkEmptyBlock(row.Status)}</td>
                <td>${checkEmptyBlock(row.Patient_name)}</td>
                <td>${checkEmptyBlock(row.Staff_name)} [${checkEmptyBlock(row.Position)}]</td>
                <td>${checkEmptyBlock(row.Test_id)}</td>
                <td>
                    <button class="btn btn-outline-dark w-100" id="${row.Order_id}" type='button' onclick="updateOrderRow(this)">Update</button>
                </td>
                <td>
                    <button class="btn btn-outline-danger w-100" id="${row.Order_id}" type="button" onclick="deleteOrderRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        $('#orderTable tr:last').after(`
            <tr>
                <td>#</td>
                <td>
                    <input type="date" my-date-format="DD/MM/YYYY" class="form-control shadow-sm" name="Order_date" id="Order_date">
                </td>
                <td><input type="text" class="form-control shadow-sm" placeholder="Test Pending" name="Status" id="Status"></td>
                <td><input type="text" class="form-control shadow-sm" placeholder="Patient Name" name="Patient_name" id="Patient_name_order"></td>
                <td><input type="text" class="form-control shadow-sm" placeholder="Staff Name" name="Staff_name" id="Staff_name"></td>
                <td><input type="text" class="form-control shadow-sm" placeholder="" name="Test_id" id="Test_id"></td>
                <td colspan="2">
                    <button class="btn btn-outline-success w-100" id="order_newRow" type='submit' form="insertOrder">Add</button>
                </td>
            </tr>
        `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })



function updateOrderRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch
    console.log($("#Patient_name_order").val())

    let formData = new FormData();
    formData.append('Order_id_update', id);
    formData.append('Status', $("#Status").val())
    formData.append('Order_date', $("#Order_date").val())
    formData.append('Patient_name', $("#Patient_name_order").val())
    formData.append('Staff_name', $("#Staff_name").val())
    formData.append('Test_id', $("#Test_id").val())
    // console.log(formData.entries())
    // for (const value of formData.values()) {
    //     console.log(value);
    // }
    fetch('/includes/secretaries/orderUpdate.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // alert(response.url)
        location.replace(response.url);
    });
}
function deleteOrderRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    let formData = new FormData();
    formData.append('orderRowIndex', id);
    fetch('/includes/secretaries/orderDelete.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // alert(response.url)
        location.replace(response.url);
    });
}