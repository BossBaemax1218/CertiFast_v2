<?php
session_start();
include '../server/server.php';
require '../password_compat/lib/password.php'; 

$user_email = $conn->real_escape_string($_POST['email']);
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
    // Check if the user is an admin or staff
    $adminStaffQuery = "SELECT * FROM tbl_user_admin WHERE username = ?";
    $stmt = $conn->prepare($adminStaffQuery);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $adminStaffResult = $stmt->get_result();

    if ($adminStaffResult->num_rows) {
        $row = $adminStaffResult->fetch_assoc();
        $hashedPassword = $row['password'];

        // Retrieve the password hash
        echo "Password hash for admin/staff: " . $hashedPassword;

        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            $role = $row['user_type'];

            if ($role == 'administrator') {
                $_SESSION['message'] = 'You have successfully logged in as an administrator!';
                $_SESSION['success'] = 'success';
            } elseif ($role == 'staff') {
                $_SESSION['message'] = 'You have successfully logged in as a staff employee!';
                $_SESSION['success'] = 'success';
            }

            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $role;
            $_SESSION['avatar'] = $row['avatar'];

            header('location: ../dashboard.php');
            exit();
        } else {
            echo "Password verification failed for admin/staff.";
        }
    }

    // Check if the user is a staff
    $staffQuery = "SELECT * FROM tbl_user_staff WHERE username = ?";
    $stmt = $conn->prepare($staffQuery);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $staffResult = $stmt->get_result();

    if ($staffResult->num_rows) {
        $row = $staffResult->fetch_assoc();
        $hashedPassword = $row['password'];

        // Retrieve the password hash
        echo "Password hash for staff: " . $hashedPassword;

        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['message'] = 'You have successfully logged in as a staff!';
            $_SESSION['success'] = 'success';
            $_SESSION['form'] = 'login';

            header('location: ../staff_dashboard.php');
            exit();
        } else {
            echo "Password verification failed for staff.";
        }
    }

    // Check if the user is a verified resident
    $residentQuery = "SELECT * FROM tbl_user_resident WHERE user_email = ?";
    $stmt = $conn->prepare($residentQuery);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $residentResult = $stmt->get_result();

    if ($residentResult->num_rows) {
        $row = $residentResult->fetch_assoc();
        $hashedPassword = $row['password'];

        // Retrieve the password hash
        echo "Password hash for resident: " . $hashedPassword;

        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['message'] = 'You have successfully logged in as a resident!';
            $_SESSION['success'] = 'success';
            $_SESSION['form'] = 'login';

            header('location: ../resident_dashboard.php');
            exit();
        } else {
            echo "Password verification failed for resident.";
        }
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
    $_SESSION['message'] = 'Please fill in all the required fields.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'login';

    header('location: ../login.php');
    exit();
}

$conn->close();
?>
