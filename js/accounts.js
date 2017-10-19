function GetDepartment(department_id) {
    var $data = {
        department_id: department_id
    };
    $.ajax({
        type: "POST",
        url: './scripts/get_departments.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
            var $response = data;
            var $departments = JSON.parse($response.data);
            if ($response.status == 'success' && department_id == 'all') {
                var options = {
                    data: $departments,
                    list: {
                        match: {
                            enabled: true
                        },
                        maxNumberOfElements: 8
                    },
					adjustWidth: false
                };
                $("#TeacherDepartment").easyAutocomplete(options);
            } else if ($response.status == 'success' && department_id != 'all') {
                $('#TeacherDepartment').val($departments.department_name);
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}
var $teacher_list = '';
function GetTeacher(identity) {
    var $data = {
        teacher_code: identity
    };
    $.ajax({
        type: "POST",
        url: './scripts/get_teachers.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
            var $response = data;
            var $teachers = JSON.parse($response.data);
            if ($response.status == 'success' && identity == 'all') {
                var options = {
                    data: $teachers,
                    list: {
                        match: {
                            enabled: true
                        },
                        maxNumberOfElements: 10
                    },
					adjustWidth: false
                };
                $("#TeacherIdentity").easyAutocomplete(options);
				$teacher_list += $teachers;
            } else if ($response.status == 'success' && identity != 'all') {
                $('#TeacherIdentity').val($teachers.teacher_code);
                $('#TeacherCode').val($teachers.teacher_code);
                LoadTeacher();
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}
function AddTeacher(action, identity) {
    var $data = {
        code: $('#TeacherCode').val(),
        name: $('#TeacherName').val(),
        email: $('#TeacherEmail').val(),
        password: $('#TeacherPassword').val(),
        password_confirm: $('#TeacherPConfirm').val(),
        department: $('#TeacherDepartment').val(),
        subject: $('#TeacherSubject').val(),
        elevation: $('.TeacherElevation:radio[name=\'elevation\']:checked').val(),
        action: action
    };
    if (identity) {
        $data.identity = $('#TeacherIdentity').val();
    }
    var $dataValid = 0;
    $.each($data, function(index, value) {
        if (index != 'password' && value == '') {
            $dataValid += 1;
        }
    });
    if ($dataValid >= 1) {
        alert('Error: Failed to update account. Reason: 1 or more requred fields empty.');
    } else {
        if (action == 'add') {
            $actionType = 'registered';
        } else if (action == 'edit') {
            $actionType = 'updated';
        }
        $.ajax({
            type: "POST",
            url: './scripts/add_account.php',
            dataType: 'json',
            data: $data,
            success: function (data) {
                var $response = data;
                if ($response.status == 'success') {
                    alert($response.data+" was "+$actionType+" successfully!");
                    if (action != 'edit') {
                        $('#TeacherForm')[0].reset();
                    } else {
                        $('#TeacherIdentity').val($('#TeacherCode').val());
                        $('#TeacherPassword').val('');
                        LoadTeacher();
                    }
                } else if ($response.status == 'error') {
                    if ($response.data == 'null department') {
                        $("#department-modal-header").text('Department \''+$data.department+'\' does not exist. Would you like to add it?');
                        modal.open('#department-modal');
                    } else {
                        alert($response.data);
                    }
                }
            }
        });
    }
}
function AddDepartment() {
    var $data = {
        department: $('#TeacherDepartment').val()
    };
    $.ajax({
        type: "POST",
        url: './scripts/add_department.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
            var $response = data;
            if ($response.status == 'success') {
                alert($data.department+" was added successfully!");
                modal.close('#department-modal');
                AddTeacher();
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}
function LoadTeacher() {
    var $data = {
        code: $('#TeacherIdentity').val()
    };
    $.ajax({
        type: "POST",
        url: './scripts/load_teacher.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
            var $response = data;
            var $teacher = $response.data;
            if ($response.status == 'success') {
				$('.form-fade').css("height", "0");
                $('.form-fade').fadeOut(200);
                $('#TeacherCode').val($teacher.teacher_code);
                $('#TeacherName').val($teacher.name);
                $('#TeacherEmail').val($teacher.email);
                GetDepartment($teacher.department_id);
                GetDepartment('all');
                $('#TeacherSubject').val($teacher.subject);
                if ($teacher.elevation == 0) {
                    $('#teacher').prop('checked', true);
                } else if ($teacher.elevation == 1) {
                    $('#tic').prop('checked', true);
                } else if ($teacher.elevation == 2) {
                    $('#hol').prop('checked', true);
                } else if ($teacher.elevation == 3) {
                    $('#sysadmin').prop('checked', true);
                }
                $('.form-fade').fadeIn(250);
				$('.form-fade').css("height", "auto");
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}
function RemoveTeacher(sess_id, using_id, e) {
    e.preventDefault();
    var $data = {
        password: $('#ConfirmPassword').val(),
        id: ''
    };
    if (using_id) {
        $data.id = $('#TeacherIdentity').val()
    }
    $.ajax({
        type: "POST",
        url: './scripts/remove_teacher.php',
        dataType: 'json',
        data: $data,
        success: function(data) {
            var $response = data;
            if ($response.status == 'success') {
                if ($response.data == sess_id) {
                    alert('Account removed. Close alert to log out.');
                    location.href = './scripts/logout.php';
                } else {
                    alert('Account removed successfully.');
                    location.reload();
                }
            } else if ($response.status == 'error') {
                $('#acc_delete_form.form-error').fadeOut(50);
                $('#acc_delete_form.form-error').text($response.data);
                $('#acc_delete_form.form-error').fadeIn(50);
            }
        }
    });
}
$(document).ready(function() {
    $('#TeacherSubmit').click(function(e) {
        e.preventDefault();
        AddTeacher('add', false);
    });
    $('#TeacherUpdate').click(function(e) {
        e.preventDefault();
        AddTeacher('edit', true);
    });
    $('#DepartmentSubmit').click(function(e) {
        e.preventDefault();
        AddDepartment();
    });
    $('#TeacherLoad').click(function(e) {
        e.preventDefault();
        LoadTeacher();
    });
    $('#TeacherRemove').click(function(e) {
        e.preventDefault();
		if ($('#TeacherIdentity').val() != '' && $('#TeacherIdentity').val() != null && ($teacher_list.includes($('#TeacherIdentity').val().toUpperCase())) == true) {
	        modal.open('#account-delete-modal');
		} else {
			alert('Invalid teacher code. Please try again or contact I.T. for support.');
		}
    });
});
