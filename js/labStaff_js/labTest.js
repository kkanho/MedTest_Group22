$("#lab_test_head").hide();
$("#labTest_newRow").hide();

// $("#labTest").click(() => {
    $("#lab_test_head").show();
    $("#labTest_newRow").show();
    
    fetch("/includes/labStaff/labTest.inc.php")
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        
        let placeholder = document.querySelector("#lab_test");
        let out = "";
        for(let row of data){
            out += `<tr id="${row.Test_id}">
                <th scope="row" id="identifier">${row.Test_id}</th>
                <td>${checkEmptyBlock(row.Test_code)}</td>
                <td>${checkEmptyBlock(row.Test_name)}</td>
                <td>${checkEmptyBlock(row.Description)}</td>
                <td>${formatting.format(checkEmptyBlock(row.Cost))}</td>
                <td>
                    <button class="btn btn-outline-danger w-100" id="${row.Test_id}" type='button' onclick="deleteLabTestRow(this)">Delete</button>
                </td>
            </tr>`;
        }
        placeholder.innerHTML = out;
        $('#labTestTable tr:last').after(`
            <tr>
                <td>#</td>
                <td><input type="text" class="form-control shadow-sm" placeholder="test999" name="Test_code" id="Test_code"></td>
                <td><input type="text" class="form-control shadow-sm" placeholder="S-Test" name="Test_name" id="Test_name"></td>
                <td><input type="text" class="form-control shadow-sm" placeholder="some description" name="Description" id="Description"></td>
                <td><input type="text" class="form-control shadow-sm" placeholder="1000" name="Cost" id="Cost"></td>
                <td>
                    <button class="btn btn-outline-success w-100" id="labTest_newRow" type='submit' form="insertLabTest">Add</button>
                </td>
            </tr>
        `)
    })
    .catch (e => {
        console.log("Error:", e)
    });
// })

function deleteLabTestRow(row) {

    window.history.pushState(null, null, '/index.php');
    
    let id = $(row).attr('id')
    //pass this to php using post method with fetch

    let formData = new FormData();
    formData.append('rowIndex', id);
    fetch('/includes/labStaff/labTest.inc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // console.log(response.url);
        // alert("Remove Successful, refresh now")
        location.replace(response.url);
    });
}