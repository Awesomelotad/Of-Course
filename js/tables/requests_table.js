$(document).ready(function() {
    var $R_Q_Table = $('#RequestsTable').DataTable( {
        responsive: true,
        "data" : $requests_table_data,
        "columns" : [
            {"data" : "status"},
            {"data" : "teacher_code"},
            {"data" : "name"},
            {"data" : "subject"},
            {"data" : "department_name"},
            {"data" : "email"},
            {"data" : "role"},
            {"data" : "name",
             "render" : function ( data, type, row, meta ) {
                 return "<button class=\"RequestsButton green\" onclick=\"HandleRequest("+ meta.row +", true, '"+data+"');\"></button><button class=\"RequestsButton red\" onclick=\"HandleRequest("+ meta.row +", false, '"+data+"');\"></button>";
             }}
        ],
        "columnDefs": [
            {
                "className"  : 'dt-center',
                "targets" : [7]
            }
        ],
        "ordering": false,
        scrollY: 500
    });
});