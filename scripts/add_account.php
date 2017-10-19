<?php
include('./config.php');

$return = (object) null;
$code = $_POST['code'];
$identity = $_POST['identity'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $password_raw = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
if ($password != '') {
    $password = password_hash($password, PASSWORD_DEFAULT);
} else {
    $password = '';
}
$subject = $_POST['subject'];
if (isset($_POST['elevation'])) {
    $elevation = $_POST['elevation'];
} else {
    $elevation = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT elevation FROM teachers WHERE teacher_code='$identity'"))[0];
}
$action = $_POST['action'];

if ($action == 'add') {
    $sql_exists = "SELECT count(0) FROM teachers WHERE teacher_code='$code'";
    if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_exists))[0] == 0) {
        $department_result = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT department_id FROM department WHERE department_name='".$_POST['department']."'"));
        if (count($department_result) == 1) {
            $department = $department_result['department_id'];
            $sql = "INSERT INTO teachers (t_id, teacher_code, department_id, subject, name, email, password, elevation, locked, status) VALUES (NULL, '$code', '$department', '$subject', '$name', '$email', '$password', '$elevation', '0', '1')";
            mysqli_query($dbconnect, $sql);
            if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_exists))[0] == 1) {
				if ($password_raw == $password_confirm) {
	                $status = 'success';
	                $data = $name;
				} else {
					$status = 'error';
					$data = 'Error: Failed to register teacher. Reason: Passwords do not match.';
				}
            } else {
                $status = 'error';
                $data = 'Error: Failed to register teacher. Reason: Unknown. Contact I.T. for support.';
            }
        } else {
            $status = 'error';
            $data = 'null department';
        }
    } else {
        $status = 'error';
        $data = 'Error: Failed to register teacher. Reason: Teacher already exists.';
    }
} elseif ($action == 'edit') {
    $sql_exists = "SELECT count(0) FROM teachers WHERE teacher_code='$identity'";
    if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_exists))[0] == 1) {
        $department_result = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT department_id FROM department WHERE department_name='".$_POST['department']."'"));
        $id = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT t_id FROM teachers WHERE teacher_code='$identity' LIMIT 1"))[0];
        if (count($department_result) == 1) {
            $department = $department_result['department_id'];
            if ($password != '') {
                $sql = "UPDATE teachers SET teacher_code='$code', name='$name', email='$email', password='$password', subject='$subject', elevation='$elevation', department_id='$department' WHERE t_id='$id'";
                $sql_updated = "SELECT count(0) FROM teachers WHERE teacher_code='$code' AND name='$name' AND email='$email' AND password='$password' AND subject='$subject' AND elevation='$elevation' AND department_id='$department' AND t_id='$id'";
            } else {
                $sql = "UPDATE teachers SET teacher_code='$code', name='$name', email='$email', subject='$subject', elevation='$elevation', department_id='$department' WHERE t_id='$id'";
                $sql_updated = "SELECT count(0) FROM teachers WHERE teacher_code='$code' AND name='$name' AND email='$email' AND subject='$subject' AND elevation='$elevation' AND department_id='$department' AND t_id='$id'";
            }
            mysqli_query($dbconnect, $sql);
            if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_updated))[0] == 1) {
				if ($password_raw == $password_confirm) {
	                $status = 'success';
	                $data = $name;
				} else {
					$status = 'error';
					$data = 'Error: Failed to update teacher. Reason: Passwords do not match.';
				}
            } else {
                $status = 'error';
                $data = 'Error: Failed to update teacher. Reason: Unknown. Please contact I.T. for support.';
            }
        } else {
            $status = 'error';
            $data = 'null department';
        }
    } else {
        $status = 'error';
        $data = 'Error: Failed to update teacher. Reason: Teacher does not exist.';
    }
} else {
    $status = 'error';
    $data = 'Error: Unauthorised method of access.';
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>
