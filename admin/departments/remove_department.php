<div id="remove-department-modal" style="display: none;">
    <form id="remove-department-form" class="modal-form" enctype="multipart/form-data" autocomplete="off" onkeypress="return event.keyCode != 13;">
        <ul>
			<li class="form-field">
				<label for="remove-department-name">Department Name</label>
				<input id="remove-department-name" type="text" name="department_name" placeholder="Type departments name to remove" />
			</li>
			<li class="form-field form-fade">
				<label for="remove-department-confirm">Confirm Department</label>
				<input id="remove-department-confirm" type="text" name="department_confirm" placeholder="Type departments name again" />
			</li>
            <li class="form-submit">
                <button id="remove-department-submit">Continue</button>
            </li>
        </ul>
    </form>
</div>

<script type="text/javascript">

$.fn.clickToggle = function(func1, func2) {
    var funcs = [func1, func2];
    this.data('toggleclicked', 0);
    this.click(function(e) {
		e.preventDefault();
        var data = $(this).data();
        var tc = data.toggleclicked;
        $.proxy(funcs[tc], this)();
        data.toggleclicked = (tc + 1) % 2;
    });
    return this;
};

$('#remove-department-submit').clickToggle(
	function() {
		$('#remove-department-submit').css('transition', 'background .8s ease-out, border-bottom .8s ease-out');
		$('#remove-department-submit').css('background', '#ce3939');
		$('#remove-department-submit').css('border-bottom', '3px solid #a31e1e');
		$('#remove-department-submit').html('Remove department');
		$('.form-fade').fadeIn(250);
	}, function() {
		var $data = {
			department_name: $('#remove-department-name').val(),
			department_confirm: $('#remove-department-confirm').val()
		};
		$.ajax({
			type: "POST",
			url: './scripts/remove_department.php',
			dataType: 'json',
			data: $data,
			success: function (data) {
				var $response = data;
				if ($response.status == 'success') {
					alert("Department '"+$response.data+"' successfully removed.");
					$('#remove-department-name').val('');
					$('#remove-department-confirm').val('');
					modal.close();
					$('.form-fade').fadeOut(50);
				} else if ($response.status == 'error') {
					$('#remove-department-form > ul > li').css('border-color', 'rgb(246, 123, 123)');
					$('#remove-department-name').css('background-color', 'rgba(255, 0, 0, 0.19)');
					alert($response.data);
				}
			}
		});
	}
);
</script>
