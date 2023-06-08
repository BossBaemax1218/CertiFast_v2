<?php
session_start();

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include server configuration
include '../server/server.php';

// Function to generate a verification code
function generateVerificationCode() {
    // Generate a random verification code (you can modify this according to your requirements)
    $verificationCode = substr(md5(uniqid(rand(), true)), 0, 6);
    return $verificationCode;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the email address from the form
    $email = $_POST['email'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Configure SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cyberlez12345@gmail.com';
        $mail->Password = 'twzsdnottybfwfcm';
        $mail->Port = 587;

        // Set the email details
        $mail->setFrom('no-reply@gmail.com', 'Barangay Los Amigos - CertiFast');
        $mail->addAddress($email);
        $mail->Subject = 'Forgot Password Verification Code';

        // Check if the email address is already registered
        $stmt = $conn->prepare("SELECT * FROM tbl_user_resident WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email address exists, generate a verification code and send it
            $verificationCode = generateVerificationCode();
            $mail->Body = 'Your verification code is: ' . $verificationCode;

            // Store the verification code in the database
            $verifycode = $verificationCode;
            $expire = date('Y-m-d H:i:s', strtotime('+5 minutes'));
            $stmt = $conn->prepare("INSERT INTO tblverify (verifycode, expires, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $verifycode, $expire, $email);
            $stmt->execute();

            // Send the email
            if ($mail->send()) {
                // Email sent successfully
                // Redirect the user to the verification code confirmation page
                $_SESSION['message'] = 'Verification code sent successfully.';
                $_SESSION['success'] = 'success';
                $_SESSION['form'] = 'signup';
                header('Location: ../verificationcode.php');
                exit();
            } else {
                // Email sending failed
                $_SESSION['message'] = 'Email sending failed.';
                $_SESSION['success'] = 'danger';
                $_SESSION['form'] = 'signup';
                header('Location: ../forgot-password.php');
                exit();
            }
        } else {
            // Email address does not exist
            $_SESSION['message'] = 'Email address does not exist.';
            $_SESSION['success'] = 'danger';
            $_SESSION['form'] = 'signup';
            header('Location: ../forgot-password.php');
            exit();
        }
    } catch (Exception $e) {
        // Exception occurred
        $_SESSION['message'] = 'An error occurred: ' . $mail->ErrorInfo;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        header('Location: ../forgot-password.php');
        exit();
    }
}
?>
