<?php
session_start();
include '../server/db_connect.php';

function deleteAccount($connection, $email)
{
    $email = mysqli_real_escape_string($connection, $email);

    $query = "DELETE u.* FROM tbl_user_resident AS u WHERE u.user_email = '$email'";

    if (mysqli_query($connection, $query)) {

        return true;
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $result = deleteAccount($connection, $email);
        if ($result) {
            session_destroy();
            header('Location: ../index.php');
            exit();
        } else {
            header('Location: ../resident_dashboard.php');
            exit();
        }
    } else {
        header('Location: ../resident_dashboard.php');
        exit();
    }
}

mysqli_close($connection);
?>
