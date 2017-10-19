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
                $("#CourseName").easyAutocomplete(options);
            } else if ($response.status == 'success' && course != 'all') {
                $('#CourseName').val($courses.course_id);
                $('#CourseHead').val($courses.teacher_name);
                LoadCourse();
            } else if ($response.status == 'error') {
                alert($response.data);
            }
        }
    });
}
