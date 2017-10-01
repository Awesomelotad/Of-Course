$(document).ready(function() {
    $('#DatesTable').DataTable( {
        responsive: true,
        "data": $dates_table_data,
        "columns" : [
            {"data" : "date"},
            {"data" : "description"},
        ],
        "order": [[0, 'asc']],
        "columnDefs": [ {
            "targets"  : 1,
            "orderable": false
        }]
    });
})