<?php
include('./config.php');

$name = "'".$_POST['teacher_name']."'";
$accept = $_POST['accept'];

if ($accept == true) {
    $request_sql = "UPDATE teachers SET status=1 WHERE name=$name";
    $request_query = mysqli_query($dbconnect, $request_sql);
    echo 'success';
} else {
    $request_sql = "DELETE FROM teachers WHERE name=$name";
    $request_query = mysqli_query($dbconnect, $request_sql);
    echo 'success';
}

?>