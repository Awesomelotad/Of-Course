<?php
include('./config.php');

$return = (object) null;
$code = $_POST['code'];
$name = $_POST['name'];
$year = $_POST['year'];
$department = $_POST['department'];
$department_id = $_POST['department_id'];
$optional = $_POST['optional'];
$prereqs = $_POST['prereqs'];
$teacher = $_POST['teacher'];
$standard = $_POST['standard'];
$credits = $_POST['credits'];

if (isset($_FILES[0]) {
	$outline = $_FILES[0];
    if ($outline['size'] < 102400) {
		$sql_exists = "SELECT count(0) FROM courses WHERE course_code='$code'";
		if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_exists))[0] == 0) {
			if ($department != "") {
				$department_result = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT department_id FROM department WHERE department_name='$department'"));
			} else {
				$department_result = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT department_id FROM department WHERE department_id='$department_id'"));
			}
		    if (count($department_result) == 1) {
				$department_id = $department_result['department_id'];
				$teacher_result = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT t_id FROM teachers WHERE teacher_code = '$teacher' LIMIT 1"));
				if (count($teacher_result) == 1) {
					$teacher_id = $teacher_result['t_id'];
			        $sql = "INSERT INTO course (course_id, course_name, course_code, year_id, department_id, optional, pre_reqs, tic_id, standard_id, leads_to, num_credits) VALUES (NULL, '$name', '$code', '$year', '$department', '$optional', '$prereqs', '$teacher_id', '$standard', NULL, '$credits')";
			        mysqli_query($dbconnect, $sql);
			        if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_exists))[0] == 1) {

			            $status = 'success';
			            $data = $name;
			        } else {
			            $status = 'error';
			            $data = 'Error: Failed to add course. Reason: Unknown. Contact I.T. for support.';
			        }
				} else {
					$status = 'error';
					$data = 'Error: Failed to add course. Reason: Teacher code does not exist.'
				}
		    } else {
		        $status = 'error';
		        $data = 'null department';
		    }
		} else {
		    $status = 'error';
		    $data = 'Error: Failed to add course. Reason: Course already exists.';
		}
    } else {
        $status = 'error';
		$data = 'Error: Course outline failed to upload. Reason: File size exceeds 1mb.';
    }
} else {
	$status = 'error';
	$data = 'Error: Failed to add course. Reason: No course outline uploaded.'
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>
