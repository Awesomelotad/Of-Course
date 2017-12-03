<?php
include('./config.php');

$return = (object) null;
$department = $_POST['department_name'];
$department_confirm = $_POST['department_confirm'];
$id = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT department_id FROM department WHERE department_name LIKE '$department'"))['department_id'];

if ($department = $department_confirm) {
	$sql_exists = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT count(0) FROM department WHERE department_name LIKE '$department'"))[0];
	if ($sql_exists != 0) {
		$sql = "DELETE FROM department WHERE department_name LIKE '$department'";
		mysqli_query($dbconnect, $sql);
		$sql_check = mysqli_fetch_array(mysqli_query($dbconnect, "SELECT count(0) FROM department WHERE department_name LIKE '$department'"))[0];
		if ($sql_check == 0) {
			$files = scandir("../uploads/DEP_#$id");
			$source = "../uploads/DEP_#$id/";
			if(!is_dir("../uploads/backup/DEP_".$department."_BACKUP")) {
    			mkdir("../uploads/backup/DEP_".$department."_BACKUP");
    		}
			$destination = "../uploads/backup/DEP_".$department."_BACKUP/";
			foreach ($files as $file) {
			  	if (in_array($file, array(".",".."))) continue;
			  	if (copy($source.$file, $destination.$file)) {
			    $delete[] = $source.$file;
			  }
			}
			foreach ($delete as $file) {
			  unlink($file);
			}
			rmdir("../uploads/DEP_#$id");
		    $status = 'success';
		    $data = $department;
		} else {
		    $status = 'error';
		    $data = 'Error: Could not remove department. Reason: Unknown. Contact I.T. for support.';
		}
	} else {
		$status = 'error';
		$data = 'Error: Could not remove department. Reason: Department does not exist.';
	}
} else {
	$status = 'error';
	$data = 'Error: Failed to remove department. Reason: Department names do not match.';
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>
