<?php
session_start();

// Include the configuration file
require '../server/server.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the verification code and new password from the form
    $verificationCode = $_POST['verification_code'];
    $newPassword = $_POST['new_password'];

    // Function to check if the verification code is valid
    function isVerificationCodeValid($code) {
        // Retrieve the verification code details from the database
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM tblverify WHERE verifycode = ? AND expires > NOW()");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Verification code is valid
            return true;
        }

        return false;
    }

    // Function to update the password in the database
    function updatePassword($verificationCode, $newPassword) {
        // Update password in tbl_user_resident
        global $conn;
        $stmt = $conn->prepare("UPDATE tbl_user_resident SET password = ? WHERE email IN (SELECT email FROM tblverify WHERE verifycode = ?)");
        $stmt->bind_param("ss", $newPassword, $verificationCode);
        $stmt->execute();

        // Update password in tbl_users
        $stmt = $conn->prepare("UPDATE tbl_users SET password = ? WHERE email IN (SELECT email FROM tblverify WHERE verifycode = ?)");
        $stmt->bind_param("ss", $newPassword, $verificationCode);
        $stmt->execute();
    }

    // Check if the verification code is valid
    if (isVerificationCodeValid($verificationCode)) {
        // Verification code is valid, update the password
        updatePassword($verificationCode, $newPassword);

        // Set session variables for successful password reset
        $_SESSION['password_reset_success'] = true;

        // Redirect the user to the password reset success page
        header('Location: ../password-validation.php');
        exit();
    } else {
        // Verification code is invalid or expired
        $_SESSION['password_reset_success'] = false;

        // Redirect the user back to the verification code page
        header('Location: ../verificationcode.php');
        exit();
    }
}
?>
