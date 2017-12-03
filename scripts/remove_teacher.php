<?php
include('./config.php');
session_start();

$password = $_POST['password'];
$t_id = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT t_id FROM teachers WHERE teacher_code='".$_POST['id']."' LIMIT 1"))[0];
$password_active = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT password FROM teachers WHERE t_id='".$t_id."'"))[0];
$return = (object) null;

if ($password != '') {
    if (password_verify($password, $password_active) == true) {
        $sql = 'DELETE FROM teachers WHERE t_id=\''.$t_id.'\'';
        $sql_check = 'SELECT count(0) FROM teachers WHERE t_id=\''.$t_id.'\'';
        mysqli_query($dbconnect, $sql);
        if (mysqli_fetch_array(mysqli_query($dbconnect, $sql_check))[0] == 0) {
            $status = 'success';
            $data = $t_id;
        } else {
            $status = 'error';
            $data = 'Error: Unknown. Contact I.T. for support.';
        }
    } else {
        $status = 'error';
        $data = 'Error: Invalid password!';
    }
} else {
    $status = 'error';
    $data = 'Error: No password!';
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>
