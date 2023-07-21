<?php
    include '../server/server.php';
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['user_email']);
    unset($_SESSION['role']);

    session_start();
    $_SESSION['message'] = "You have been logged out!";
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'login';


    header('location: ../login.php');
?>
