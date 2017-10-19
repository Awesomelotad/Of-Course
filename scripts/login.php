<?php
session_start();
include('./config.php');
if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    $email = stripslashes($email);
    $password = stripslashes($password);

    $email = mysqli_real_escape_string($dbconnect, $email);
    $password = mysqli_real_escape_string($dbconnect, $password);

    $user_query = mysqli_query($dbconnect, "SELECT * FROM teachers WHERE email='$email' LIMIT 1");
    $user_result = mysqli_fetch_assoc($user_query);

    $id = $user_result['t_id'];
    $db_password = $user_result['password'];

    if (password_verify($password, $db_password) == true) {

        $_SESSION['user'] = $user_result['name'];
        $_SESSION['username'] = $email;
        $_SESSION['userid'] = $id;
        $_SESSION['elevation'] = $user_result['elevation'];
        $_SESSION['field_code'] = md5(uniqid('auth', true));
        $_SESSION['status'] = 'active';
        echo 'success';

    } else {
        echo 'invalid login';
    }
}
?>
