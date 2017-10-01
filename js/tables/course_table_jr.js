$('#YearTable').DataTable( {
    responsive: true,
    "data" : $year_table_data,
    "columns" : [
        { "data" : "class_code" },
        { "data" : "course_name" },
        { "data" : "optional" },
        { "data" : "group_name" }
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
            "targets": [0, 1],
            "orderable": false
        }
    ],
    "drawCallback": function ( settings ) {
        var api = this.api();
        var rows = api.rows( {page:'current'} ).nodes();
        var last= null;

        api.column(3, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
                $(rows).eq( i ).before(
                    '<tr class="group"><td colspan="2">'+group+'</td></tr>'
                );
                last = group;
            }
        } );
    },
    paging: false,
    scrollY: "27em",
    "order": [[2, "asc"]]
});