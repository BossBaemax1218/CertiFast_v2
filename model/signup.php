<?php
session_start();
include '../server/server.php';

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function redirectToSignupPage($message, $success)
{
    $_SESSION['message'] = $message;
    $_SESSION['success'] = $success;
    $_SESSION['form'] = 'signup';

    header('Location: ../signup.php');
    exit();
}

function redirectToLoginPage($message, $success)
{
    $_SESSION['message'] = $message;
    $_SESSION['success'] = $success;
    $_SESSION['form'] = 'login';

    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purok = $conn->real_escape_string($_POST['purok']);
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $password = $conn->real_escape_string($_POST['password']);

    $min_password_length = 8;
    $has_symbol = preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-=\']/', $password);
    $has_capital_letter = preg_match('/[A-Z]/', $password);

    if (empty($purok) || empty($fullname) || empty($email) || empty($address) || empty($password)) {
        redirectToSignupPage('Please fill in all the required fields.', 'danger');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirectToSignupPage('Invalid email address format.', 'danger');
    }

    if (strlen($password) < $min_password_length || !$has_symbol || !$has_capital_letter) {
        redirectToSignupPage('Password must be unique and strong.', 'danger');
    }

    $checkQueryResident = "SELECT * FROM tbl_user_resident WHERE user_email = ?";
    $stmt = $conn->prepare($checkQueryResident);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultResident = $stmt->get_result();

    if ($resultResident->num_rows > 0) {
        redirectToSignupPage('Email already exists. Please choose a different one.', 'danger');
    }

    $verificationCode = substr(md5(uniqid(rand(), true)), 0, 6);
    $verificationExpire = time() + (5 * 60);
    $verificationSend = date('Y-m-d H:i:s', strtotime('+5 minutes'));

    $year = date("Y");

    $_SESSION['verification_code'] = $verificationCode;
    $_SESSION['verification_send'] = $verificationSend;

    $mail = new PHPMailer();
    $mail->setFrom('no-reply@gmail.com', 'Barangay Los Amigos - CertiFast');
    $mail->addAddress($email);
    $mail->Subject = 'Your email verification code has been sent';
    $mail->isHTML(true);
    $mail->Body =  '<!DOCTYPE html>
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
                                                Please note that this verification code is valid one time only. <br>
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

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'barangaylosamigos.certifast@gmail.com';
    $mail->Password = 'ipqostilxutxmbxl';
    $mail->Port = 587;

    if ($mail->send()) {
        $hashedPassword = md5($password);

        $insertQuery = "INSERT INTO tbl_user_resident (`purok`, `fullname`, `user_email`, `address`, `password`,`user_type`, `verification_code`, `verification_send`, `account_status`,`is_active`) VALUES (?, ?, ?, ?, ?,'resident', ?, ?, 'unverified','active')";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssssss", $purok, $fullname, $email, $address, $hashedPassword, $verificationCode, $verificationSend);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'You have succesfully registered! Please check your email to verify your account.';
            $_SESSION['success'] = 'success';
            $_SESSION['form'] = 'login';

            header('Location: ../email-verify-code.php');
            exit();
        } else {
            redirectToSignupPage('Unable to sign up. Please try again later.', 'danger');
        }
    } else {
        redirectToSignupPage('Unable to send email. Please try again later.', 'danger');
    }
}

$conn->close();
?>
