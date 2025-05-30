<?php
error_reporting(0);
session_start();

$db_connection = 0;
$query = 0;
$error_message = "";

$db_connection = @mysqli_connect("localhost", "cloud_user", "");
mysqli_select_db($db_connection, "cloud_db");
$query = mysqli_query($db_connection, "SET NAMES 'utf8'");

?>