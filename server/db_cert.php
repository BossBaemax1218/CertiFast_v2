<?php
    date_default_timezone_set('Asia/Manila');

$host = 'localhost';
$dbname = 'db_certifast';
$username = 'root';
$password = '';

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>