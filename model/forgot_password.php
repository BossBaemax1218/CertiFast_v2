<?php
session_start();

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include server configuration
include '../server/server.php';


// Function to generate a verification code
function generateVerificationCode()
{
    // Generate a random verification code (you can modify this according to your requirements)
    $verificationCode = substr(md5(uniqid(rand(), true)), 0, 6);
    return $verificationCode;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the email address from the form
    $email = $_POST['email'];

    // Check if the email address is empty or not valid
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle the case when the email address is empty or not valid
        $_SESSION['message'] = 'Please enter a valid email address.';
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        header('Location: ../forgot-password.php');
        exit();
    }

    // Create a new PHPMailer instance
    $_SESSION['email'] = $email;
    $mail = new PHPMailer(true);

    try {
        // Configure SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'barangaylosamigos.certifast@gmail.com';
        $mail->Password = 'ipqostilxutxmbxl';
        $mail->Port = 587;

        // Set the user_email details
        $mail->setFrom('no-reply@gmail.com', 'Barangay Los Amigos - CertiFast');
        $mail->addAddress($email);
        $mail->Subject = 'Your new password verification code has been sent';

        // Check if the email address is already registered and verification_status is 1
        $stmt = $conn->prepare("SELECT user_email FROM tbl_user_resident WHERE user_email = ? AND verification_status = 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email address exists and verification_status is 1, generate a verification code and send it
            $verificationCode = generateVerificationCode();
            $year = date("Y");

            // Set the email body with HTML and CSS
            $mail->isHTML(true);
            $mail->Body = 
                '<!DOCTYPE html>
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
                                                            We have received a request to reset your password. Please use the following verification code to reset your password:
                                                        </p>
                                                        <p style="font-size:35px; color:#E42654; font-weight:bold;margin-bottom:10px;">' . $verificationCode . '</p>
                                                        <p style="color:#455056; font-size:13px;line-height:24px;margin-bottom:20px;">
                                                            Please note that this verification code is valid for 10 minutes only. <br>
                                                            If you did not request a password reset, please ignore this email.
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

            // Store the new verification code and codesend in the database
            $verifycode = $verificationCode;
            $codesend = date('Y-m-d H:i:s', strtotime('now'));
            $stmt = $conn->prepare("UPDATE tbl_user_resident SET verification_code = ?, verification_send = ? WHERE user_email = ?");
            $stmt->bind_param("sss", $verifycode, $codesend, $email);
            $stmt->execute();

            // Send the email
            if ($mail->send()) {
                // Email sent successfully
                // Redirect the user to the verification code confirmation page
                $_SESSION['message'] = 'Verification code successfully sent.';
                $_SESSION['success'] = 'success';
                $_SESSION['form'] = 'signup';

                header('Location: ../password-verify-code.php?email=' . $email);
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
            // Email address does not exist or verification_status is not 1
            $_SESSION['message'] = 'Your failed to verify your email address.';
            $_SESSION['success'] = 'danger';
            $_SESSION['form'] = 'signup';
            header('Location: ../forgot-password.php');
            exit();
        }
    } catch (Exception $e) {
        // Exception occurred
        $_SESSION['message'] = 'Unable to send email. Please try again later.';
        $_SESSION['success'] = 'danger';
        $_SESSION['form'] = 'signup';
        header('Location: ../forgot-password.php');
        exit();
    }
}
?>
