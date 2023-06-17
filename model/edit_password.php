<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the email and verification code from the form
    $email = $_POST['email'];
    $verificationCode = $_POST['verification_code'];

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

        // Hash the new password using SHA1 for security
        $hashedPassword = sha1($newPassword);

        // Update password in tbl_user_resident for the specific email and verification code
        $stmt = $conn->prepare("UPDATE tbl_user_resident SET password = ? WHERE email = ? AND verification_code = ?");
        $stmt->bind_param("sss", $hashedPassword, $email, $verificationCode);
        $stmt->execute();

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
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        $_SESSION['validationMessage'] = $validationMessage;

        header('Location: ../reset-password.php');
        exit();
    }
} else {
    // Redirect to the email form if the request is not a POST request
    header('Location: ../forgot-password.php');
    exit();
}
?>  
