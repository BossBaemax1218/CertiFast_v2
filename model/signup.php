<?php
session_start();
include '../server/server.php';

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$fullname = $conn->real_escape_string($_POST['fullname']);
$email = $conn->real_escape_string($_POST['user_email']);
$password = $conn->real_escape_string($_POST['password']);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Invalid email format.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';
    
    header('Location: ../login.php');
    exit();
}

// Validate password strength
if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
    $_SESSION['message'] = 'Invalid password must contain unique characters, uppercase, lowercase, and numbers.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

// Check if the email already exists in tbl_user_resident
$checkQueryResident = "SELECT * FROM tbl_user_resident WHERE user_email = '$email'";
$resultResident = $conn->query($checkQueryResident);

if ($resultResident->num_rows > 0) {
    $_SESSION['message'] = 'Email already exists, choose a different one.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

// Generate verification code
$verificationCode = substr(md5(uniqid(rand(), true)), 0, 6);

// Store verification code and expiration time in session
$_SESSION['verification_code'] = $verificationCode;
$_SESSION['verification_expiration'] = time() + (5 * 60); // 5 minutes

// Send verification code to email
$mail = new PHPMailer();
$mail->setFrom('no-reply@gmail.com', 'Barangay Los Amigos - CertiFast');
$mail->addAddress($email);
$mail->Subject = 'Email Verification';
$mail->isHTML(true);
$mail->Body = '
    <!DOCTYPE html>
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
                    <table style="background-color: #f1f6fe; max-width:670px;  margin: 0 auto;" width="100%" border-raduis="0"
                        text-align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="95%" border-raduis="0" text-align="center" cellpadding="0" cellspacing="0"
                                    style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                    <tr>
                                        <td style="height:20px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;color:#E42654;font-family:\'Rubik\',sans-serif;">
                                            <h1 style="font-size:45px;"><strong>CertiFast</strong></h1><h3 style="color:#1e1e2d; font-size:25px;">Barangay Los Amigos</h3>                                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0 35px;">
                                            <h3 style="color:#1e1e2d; font-weight:500; margin:0;font-size:18px;font-family:\'Rubik\',sans-serif;">You have requested to reset your password</h3>
                                            <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                            <p style="color:#455056; font-size:16px;line-height:24px; margin:0;"> We cannot simply send you your old password. To reset your password, copy & paste the following code.</p>
                                            <a href="javascript:void(0);"
                                                style="background:#E42654;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:20px;padding:10px 24px;display:inline-block;border-radius:5px;">'.$verificationCode.'</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">
                                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.certifastlosamigos.com</strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:40px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        <tr>
                            <td style="height:20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="height:80px;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>
';

    // SMTP configuration if required
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'barangaylosamigos.certifast@gmail.com';
    $mail->Password = 'ipqostilxutxmbxl';
    $mail->Port = 587;

if ($mail->send()) {
    // Register the user
    if (!empty($fullname) && !empty($email) && !empty($password)) {
        // Hash the password using SHA1
        $hashedPassword = sha1($password);
        $codesend = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime('now')));

        $query = "INSERT INTO tbl_user_resident (`fullname`, `user_email`, `password`, `verifycode`, `codesend`) VALUES ('$fullname', '$email', '$hashedPassword', '$verificationCode', '$codesend' )";

        if ($conn->query($query)) {
            $_SESSION['message'] = 'You have successfully signed up! Please check your email for the verification code.';
            $_SESSION['success'] = 'success';

            header('Location: ../verificationcode.php');
            exit();
        } else {
            $_SESSION['message'] = 'Unable to sign up. Please try again later.';
            $_SESSION['success'] = 'danger';
            $_SESSION['form'] = 'signup';

            header('Location: ../login.php');
            exit();
        }
    } else {
        $_SESSION['message'] = 'Please fill in all the required fields.';
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';

        header('Location: ../login.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'Unable to send email. Please try again later.';
    $_SESSION['success'] = 'danger';
    $_SESSION['form'] = 'signup';

    header('Location: ../login.php');
    exit();
}

$conn->close();
?>
