$("#availableTest_data_output_head").hide();

// $("#availableTest").click(() => {
    $("#availableTest_data_output_head").show();
    fetch("/includes/secretaries/availableTest.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        console.log(data)
        let placeholder = document.querySelector("#availableTest_data_output");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Test_id}">
                <th scope="row">${row.Test_id}</th>
                <td>${checkEmptyBlock(row.Test_code)}</td>
                <td>${checkEmptyBlock(row.Test_name)}</td>
                <td>${checkEmptyBlock(row.Description)}</td>
                <td>${checkEmptyBlock(row.Cost)}</td>
            </tr>`;
        }
        placeholder.innerHTML = out;
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })
