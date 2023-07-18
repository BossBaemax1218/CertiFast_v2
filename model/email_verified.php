<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the verification code from the form
    $verificationCode = $_POST['verification_code'];

    // Check if the verification code is empty
    if (empty($verificationCode)) {
        // Handle the case when the verification code is not provided
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'login';
        $_SESSION['message'] = "Please enter the verification code.";

        // Redirect the user back to the verification code page
        header('Location: ../email-verify-code.php');
        exit();
    }

    // Function to verify the email with the provided verification code
    function verifyEmail($verificationCode) {
        // Include the configuration file
        require '../server/server.php';

        // Retrieve the email associated with the verification code from the database
        $stmt = $conn->prepare("SELECT user_email FROM tbl_user_resident WHERE verification_code = ? AND account_status = 'unverified'");
        $stmt->bind_param("s", $verificationCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['user_email'];

            // Update the verification status in the database
            $stmt = $conn->prepare("UPDATE tbl_user_resident SET account_status = 'verified' WHERE user_email = ? AND verification_code = ?");
            $stmt->bind_param("ss", $email, $verificationCode);
            $stmt->execute();

            return $email;
        }

        return false;
    }


    if ($email = verifyEmail($verificationCode)) {
        // Email verification is successful
        $_SESSION['success'] = true;
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'login';
        $_SESSION['message'] = "Your email has been verified.";

        header('Location: ../login.php');
        exit();
    } else {
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'login';
        $_SESSION['message'] = "Invalid or expired verification code.";

        header('Location: ../email-verify-code.php');
        exit();
    }
}
?>
