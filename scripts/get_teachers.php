<?php
include('./config.php');

$teacher_code = $_POST['teacher_code'];
$return = (object) null;

if ($teacher_code == 'all') {
    $sql = "SELECT teacher_code FROM teachers";
    $query = mysqli_query($dbconnect, $sql);
    $return_arr = array(mysqli_fetch_assoc($query)['teacher_code']);
    if ($return_arr[0] != null) {
        while ($row = mysqli_fetch_assoc($query)) {
            $return_arr[] = $row['teacher_code'];
        }
    } else {
        $return_arr = array();
    }
    $status = 'success';
    $data = json_encode($return_arr);
} else {
    $sql = "SELECT teacher_code FROM teachers WHERE t_id='$teacher_code'";
    $query = mysqli_query($dbconnect, $sql);
    $return_arr = array(mysqli_fetch_assoc($query));
    if ($return_arr[0] != null) {
        $status = 'success';
        $data = json_encode($return_arr[0]);
    } else {
        $status = 'error';
        $data = 'Error: Could not retrieve teacher. Contact I.T for support.';
    }
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>