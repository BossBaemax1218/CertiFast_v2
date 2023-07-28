<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $verificationCode = $_POST['verification_code'];

    if (empty($verificationCode)) {
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Please enter the verification code.";

        header('Location: ../password-verify-code.php');
        exit();
    }

    function verifyEmail($email, $code) {
        require '../server/server.php';

        $stmt = $conn->prepare("SELECT user_email FROM tbl_user_resident WHERE user_email = ? AND verification_code = ?");
        $stmt->bind_param("ss", $email, $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE tbl_user_resident SET account_status = 'verified' WHERE user_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            return $email;
        }

        return false;
    }

    if ($email = verifyEmail($email, $verificationCode)) {
        $_SESSION['success'] = true;
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Verification code for a new password has been confirmed.";

        header('Location: ../reset-password.php');
        exit();
    } else {
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        $_SESSION['message'] = "Invalid or expired verification code.";

        header('Location: ../password-verify-code.php');
        exit();
    }
}
?>
