<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the email from the form
    $email = $_POST['email'];

    // Retrieve the new password and confirm password from the form
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate the new password and confirm password
    function validatePasswords($newPassword, $confirmPassword) {
        // Minimum password length of 8 characters
        if (strlen($newPassword) < 8) {
            return "Password should be at least 8 characters long.";
        }

        // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
        if (!preg_match("/[A-Z]/", $newPassword) || !preg_match("/[a-z]/", $newPassword) || !preg_match("/\d/", $newPassword)) {
            return "Password should contain at least one uppercase letter, one lowercase letter, and one digit.";
        }

        // Check if the password contains at least one special character
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $newPassword)) {
            return "Password should contain at least one special character.";
        }

        // Check if the new password is the same as the confirm password
        if ($newPassword !== $confirmPassword) {
            return "Passwords do not match.";
        }

        return "";
    }

    // Function to update the password in the database
    function updatePassword($email, $newPassword) {
        // Include the configuration file and connect to the database
        require '../server/server.php';

        // MD5 encrypt the new password
        $encryptedPassword = md5($newPassword);

        // Update password in tbl_user_resident for the specific email
        $stmt = $conn->prepare("UPDATE tbl_user_resident SET password = ? WHERE user_email = ?");
        if (!$stmt) {
            // Handle the error gracefully
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['message'] = "Database error: " . $conn->error;
            header('Location: ../reset-password.php');
            exit();
        }

        $stmt->bind_param("ss", $encryptedPassword, $email);
        if (!$stmt->execute()) {
            // Handle the error gracefully
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

    // Validate the new password and confirm password
    $validationMessage = validatePasswords($newPassword, $confirmPassword);
    if (empty($validationMessage)) {
        if (updatePassword($email, $newPassword)) {
            // Password update successful
            $_SESSION['success'] = true;
            $_SESSION['success'] = 'success';
            $_SESSION['form'] = 'login';
            $_SESSION['message'] = "New password has been changed successfully.";

            header('Location: ../login.php');
            exit();
        } else {
            // Database error occurred
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['form'] = 'signup';
            $_SESSION['message'] = "An error occurred while updating the password.";

            header('Location: ../reset-password.php');
            exit();
        }
    } else {
        // Invalid password or passwords don't match
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'warning';
        $_SESSION['form'] = 'signup';
        $_SESSION['validationMessage'] = $validationMessage;
        $_SESSION['message'] = "" . $validationMessage;

        header('Location: ../reset-password.php');
        exit();
    }
} else {
    // Retrieve the email from the query parameters
    $email = $_GET['email'];

    // Store the email in the session
    $_SESSION['email'] = $email;
}
?>
