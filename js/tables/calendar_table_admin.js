$(document).ready(function() {
    $DatesTable = $('#DatesTable').DataTable( {
        "language": {
            "emptyTable": "There are no events to show at this time."
        },
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Add an event',
                action: function ( e, dt, node, config ) {
                    LaunchModal('Add event to database', null, null, 'insert');
                }
            }
        ],
        "data" : $dates_table_data,
        "columns" : [
            {"data" : "date"},
            {"data" : "description"},
            {"data" : "event_id",
             "render" : function ( data, type, row, meta ) {
                 return "<button class=\"DatesButton blue\" onclick=\"LaunchModal('Edit event in database', "+data+", "+meta.row+", 'update');\"></button></div><button class=\"DatesButton red\" onclick=\"modal.open('#confirm-modal');$('#MetaRow').val("+meta.row+");$('#MetaData').val("+data+");\"></button>";
            }}
        ],
        "order": [[0, "asc"]],
        "columnDefs": [
            {
            "className"  : 'dt-center',
            "targets" : [2]
            },
            {
                "targets": [0, 1, 2],
                "orderable": false
            }
        ],
        scrollY: '27em'
    });
    $('#ConfirmDateDelete').click(function(e) {
        e.preventDefault();
        modal.close('#confirm-modal');
        DeleteRow($('#MetaRow').val(), $('#MetaData').val());
    });
});