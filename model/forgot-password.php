<?php
    <?php
    // Include the PHPMailer library
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if reset password form has been submitted
        if (isset($_POST['reset_password'])) {
            $email = $_POST['email'];
            $new_password = $_POST['new_password'];
            // Reset the password in the database
            // In this example, we use a simple array for demonstration purposes
            $users = array(
                array('username' => 'user1', 'email' => 'user1@example.com', 'password' => 'password1'),
                array('username' => 'user2', 'email' => 'user2@example.com', 'password' => 'password2')
            );
            foreach ($users as &$u) {
                if ($u['email'] === $email) {
                    $u['password'] = $new_password;
                    echo 'Password reset successful. <a href="login.php">Login</a> with your new password.';
                    break;
                }
            }
        } else {
            // Verify user's identity with the verification code
            $email_or_username = $_POST['email_or_username'];
            // Check if email or username exists in the database
            // In this example, we use a simple array for demonstration purposes
            $users = array(
                array('username' => 'user1', 'email' => 'user1@example.com', 'password' => 'password1'),
                array('username' => 'user2', 'email' => 'user2@example.com', 'password' => 'password2')
            );
            $user = null;
            foreach ($users as $u) {
                if ($u['email'] === $email_or_username || $u['username'] === $email_or_username) {
                    $user = $u;
                    break;
                }
            }
            if ($user) {
                // Generate verification code
                $verification_code = rand(100000, 999999);
                // Send verification code to user's email
                $mail = new PHPMailer(true);
                try {
                    // Server settings
                    $mail->SMTPDebug = 0;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'your-email@gmail.com';                  // SMTP username
                    $mail->Password   = 'your-email-password';                   // SMTP password
                    $mail->SMTPSecure = 'tls';            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    // Recipients
                    $mail->setFrom('your-email@gmail.com', 'Your Name');
                    $mail->addAddress($user['email'], $user['username']);     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Verification Code';
                    $mail->Body    = 'Your verification code is ' . $verification_code;

                    $mail->send();
                    echo 'Verification code has been sent to your email.';
                    // Store verification code in session
                    session_start();
                    $_SESSION['verification_code'] = $verification_code;
                    $_SESSION['email'] = $user['email'];
                    // Display reset password form
                    ?>
                    <form method="POST">
                        <label for="verification_code">Verification Code:</label>
                        <input type="text" name="verification_code" id="verification_code" required>
                        <br>
                        <label for="new_password">New Password:</label>
                        <input type="password" name="new_password" id="new_password" required>
                        <br>
                        <input type="submit" name="reset_password" value="Reset Password">
                    </form>
                    <?php
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo 'Invalid email or username.';
            }
        }
    } 
?>
