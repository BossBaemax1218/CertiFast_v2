<?php
session_start();
include '../server/server.php';

function incrementLoginAttempts()
{
    $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
    $_SESSION['last_login_attempt'] = time();
}

function redirectToLoginPage($message, $success, $form)
{
    $_SESSION['message'] = $message;
    $_SESSION['success'] = $success;
    $_SESSION['form'] = $form;
    header('location: ../login.php');
    exit();
}

function logout()
{
    session_destroy();
    header('location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $residentQuery = "SELECT * FROM tbl_user_resident WHERE user_email = ?";
    $stmt = $conn->prepare($residentQuery);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $residentResult = $stmt->get_result();

    if ($residentResult->num_rows) {
        $row = $residentResult->fetch_assoc();
        $hashedPassword = $row['password'];

        if (md5($password) === $hashedPassword) {
            if ($row['account_status'] === 'verified') {
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['role'] = 'resident';

                $_SESSION['message'] = 'You have successfully logged in as a resident!';
                $_SESSION['success'] = 'success';
                $_SESSION['form'] = 'login';

                header('location: ../resident_dashboard.php');
                exit();
            } else {
                $_SESSION['message'] = 'Your account has not yet been verified. Please check your email for the last verification code.';
                $_SESSION['success'] = 'danger';
                $_SESSION['form'] = 'login';

                header('location: ../email-verify-code.php');
                exit();
            }
        } else {
            echo "Password verification failed for resident.";
        }
    }

    if ($user_email != '' && $password != '') {
        $adminStaffQuery = "SELECT * FROM tbl_user_admin WHERE username = ?";
        $stmt = $conn->prepare($adminStaffQuery);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $adminStaffResult = $stmt->get_result();

        if ($adminStaffResult->num_rows) {
            $row = $adminStaffResult->fetch_assoc();
            $hashedPassword = $row['password'];
            $role = $row['user_type'];

            if (password_verify($password, $hashedPassword)) {
                if ($role == 'administrator' || $role == 'staff' || $role == 'purok leader') {
                    $_SESSION['message'] = 'You have successfully logged in as a ' . $role . '!';
                    $_SESSION['success'] = 'success';
                    $_SESSION['role'] = $role;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['avatar'] = $row['avatar'];

                    header('location: ../dashboard.php');
                    exit();
                }
            } else {
                echo "Password verification failed for admin/staff/purok leader.";
            }
        }
    }

    $conn->close();
}
?>
