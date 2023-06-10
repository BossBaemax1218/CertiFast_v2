<?php
session_start();
include '../server/server.php';

$user_email = $conn->real_escape_string($_POST['user_email']);
$password = $conn->real_escape_string($_POST['password']);

if ($user_email != '' && $password != '') {
    // Check if the user is a verified resident
    $residentQuery = "SELECT * FROM tbl_user_resident WHERE user_email = ? AND password = SHA1(?) AND verifystatus = 1";
    $stmt = $conn->prepare($residentQuery);
    $stmt->bind_param("ss", $user_email, $password);
    $stmt->execute();
    $residentResult = $stmt->get_result();

    if ($residentResult->num_rows) {
        $row = $residentResult->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['role'] = 'resident';

        $_SESSION['message'] = 'You have successfully logged in as a resident!';
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'login';

        header('location: ../resident_request.php');
        exit();
    }

    // Check if the user is an admin or staff
    $adminStaffQuery = "SELECT * FROM tbl_user_admin WHERE username = ? AND password = SHA1(?)";
    $stmt = $conn->prepare($adminStaffQuery);
    $stmt->bind_param("ss", $user_email, $password);
    $stmt->execute();
    $adminStaffResult = $stmt->get_result();

    if ($adminStaffResult->num_rows) {
        $row = $adminStaffResult->fetch_assoc();
        $role = $row['user_type'];

        if ($role == 'administrator') {
            $_SESSION['message'] = 'You have successfully logged in as an admin!';
            $_SESSION['success'] = 'success';
        } elseif ($role == 'staff') {
            $_SESSION['message'] = 'You have successfully logged in as a staff!';
            $_SESSION['success'] = 'success';
        }

        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $role;
        $_SESSION['avatar'] = $row['avatar'];

        header('location: ../dashboard.php');
        exit();
    }

    $_SESSION['message'] = 'Username or password is incorrect!';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'login';

    header('location: ../login.php');
    exit();
} else {
    $_SESSION['message'] = 'Username or password is empty!';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'login';

    header('location: ../login.php');
    exit();
}

$conn->close();
?>
