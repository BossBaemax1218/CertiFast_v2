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

        // Update password in tbl_user_resident for the given email
        $stmt = $conn->prepare("UPDATE tbl_user_resident SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
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
        
        // Check if the new password is the same as the old password
        if ($password === $oldPassword) {
            return false;
        }

        return true;
    }

    // Update the password
    if (validatePassword($newPassword)) {
        // Include the configuration file
        require '../server/server.php';

        // Retrieve the email associated with the user
        // Modify this line based on how you retrieve the email from the user session or database
        $email = $_SESSION['email'];

        if (updatePassword($newPassword, $email)) {
            // Password update successful
            $_SESSION['success'] = true;
            $_SESSION['success'] = 'success';
            $_SESSION['form'] = 'login';
            $_SESSION['message'] = "New password has been updated successfully.";
            header('Location: ../login.php');
            exit();
        } else {
            // Database error occurred
            $_SESSION['success'] = false;
            $_SESSION['success'] = 'danger';
            $_SESSION['form'] = 'signup';
            $_SESSION['message'] = "An error occurred while updating the password.";
            header('Location: ../new_password.php');
            exit();
        }
    } else {
        // Invalid password
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Invalid password. Please make sure the password meets the requirements and is different from the old password.";
        header('Location: ../new_password.php');
        exit();
    }
}
?>
