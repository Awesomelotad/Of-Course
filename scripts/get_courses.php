<?php
include('./config.php');

$course_id = $_POST['course_id'];
$return = (object) null;

if ($course_id == 'all') {
    $group_sql = "SELECT group_name FROM course GROUP BY group_name";
	$group_query = mysqli_query($dbconnect, $group_sql);
	$return_arr = array();
	mysqli_data_seek($group_query, 0);
	while ($row = mysqli_fetch_assoc($group_query)) {
		$return_arr[] = $row['group_name'];
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
