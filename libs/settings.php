<?php

if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('USERNAME')) {
    define('USERNAME', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}
if (!defined('DATABASE')) {
    define('DATABASE', 'coursesdb');
}

$connection = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

if (mysqli_connect_errno() > 0) {
    die("Error: " . mysqli_connect_error());
}

?>
