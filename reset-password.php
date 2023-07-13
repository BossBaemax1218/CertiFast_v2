<?php
    session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Login - CertiFast Portal  </title>

        <link rel="stylesheet" href="vendor-login/css/password-style.css"/>
        <link rel="icon" href="vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="vendor-login/css/bootstrap.min.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                        
    </head>
    <body>
    <section class="container forms">
        <div class="form">
            <div class="form-content">
                <a href="#"><img src="images/trans-title.png" alt="" class="image"></a>
                <form method="POST" action="model/edit_password.php">
                    <h4>Forgot Password</h4>
                    <p>Please register your personal information if you haven't registered yet.</p>
                    <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                    <header id="header">
                        <div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
                            <?php if ($_SESSION['success'] == 'danger'): ?>
                                <i class="fas fa-exclamation-triangle"></i>
                            <?php elseif ($_SESSION['success'] == 'success'): ?>
                                <i class="fas fa-check-circle"></i>
                            <?php endif; ?>
                            <span class="alert-message"> <?php echo $_SESSION['message']; ?> </span>
                        </div>
                    </header>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly>
                    <div class="field input-field">
                        <input id="new_password" type="password" autocomplete="off" name="new_password" placeholder="New Password" class="new_password" required>
                        <i class='bx bx-hide eye-icon first_password'></i>
                    </div>
                    <div class="field input-field">
                        <input id="confirm_password" type="password" autocomplete="off" name="confirm_password" placeholder="Confirm Password" class="confirm_password" required>
                        <i class='bx bx-hide eye-icon second_password'></i>
                    </div>
                    <div class="field button-field">
                        <button type="submit" value="submit" class="far fa-paper-plane text-center" style='font-size:20px'> Send</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
        <!-- JavaScript -->
        <script src="vendor-login/js/reset-password.js"></script>
    </body>
</html>