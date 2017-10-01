<?php
include('./config.php');

$return = (object) null;
$ident = $_POST['code'];

$sql = "SELECT * FROM teachers WHERE teacher_code='$ident'";
$result = mysqli_fetch_assoc(mysqli_query($dbconnect, $sql));
if ($ident != '') {
    if ($result != null && $result != false) {
        $status = 'success';
        $data = $result;
    } else {
        $status = 'error';
        $data = 'Error: Teacher with that code does not exist.';
    }
} else {
    $status = 'error';
    $data = 'Error: No teacher code entered';
}
$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>