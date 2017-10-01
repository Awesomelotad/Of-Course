<?php
ini_set('display_errors', 'on');
define('DB_NAME', 'of_course_alpha0');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
$dbconnect = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
if (mysqli_connect_errno()){echo 'Connection failed:'.mysqli_connect_error();exit;}
?>