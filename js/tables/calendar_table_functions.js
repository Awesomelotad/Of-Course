function GetRow(id) {
    
    var $data = {
        table: 'dates',
        idColumn: 'event_id',
        id: id
    };
    $.ajax({
        type: "POST",
        url: './scripts/get_row.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
            var $response = data;
            if ($response.status == 'success') {
                $('#DateInput').val($response.data.date);
                $('#DescriptionInput').val($response.data.description);
            } else {
                $('#SubmitError').html($response.data).show();
            }
        }
    });
}

function LaunchModal(button, rowId, tableRowId, alterType) {
    $('#DateForm')[0].reset();
    $('#DateSubmit').html(button);
    if (rowId != '') {
        GetRow(rowId);
    }
    $('#DateSubmit').attr('onclick', "AddEditRow('"+alterType+"', "+rowId+", "+tableRowId+", event)");
    modal.open('#dates-modal');
}

function adjust_textarea(h) {
    h.style.height = "20px";
    h.style.height = (h.scrollHeight)+"px";
}

function DeleteRow(row_local, row_table) {

    var $data = {
        id: row_table,
        task: 'delete'
    };

    $.ajax({
        type: 'POST',
        url: './scripts/dates_handler.php',
        data: $data,
        success: function (data) {
            var $response = JSON.parse(data);
            if ($response.status == 'success') {
                var oldDate = $('#DatesTable').DataTable().cell(row_local, 0).data();
                var datePart = oldDate.match(/\d+/g),
                    year = datePart[0],
                    month = datePart[1],
                    day = datePart[2];
                var newDate = year+'-'+month+'-'+day;
                $('#DatesTable').DataTable().row(row_local).remove().draw();
                alert('Event on '+newDate+' removed successfully');
            } else if($response.status == 'error') {
                $('#SubmitError').text($response.data).show();
            }
        }
    });
}

function AddEditRow(task, rowId, tableRowId, e) {

    e.preventDefault();

    if (($('#DateInput').val() !== '' && $('#DateInput').val() !== null) && ($('#DescriptionInput').val() !== '' && $('#DescriptionInput').val() !== null)) {
        var newDate = $('#DateInput').val();
        
        var $data = {
            id: rowId,
            date: newDate,
            description: $('#DescriptionInput').val(),
            task: task
        };
        

        $.ajax({
            type: 'POST',
            url: './scripts/dates_handler.php',
            data: $data,
            success: function (data) {
                var $response = JSON.parse(data);
                if ($response.status == 'success') {
                    $('#SubmitError').hide();
                    var $RowArr = {
                        "event_id" : $response.data,
                        "date" : newDate,
                        "description" : $('#DescriptionInput').val()
                    };
                    if (task == 'update') {
                        $('#DatesTable').DataTable().row(tableRowId).data($RowArr).draw();
                    } else {
                        $('#DatesTable').DataTable().row.add($RowArr).draw();
                    }
                    modal.close('#dates-modal');
                    alert('Event on '+newDate+' '+task+'ed successfully');
                } else if ($response.status == 'error') {
                    $('#SubmitError').html($response.data).show();
                }
            }
        });
        
    } else {
        alert('You must fill out both fields!');
    }
}