<?php
session_start();
include '../server/server.php';

$user_email = $conn->real_escape_string($_POST['user_email']);
$password = $conn->real_escape_string($_POST['password']);

// Check if the user has exceeded the maximum login attempts
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
    // Check if the user has waited for at least 1 minute
    if (isset($_SESSION['last_login_attempt']) && (time() - $_SESSION['last_login_attempt']) < 60) {
        $remaining_time = 60 - (time() - $_SESSION['last_login_attempt']);
        $_SESSION['message'] = 'You have exceeded the maximum login attempts. Please try again in ' . $remaining_time . ' seconds.';
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'login';

        header('location: ../login.php');
        exit();
    } else {
        // Reset the login attempts and last login attempt time
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_login_attempt'] = null;
    }
}

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

        header('location: ../resident_dashboard.php');
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

    // Increment the login attempts and set the last login attempt time
    $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
    $_SESSION['last_login_attempt'] = time();

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
