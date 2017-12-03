<?php
include('./config.php');

$course_id = $_POST['course_id'];
$return = (object) null;

if ($course_id == 'all') {
    $sql = "SELECT class_name FROM course GROUP BY class_name";
	$query = mysqli_query($dbconnect, $sql);
	$return_arr = array();
	mysqli_data_seek($query, 0);
	while ($row = mysqli_fetch_assoc($query)) {
		$return_arr[] = $row['class_name'];
	}
    $status = 'success';
    $data = json_encode($return_arr);
} else {
    $sql = "SELECT class_name FROM course WHERE course_id='$course_id'";
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
