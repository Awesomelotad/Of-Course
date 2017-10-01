$(document).ready(function() {
    $('#ContactTable').DataTable( {
        responsive: true,
        "data": $contact_table_data,
        "columns" : [
            {"data" : "name"},
            {"data" : "subject"},
            {
                "data" : "email",
                "render" : function ( data, type, row, meta ) {
                    return "<a href='mailto:"+data+"'>"+data+"</a>";
                }
            }
        ],
        "order": [[2, 'asc']],
        "columnDefs": [ {
            "targets"  : [0, 1],
            "orderable": false
        }],
        "scrollY": "27em",
        "bScrollCollapse": false
    });
});