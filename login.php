<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: dashboard.php');
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Login - CertiFast Portal  </title>

        <link rel="stylesheet" href="vendor-login/css/login-style.css"/>
        <link rel="icon" href="vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="vendor-login/css/bootstrap.min.css" rel="stylesheet">

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'/>
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form">
                <div class="form-content">
                    <a href="index.php"><img src="vendor-login/images/trans-title.png" alt="" class="image"></a>
                    <form method="POST" action="model/login.php">
                        <h2>Login</h2>
                        <p>Please sign in correctly your personal information.</p>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
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
                        <div class="form-group input-field">
                            <input id="email" type="text" name="email" autocomplete="off" placeholder="Email" class="input">
                        </div>
                        <div class="form-group input-field">
                            <input id="password" type="password" name="password" autocomplete="off" placeholder="Password" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>
                        <div class="form-link">
                            <a href="forgot-password.php" class="forgot-pass">Forgot password?</a>
                        </div>
                        <div class="form-group button-field">
                            <button type="submit" value="submit">Submit</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="signup.php" class="signup-link">Signup</a></span>
                    </div>
                </div>

                <div class="line"></div>
                <div class="media-options">
                    <a href="#" class="form-group google">
                        <img src="vendor-login/images/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>
        </section>
        <!-- JavaScript -->
        <script src="vendor-login/js/password.js"></script>
    </body>
</html>