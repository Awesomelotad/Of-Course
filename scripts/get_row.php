<?php
include('./config.php');
$sql = "SELECT * FROM ".$_POST['table']." WHERE ".$_POST['idColumn']."=".$_POST['id'];
$query = mysqli_query($dbconnect, $sql);
$response = mysqli_fetch_assoc($query);
$return = (object) null;
$return->status = 'success';
$return->data = $response;
echo json_encode($return);
?>