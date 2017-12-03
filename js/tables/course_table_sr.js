var Yeartable = $('#YearTable').DataTable( {
    responsive: true,
    "data" : $year_table_data,
    "columns" : [
        {"data" : "course_code"},
        {"data" : "course_name"},
        {"data" : "optional"},
        {"data" : "department_name"},
        {"data" : "standard_name"},
        {"data" : "num_credits"}
    ],
    createdRow: function ( row, data ) {
        if (data['optional'] == "1") {
            $(row).addClass('optional');
        }
        else if (data['optional'] == "0") {
            $(row).addClass('required');
        }
    },
    "columnDefs" : [
        {
            "targets": [2, 3],
            "visible": false
        },
        {
            "targets": [0, 1, 3, 4, 5],
            "orderable": false
        },
    ],
    "drawCallback": function ( settings ) {
        var api = this.api();
        var rows = api.rows( {page:'current'} ).nodes();
        var last= null;
        api.column(3, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
                $(rows).eq( i ).before(
                    '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                );
                last = group;
            }
        } );
    },
    paging: false,
    scrollY: 500,
    "order": [[2, "asc"]]
});
if ($ReqYear == 11) {
    Yeartable.column(4).visible(false);
}
