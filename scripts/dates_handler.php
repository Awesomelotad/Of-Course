<?php
include('./config.php');

$task = $_POST['task'];
$return = (object) null;

if ($task == 'insert') {
    $date = $_POST['date'];
    $description = $_POST['description'];
    $sql = "INSERT INTO dates (event_id, date, description) VALUES ('', '$date', '$description')";
    $sql_check_exists = "SELECT event_id FROM dates WHERE description='$description'";
    if (count(mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_exists))) == 0) {
        mysqli_query($dbconnect, $sql);
        if (count(mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_exists))) == 1) {
            $status = 'success';
            $data = mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_exists))['event_id'];
        } else {
            $status = 'error';
            $data = 'Error: Failed to add event. Reason: Unknown. Contact I.T for support.';
        }
    } else {
        $status = 'error';
        $data = 'Error: Failed to add event. Reason: This event already exists';
    }
} elseif ($task == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM dates WHERE event_id=$id";
    $sql_check_exists = "SELECT event_id FROM dates WHERE event_id=$id";
    if (count(mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_exists))) == 1) {
        mysqli_query($dbconnect, $sql);
        if (count(mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_exists))) == 0) {
            $status = 'success';
            $data = null;
        } else {
            $status = 'error';
            $data = 'Error: Failed to delete event. Reason: Unknown. Contact I.T for support.';
        }
    } else {
        $status = 'error';
        $data = 'Error: Failed to delete event. Reason: This event does not exist.';
    }
} elseif ($task == 'update') {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $sql = "UPDATE dates SET date='$date', description='$description' WHERE event_id=$id";
    $sql_check_exists = "SELECT event_id FROM dates WHERE event_id=$id";
    $sql_check_updated = "SELECT event_id FROM dates WHERE event_id=$id AND date='$date' AND description='$description'";
    if (count(mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_exists))) == 1) {
        mysqli_query($dbconnect, $sql);
        if (count(mysqli_fetch_assoc(mysqli_query($dbconnect, $sql_check_updated))) == 1) {
            $status = 'success';
            $data = $id;
        } else {
            $status = 'error';
            $data = 'Error: Failed to update event. Reason: Unknown. Contact I.T for support.';
        }
    } else {
        $status = 'error';
        $data = 'Error: Failed to update event. Reason: This event does not exist.';
    }
}

$return->status = $status;
$return->data = $data;
echo json_encode($return);
?>