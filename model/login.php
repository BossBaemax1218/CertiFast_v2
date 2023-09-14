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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
        if (isset($_SESSION['last_login_attempt']) && (time() - $_SESSION['last_login_attempt']) < 60) {
            $remaining_time = 60 - (time() - $_SESSION['last_login_attempt']);
            redirectToLoginPage('You have exceeded the maximum login attempts. Please try again in ' . $remaining_time . ' seconds.', 'danger', 'login');
        } else {
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_login_attempt'] = null;
        }
    }

    if ($user_email != '' && $password != '') {
        $query = "SELECT * FROM tbl_user_admin WHERE username = ? OR username = ? OR username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $user_email, $user_email, $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            $role = $row['user_type'];
            $is_active = $row['is_active'];
        
            if (password_verify($password, $hashedPassword)) {
                if ($is_active === 'active') {
                    $roleMessages = [
                        'administrator' => 'You have successfully logged in as an administrator!',
                        'staff' => 'You have successfully logged in as a staff employee!',
                        'purok leader' => 'You have successfully logged in as a purok leader!'
                    ];
        
                    if (isset($roleMessages[$role])) {
                        $_SESSION['message'] = $roleMessages[$role];
                        $_SESSION['success'] = 'success';
                        $_SESSION['role'] = $role;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['avatar'] = $row['avatar'];
        
                        header('location: ../dashboard.php');
                        exit();
                    }
                } else {
                    session_destroy();
                    header('location: ../error.php');
                    exit();
                }
            } else {
                echo "Password verification failed for admin/staff/purok leader.";
            }
        }

        $query = "SELECT * FROM tbl_user_resident WHERE user_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            $role = $row['user_type'];
        
            if (md5($password) === $hashedPassword) {
                if ($row['account_status'] === 'verified' && $row['is_active'] === 'active') {
                    $_SESSION['user_email'] = $row['user_email'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['role'] = $role;
                    $_SESSION['photo'] = $row['photo'];
        
                    $queryResidency = "SELECT residency_status FROM tblresident WHERE email = ?";
                    $stmtResidency = $conn->prepare($queryResidency);
                    $stmtResidency->bind_param("s", $user_email);
                    $stmtResidency->execute();
                    $resultResidency = $stmtResidency->get_result();
        
                    if ($resultResidency->num_rows) {
                        $rowResidency = $resultResidency->fetch_assoc();
                        if ($rowResidency['residency_status'] === 'approved') {
                            header('location: ../dashboard.php');
                        } elseif ($rowResidency['residency_status'] === 'on hold') {
                            header('location: ../resident_profiling.php');
                        } else {
                            echo "Unknown residency status.";
                        }
                    } else {
                        echo "No residency status found for this user.";
                    }
                    exit();
                } elseif ($row['is_active'] === 'inactive') {
                    $_SESSION['message'] = 'Your account has been deactivated. Please visit Barangay Los Amigos Office for further information.';
                    $_SESSION['user_email'] = $row['user_email'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['role'] = $role;
                    $_SESSION['photo'] = $row['photo'];
        
                    session_destroy();
        
                    header('location: ../error.php');
                    exit();
                } elseif ($row['account_status'] !== 'verified') {
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

        echo "Username or password is incorrect!";
        incrementLoginAttempts();
        redirectToLoginPage('Username or password is incorrect!', 'danger', 'login');
    } else {
        redirectToLoginPage('Please fill in all the required fields.', 'danger', 'login');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['logout'])) {
    header('location: ../login.php');
    exit();
} else {
    redirectToLoginPage('Invalid input credentials.', 'danger', 'login');
}

$conn->close();
?>
