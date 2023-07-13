<?php
    date_default_timezone_set('Asia/Manila');

    $database	= 'db_certifast';
    $username	= 'root';
    $host		= 'localhost';
    $password	= '';

    ini_set('display_errors',1);
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED | E_STRICT);
    // error_reporting(0);

    $conn = new mysqli($host,$username,$password,$database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(!isset($_SESSION)){
        session_start();	
    }
    
    if(!isset($_SESSION['fullname'])){
        header('Location: login.php');
    }
?>
