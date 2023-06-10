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
    $email = $_POST['user_email'];

    // Create a new PHPMailer instance
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
        $mail->Subject = 'Your forgot password verification code has been sent';

        // Check if the email address is already registered and verifystatus is 1
        $stmt = $conn->prepare("SELECT user_email FROM tbl_user_resident WHERE user_email = ? AND verifystatus = 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email address exists and verifystatus is 1, generate a verification code and send it
            $verificationCode = generateVerificationCode();
            $year = date("Y");

            // Set the email body with HTML and CSS
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
                                        <table width="100%" border-raduis="0" text-align="center" cellpadding="0" cellspacing="0"
                                            style=" margin-left: 5%; margin-right: 5%; max-width:700px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
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
                                                    <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;"> '.$year.' &copy; <strong><span>CertiFast Portal</span></strong> . All Rights Reserved</p>
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

            // Store the new verification code and codesend in the database
            $verifycode = $verificationCode;
            $codesend = date('Y-m-d H:i:s', strtotime('now'));
            $stmt = $conn->prepare("UPDATE tbl_user_resident SET verifycode = ?, codesend = ? WHERE user_email = ?");
            $stmt->bind_param("sss", $verifycode, $codesend, $email);
            $stmt->execute();

            // Send the email
            if ($mail->send()) {
                // Email sent successfully
                // Redirect the user to the verification code confirmation page
                $_SESSION['message'] = 'Verification code sucessfully sent.';
                $_SESSION['success'] = 'success';
                $_SESSION['form'] = 'signup';

                header('Location: ../reset-code.php');
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
