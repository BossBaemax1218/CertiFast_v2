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
    session_destroy(); // Destroy all session data
    header('location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Check if the user has exceeded the maximum login attempts
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
        // Check if the user has waited for at least 1 minute
        if (isset($_SESSION['last_login_attempt']) && (time() - $_SESSION['last_login_attempt']) < 60) {
            $remaining_time = 60 - (time() - $_SESSION['last_login_attempt']);
            redirectToLoginPage('You have exceeded the maximum login attempts. Please try again in ' . $remaining_time . ' seconds.', 'danger', 'login');
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
        // Check if the user is a verified resident
        $residentQuery = "SELECT * FROM tbl_user_resident WHERE user_email = ? AND verification_status = '1'";
        $stmt = $conn->prepare($residentQuery);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $residentResult = $stmt->get_result();

        if ($residentResult->num_rows) {
            $row = $residentResult->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify the password using MD5 hashing
            if (md5($password) === $hashedPassword) {
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['role'] = $row['resident'];

                $_SESSION['message'] = 'You have successfully logged in as a resident!';
                $_SESSION['success'] = 'success';
                $_SESSION['form'] = 'login';

                header('location: ../resident_dashboard.php');
                exit();
            } else {
                echo "Password verification failed for resident.";
            }
        }
        incrementLoginAttempts();
        redirectToLoginPage('Username or password is incorrect!', 'danger', 'login');
    } else {
        redirectToLoginPage('Please fill in all the required fields.', 'danger', 'login');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    logout(); // Call logout function if the logout parameter is set in the URL
} else {
    redirectToLoginPage('Invalid request method.', 'danger', 'login');
}

$conn->close();
?>
