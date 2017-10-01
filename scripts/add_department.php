<?php
include('./config.php');

$return = (object) null;
$department = $_POST['department'];

$sql = "INSERT INTO department (department_id, department_name) VALUES (NULL, '$department')";
$sql_check = "SELECT count(0) FROM department WHERE department_name='$department'";
mysqli_query($dbconnect, $sql);
if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_check))[0] == 1) {
    $status = 'success';
    $data = null;
} else {
    $status = 'error';
    $data = 'Error: Could not add department. Reason: Unknown. Contact I.T. for support.';
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>