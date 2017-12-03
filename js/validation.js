//validation functions
var validateFile = function(form_input, max_size, min_size) {
	if ($(form_input)[0].files[0].size < max_size && $(form_input)[0].files[0].size > min_size) {
		$(form_input).css('box-shadow', 'none');
	} else {
		$(form_input).css('box-shadow', '0 0 1.5px 1px red');
		$(form_input).val('');
		alert('Course outline too large! (max 100kb)');
		return false;
	}
}

//custom validation usage
$('#course-outline').bind('change', function() {
	validateFile('#course-outline', 102400, 5120);
});
