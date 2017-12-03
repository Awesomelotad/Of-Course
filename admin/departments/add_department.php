<div id="new-department-modal" style="display: none;">
    <form id="new-department-form" class="modal-form" enctype="multipart/form-data" autocomplete="off" onkeypress="return event.keyCode != 13;">
        <ul>
			<li class="form-field">
				<label for="new-department-name">Department Name</label>
				<input id="new-department-name" type="text" name="department_name" placeholder="Type departments name" />
			</li>
            <li class="form-submit">
                <button id="new-department-submit">Add department</button>
            </li>
        </ul>
    </form>
</div>

<script type="text/javascript">
$('#new-department-submit').click(function(e) {
	e.preventDefault();
	var $data = {
		department_name: $('#new-department-name').val()
	};
	$.ajax({
		type: "POST",
		url: './scripts/add_department.php',
		dataType: 'json',
		data: $data,
		success: function (data) {
			var $response = data;
			if ($response.status == 'success') {
				alert("Department '"+$response.data+"' successfully added.");
				$('#new-department-name').val('');
				modal.close();
			} else if ($response.status == 'error') {
				$('#new-department-form > ul > li').css('border-color', 'rgb(246, 123, 123)');
				$('#new-department-name').css('background-color', 'rgba(255, 0, 0, 0.19)');
				alert($response.data);
			}
		}
	});
});
</script>
