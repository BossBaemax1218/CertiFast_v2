<?php
session_start();
include '../server/server.php';

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$fullname = $conn->real_escape_string($_POST['fullname']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Validate email, password, and name
if (empty($fullname) || empty($email) || empty($password)) {
    $_SESSION['message'] = 'Please fill in all the required fields.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../signup.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Invalid email address format.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../signup.php');
    exit();
}

// Check if the email already exists in tbl_user_resident
$checkQueryResident = "SELECT * FROM tbl_user_resident WHERE user_email = '$email'";
$resultResident = $conn->query($checkQueryResident);

if ($resultResident->num_rows > 0) {
    $_SESSION['message'] = 'Email already exists. Please choose a different one.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../signup.php');
    exit();
}

// Generate verification code
$verificationCode = substr(md5(uniqid(rand(), true)), 0, 6);
$verificationExpire = time() + (5 * 60); // 5 minutes
$verificationSend = date('Y-m-d H:i:s', strtotime('+5 minutes'));

$year = date("Y");

// Store verification code and expiration time in session
$_SESSION['verification_code'] = $verificationCode;
$_SESSION['verification_send'] = $verificationSend;

// Send verification code to email
$mail = new PHPMailer();
$mail->setFrom('no-reply@gmail.com', 'Barangay Los Amigos - CertiFast');
$mail->addAddress($email);
$mail->Subject = 'Your email verification code has been sent';
$mail->isHTML(true);
$mail->Body = '<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f1f6fe;" leftmargin="0">
    <table cellspacing="0" border-raduis="0" cellpadding="0" width="100%" background-color="#f1f6fe"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: \'Open Sans\', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f1f6fe; max-width:670px; margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px;text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">

                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;color:#E42654;font-family:\'Rubik\',sans-serif;">
                                        <h1 style="font-size:45px;"><strong>CertiFast</strong></h1>                                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500;font-size:24px;margin-bottom:20px;">Hi, ' . $email . '</h1>
                                        <p style="color:#455056; font-size:14px;line-height:24px; margin-bottom:20px;">
                                            We have received a request to verified your email address. Please use the following verification code to verified your account:
                                        </p>
                                        <p style="font-size:35px; color:#E42654; font-weight:bold;margin-bottom:10px;">' . $verificationCode . '</p>
                                        <p style="color:#455056; font-size:13px;line-height:24px;margin-bottom:20px;">
                                            Please note that this verification code is valid for 10 minutes only. <br>
                                            If you did not request a verification, please ignore this email.
                                        </p>
                                        <p style="color:#455056; font-size:14px;line-height:24px;margin-bottom:20px;">
                                            Regards,<br>
                                            Barangay Los Amigos - CertiFast Team
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px;color:#455056; line-height:18px; margin-bottom:0;">&copy; ' . $year . ' CertiFast. All rights reserved.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

// SMTP configuration if required
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'barangaylosamigos.certifast@gmail.com';
$mail->Password = 'ipqostilxutxmbxl';
$mail->Port = 587;

if ($mail->send()) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO tbl_user_resident (`fullname`, `user_email`, `password`, `verification_code`, `verification_send`, `verification_status`) VALUES ('$fullname', '$email', '$hashedPassword', '$verificationCode', '$verificationSend', 0)";

    if ($conn->query($query)) {
        $_SESSION['message'] = 'You have registered successfully! We sent a verification code to verify your account, please check your email.';
        $_SESSION['success'] = 'success';
        $_SESSION['form'] = 'signup';

        header('Location: ../email-verify-code.php');
        exit();
    } else {
        $_SESSION['message'] = 'Unable to sign up. Please try again later.';
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';

        header('Location: ../signup.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Unable to send email. Please try again later.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../signup.php');
    exit();
}

$conn->close();

?>
