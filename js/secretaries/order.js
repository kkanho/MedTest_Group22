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
            out += `<tr id="${row.Order_id}}">
                <th scope="row">${row.Order_id}</th>
                <td>${checkEmptyBlock(row.Order_date)}</td>
                <td>${checkEmptyBlock(row.Status)}</td>
                <td>${checkEmptyBlock(row.Patient_name)}</td>
                <td>${checkEmptyBlock(row.Staff_name)} [${checkEmptyBlock(row.Position)}]</td>
                <td>${checkEmptyBlock(row.Test_id)}</td>
                <td>
                    <button class="btn btn-outline-danger" id="${row.Order_id}" type="button" onclick="deleteOrderRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        $('#orderTable tr:last').after(`
            <tr>
                <td>#</td>
                <td>
                    <input type="date" my-date-format="DD/MM/YYYY" class="form-control" name="Order_date" id="Order_date">
                </td>
                <td><input type="text" class="form-control" placeholder="Test Pending" name="Status" id="Status"></td>
                <td><input type="text" class="form-control" placeholder="Patient Name" name="Patient_name" id="Patient_name"></td>
                <td><input type="text" class="form-control" placeholder="Staff Name" name="Staff_name" id="Staff_name"></td>
                <td><input type="text" class="form-control" placeholder="" name="Test_id" id="Test_id"></td>
                <td colspan="2">
                    <button class="btn btn-outline-success w-100" id="order_newRow" type='submit' form="insertOrder">Add Order</button>
                </td>
            </tr>
        `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })



function deleteOrderRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    console.log(id)
    let formData = new FormData();
    formData.append('orderRowIndex', id);
    fetch('/includes/secretaries/order.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // console.log(response.url);
        // alert("Remove Successful, refresh now")
        location.replace(response.url);
    });
}