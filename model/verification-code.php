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
        $stmt = $conn->prepare("SELECT email FROM tblverify WHERE verifycode = ?");
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Verification code is valid, update the verification status in the database
            $email = $result->fetch_assoc()['email'];
            $stmt = $conn->prepare("UPDATE tblverify SET verified = 1 WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            return true;
        }

        return false;
    }

    // Verify the email with the provided verification code
    if (verifyEmail($verificationCode)) {
        // Email verification is successful
        $_SESSION['success'] = true;
        $_SESSION['success'] = 'success';
        $_SESSION['message'] = "Email verification successful.";

        // Redirect the user to the success page or any other desired location
        header('Location: ../password-validation.php');
        exit();
    } else {
        // Email verification failed
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['message'] = "Invalid verification code.";

        // Redirect the user back to the verification code page
        header('Location: ../verificationcode.php');
        exit();
    }
}