<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the new password from the form
    $newPassword = $_POST['password'];

    // Function to update the password in the database
    function updatePassword($newPassword, $email) {
        // Include the configuration file
        require '../server/server.php';

        // Hash the new password using SHA1 for security
        $hashedPassword = sha1($newPassword);

        // Update password in tbl_user_resident
        $stmt = $conn->prepare("UPDATE tbl_user_resident SET password = ? WHERE user_email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();

        // Update password in tbl_user_admin
        $stmt = $conn->prepare("UPDATE tbl_user_admin SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();

        return true;
    }

    // Validate the new password
    function validatePassword($password) {
        // Minimum password length of 8 characters
        if (strlen($password) < 8) {
            return false;
        }

        // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
        if (!preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/\d/", $password)) {
            return false;
        }

        // Check if the password contains at least one special character
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
            return false;
        }

        return true;
    }

    // Update the password
    if (validatePassword($newPassword)) {
        // Get the verified email from tblverify
        $verificationCode = $_SESSION['verification_code']; // Assuming you store the verification code in a session variable

        // Include the configuration file
        require '../server/server.php';

        $stmt = $conn->prepare("SELECT email FROM tblverify WHERE code = ? AND verified = 1");
        $stmt->bind_param("s", $verificationCode);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email);
            $stmt->fetch();

            if (updatePassword($newPassword, $email)) {
                // Password update successful
                $_SESSION['success'] = true;
                $_SESSION['success'] = 'success';
                $_SESSION['message'] = "Password updated successfully.";
                header('Location: ../login.php');
                exit();
            } else {
                // Database error occurred
                $_SESSION['success'] = false;
                $_SESSION['success'] = 'danger';
                $_SESSION['message'] = "An error occurred while updating the password.";
                header('Location: ../new_password.php');
                exit();
            }
        } else {
            // Invalid verification code or email not verified
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['message'] = "Invalid verification code or email not verified.";
            header('Location: ../new_password.php');
            exit();
        }
    } else {
        // Invalid password
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['message'] = "Invalid password. Please make sure the password meets the requirements.";
        header('Location: ../new_password.php');
        exit();
    }
}
?>
