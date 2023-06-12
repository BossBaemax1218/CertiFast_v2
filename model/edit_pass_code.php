<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the verification code from the form
    $verificationCode = $_POST['verification_code'];

    // Function to verify the email with the provided verification code
    function verifyEmail($code) {
        // Include the configuration file
        require '../server/server.php';

        // Retrieve the email associated with the verification code from the database
        $stmt = $conn->prepare("SELECT user_email FROM tbl_user_resident WHERE verification_code = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Verification code is valid, update the verification status in the database
            $email = $result->fetch_assoc()['user_email'];
            $stmt = $conn->prepare("UPDATE tbl_user_resident SET verification_status = 1 WHERE user_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            return $email;
        }

        return false;
    }

    // Check if the verification code is empty
    if (empty($verificationCode)) {
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Please enter the verification code.";

        // Redirect the user back to the verification code page
        header('Location: ../reset-code.php');
        exit();
    }

    // Verify the email with the provided verification code
    if ($email = verifyEmail($verificationCode)) {
        // Email verification is successful
        $_SESSION['success'] = true;
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Verification code for a new password has been confirmed.";

        // Redirect the user to the password validation page
        header('Location: ../new_password.php');
        exit();
    } else {
        // Email verification failed
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Invalid verification code.";

        // Redirect the user back to the verification code page
        header('Location: ../reset-code.php');
        exit();
    }
}
?>
