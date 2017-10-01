<?php
include('./config.php');

$department_id = $_POST['department_id'];
$return = (object) null;

if ($department_id == 'all') {
    $sql = "SELECT department_name FROM department";
    $query = mysqli_query($dbconnect, $sql);
    $return_arr = array(mysqli_fetch_assoc($query)['department_name']);
    if ($return_arr[0] != null) {
        while ($row = mysqli_fetch_assoc($query)) {
            $return_arr[] = $row['department_name'];
        }
    } else {
        $return_arr = array();
    }
    $status = 'success';
    $data = json_encode($return_arr);
} else {
    $sql = "SELECT department_name FROM department WHERE department_id='$department_id'";
    $query = mysqli_query($dbconnect, $sql);
    $return_arr = array(mysqli_fetch_assoc($query));
    if ($return_arr[0] != null) {
        $status = 'success';
        $data = json_encode($return_arr[0]);
    } else {
        $status = 'error';
        $data = 'Error: Could not retrieve department. Contact I.T for support.';
    }
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>