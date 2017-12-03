<?php
include('./config.php');

$return = (object) null;
$department = $_POST['department_name'];

$sql_exists = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT count(0) FROM department WHERE department_name LIKE '$department'"))[0];
if ($sql_exists == 0) {
	$sql = "INSERT INTO department (department_id, department_name) VALUES (NULL, '$department')";
	mysqli_query($dbconnect, $sql);
	$sql_check = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM department WHERE department_name='$department'"));
	if ($sql_check['department_name'] = $department) {
		mkdir('../uploads/DEP_#'.$sql_check['department_id']);
	    $status = 'success';
	    $data = $department;
	} else {
	    $status = 'error';
	    $data = 'Error: Could not add department. Reason: Unknown. Contact I.T. for support.';
	}
} else {
	$status = 'error';
	$data = 'Error: Could not add department. Reason: Department already exists.';
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>
