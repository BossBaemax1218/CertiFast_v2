<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    function validatePasswords($newPassword, $confirmPassword) {
        if (strlen($newPassword) < 8) {
            return "Password should be at least 8 characters long.";
        }

        if (!preg_match("/[A-Z]/", $newPassword) || !preg_match("/[a-z]/", $newPassword) || !preg_match("/\d/", $newPassword)) {
            return "Password should contain at least one uppercase letter, one lowercase letter, and one digit.";
        }

        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $newPassword)) {
            return "Password should contain at least one special character.";
        }

        if ($newPassword !== $confirmPassword) {
            return "Passwords do not match.";
        }

        return "";
    }

    function updatePassword($email, $newPassword) {
        require '../server/server.php';
        $encryptedPassword = md5($newPassword);
        $stmt = $conn->prepare("UPDATE tbl_user_resident SET password = ? WHERE user_email = ?");
        if (!$stmt) {
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['message'] = "Database error: " . $conn->error;
            header('Location: ../reset-password.php');
            exit();
        }

        $stmt->bind_param("ss", $encryptedPassword, $email);
        if (!$stmt->execute()) {
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['message'] = "Failed to update password: " . $stmt->error;
            header('Location: ../reset-password.php');
            exit();
        }

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    $validationMessage = validatePasswords($newPassword, $confirmPassword);
    if (empty($validationMessage)) {
        if (updatePassword($email, $newPassword)) {
            $_SESSION['success'] = true;
            $_SESSION['success'] = 'success';
            $_SESSION['form'] = 'login';
            $_SESSION['message'] = "New password has been changed successfully.";

            header('Location: ../login.php');
            exit();
        } else {
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['form'] = 'signup';
            $_SESSION['message'] = "An error occurred while updating the password.";

            header('Location: ../reset-password.php');
            exit();
        }
    } else {
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'warning';
        $_SESSION['form'] = 'signup';
        $_SESSION['validationMessage'] = $validationMessage;
        $_SESSION['message'] = "" . $validationMessage;

        header('Location: ../reset-password.php');
        exit();
    }
} else {
    $email = $_GET['email'];
    $_SESSION['email'] = $email;
}
?>
