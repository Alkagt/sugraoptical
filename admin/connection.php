<?php
session_start();
define("BASE_URL", "https://" . $_SERVER['HTTP_HOST'] . "/admin");
define("BASE_FRONT_URL", "https://" . $_SERVER['HTTP_HOST']);
$hostname = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";
$conn = mysqli_connect("localhost","username","password","database_name");
?>