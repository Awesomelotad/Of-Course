function GetCourse(course) {
    var $data = {
        course_id: course
    };
    $.ajax({
        type: "POST",
        url: './scripts/get_courses.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
            var $response = data;
            var $courses = JSON.parse($response.data);
            if ($response.status == 'success' && course == 'all') {
                var options = {
                    data: $courses,
                    list: {
                        match: {
                            enabled: true
                        },
                        maxNumberOfElements: 10
                    },
					adjustWidth: false
                };
                $("#course-name").easyAutocomplete(options);
            } else if ($response.status == 'success' && course != 'all') {
                $('#course-name').val($courses.course_id);
                $('#course-teacher').val($courses.teacher_name);
                LoadCourse();
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
                $("#course-teacher").easyAutocomplete(options);
				$teacher_list += $teachers;
            } else if ($response.status == 'success' && identity != 'all') {
                $('#course-teacher').val($teachers.teacher_code);
				$teacher_list = $teachers.teacher_code;
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}
function AddCourse() {

	var $file = $('#course-outline').files[0];
	var $data = new FormData();
	formData.append('outline', $file);
;
	$.ajax({
        type: "POST",
        url: './scripts/add_course.php',
        dataType: 'json',
        data: $data,
        success: function (data) {
			var $response = $data;
			if ($response.status == 'success') {
				alert("Success! Course '"+$response.data+"' added successfully.");
				$('#course-form')[0].reset();
			} else if ($response.status == 'error') {
				if ($response.data = 'null department') {
					$("#department-modal-header").text("Department '"+$data.department+"' does not exist. Would you like to add it?");
					modal.open('#department-modal');
				} else {
					alert($response.data);
				}
			}
        }
    });
}

function AddDepartment() {
    var $data = {
        department: $('#course-department-name').val()
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
                AddCourse();
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}

$('#course-form').submit(function(e) {
	e.preventDefault();
	AddCourse();
});
$('#department-submit').click(function(e) {
	e.preventDefault();
	AddDepartment();
});
