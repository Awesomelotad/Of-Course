function HandleRequest(row_id, accept, name) {
    var $data = {
        teacher_name: name,
        accept: accept
    }
    $.ajax({
        type: 'POST',
        url: './scripts/request_handler.php',
        data: $data,
        success: function (response) {
            var $warning = '';
            var $message = '';
            if (accept) {
                if (response == "success") {
                    $message += 'You accepted '+name+"!";
                } else {
                    $warning += 'Unable to accept '+name+' at this time. Contact I.T for support.';
                    console.log(response);
                }
            } else {
                if (response == "success") {
                    $message += 'You declined '+name+"!";
                } else {
                    $warning += 'Unable to decline '+name+' at this time. Contact I.T for support.';
                    console.log(response);
                }
            }

            if ($warning != '') {
                alert($warning);
            } else {
                var $nodes = [];
                $('#RequestsTable').DataTable().rows().every( function(rowIdx, tableLoop, rowLoop) {
                    if ( this.data()['name'] == name) $nodes.push(this.node())
                })
                $nodes.forEach(function($node) {
                    $('#RequestsTable').DataTable().row($node).remove().draw()
                })
                alert($message);
            }
        }
    });
}