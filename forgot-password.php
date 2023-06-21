<?php
    session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Forgot Password - CertiFast Portal </title>

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
                    <form method="POST" action="model/forgot_password.php">
                        <h2>Forgot Password</h2>
                        <p>Please enter your email address for verification code.</p>
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
                        <div class="field input-field">
                            <input id="email" type="email" autocomplete="off" name="email" placeholder="Email" class="input">
                        </div>
                        <div class="field button-field">
                            <button type="submit" value="submit">Submit</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Back to <a href="login.php" class="login-link">Login</a></span>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>