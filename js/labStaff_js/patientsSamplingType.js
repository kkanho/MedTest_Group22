$("#sampling_type_data_output_head").hide();

// $("#samplingType").click(() => {
    $("#sampling_type_data_output_head").show();
    fetch("/includes/labStaff/samplingType.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        console.log(data)
        let placeholder = document.querySelector("#sampling_type_data_output");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Order_id}">
                <th scope="row">${row.Order_id}</th>
                <td>${checkEmptyBlock(row.Test_name)}</td>
                <td>${checkEmptyBlock(row.Status)}</td>
                <td>${checkEmptyBlock(row.Order_date)}</td>
                <td>${checkEmptyBlock(row.Patient_name)}</td>
            </tr>`;

        }
        placeholder.innerHTML = out;
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })
