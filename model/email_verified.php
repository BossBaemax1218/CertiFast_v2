<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $verificationCode = $_POST['verification_code'];

    if (empty($verificationCode)) {
        $_SESSION['success'] = false;
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'login';
        $_SESSION['message'] = "Please enter the verification code.";

        header('Location: ../email-verify-code.php');
        exit();
    }

    function verifyEmail($verificationCode) {
        require '../server/server.php';
        $stmt = $conn->prepare("SELECT user_email FROM tbl_user_resident WHERE verification_code = ? AND account_status = 'unverified'");
        $stmt->bind_param("s", $verificationCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['user_email'];

            $stmt = $conn->prepare("UPDATE tbl_user_resident SET account_status = 'verified' WHERE user_email = ? AND verification_code = ?");
            $stmt->bind_param("ss", $email, $verificationCode);
            $stmt->execute();

            return $email;
        }

        return false;
    }


    if ($email = verifyEmail($verificationCode)) {
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
