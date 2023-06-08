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

    <title>Login - CertiFast Portal</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="homepage/assets/css/login-register-styles.css">
    <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> 
</head>
<body>
    <div class="container">
        <div class="signin-signup">
            <form method="POST" action="model/login.php" class="sign-in-form">
                <a href="index.php"><img src="homepage/images/trans-title.png" alt="" class="image2"></a>
                <h2 class="title">CertiFast Sign in</h2>
                <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
                    <header id="header">
                        <div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
                            <?php if ($_SESSION['success'] == 'danger'): ?>
                                <i class="fas fa-exclamation-triangle"></i>
                            <?php elseif ($_SESSION['success'] == 'success'): ?>
                                <i class="fas fa-check-circle"></i>
                            <?php endif; ?>
                            <span class="alert-message"><?php echo $_SESSION['message']; ?></span>
                        </div>
                    </header>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="username" name="username" type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" name="password" type="password" placeholder="Password">
                </div>
                <div class="link">
                    <a href="forgot-password.php">Forgot your password?</a>
                </div>    
                <input type="submit" value="Sign in" class="btn">
                <p class="social-text">or sign in with</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </div>
                <div class="link">
                    <p class="account-text">Don't have any account? <a href="#" id="sign-up-btn2">Sign up.</a></p>
                </div>
            </form>
            <form id="sign-up-form" method="POST" action="model/signup.php" class="sign-up-form">
                <a href="index.php"><img src="homepage/images/trans-title.png" alt="" class="image2"></a>
                <h2 class="title">CertiFast Sign up</h2>
                <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                    <header id="header">
                        <div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
                            <?php if ($_SESSION['success'] == 'danger'): ?>
                                <i class="fas fa-exclamation-triangle"></i>
                            <?php elseif ($_SESSION['success'] == 'success'): ?>
                                <i class="fas fa-check-circle"></i>
                            <?php endif; ?>
                            <span class="alert-message"><?php echo $_SESSION['message']; ?></span>
                        </div>
                    </header>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="username" name="username" type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input id="email" name="email" type="text" placeholder="Email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" name="password" type="password" placeholder="Password">
                </div>
                <input type="submit" value="Sign up" class="btn-submit">
                <p class="social-text">or sign up with</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </div>
                <div class="link">
                    <p class="account-text">Already have an account? <a href="#" id="sign-up-btn2">Sign in.</a></p>
                </div>               
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <a href="index.php"><img src="homepage/images/trans-title.png" alt="" class="image"></a>
                <div class="content">
                    <h1>Welcome Back!</h1>
                    <p>If you are already registered, please click sign in instead.</p>
                    <button class="btn-slide" id="sign-in-btn"><i class="fas fa-angle-double-left"></i></button>
                </div>
            </div>
            <div class="panel right-panel">
                <a href="index.php"><img src="homepage/images/trans-title.png" alt="" class="image"></a>
                <div class="content">
                    <h1>Welcome!</h1>
                    <p>To stay connected with us, please sign up with your personal information.</p>
                    <button class="btn-slide" id="sign-up-btn"><i class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    <script src="homepage/js/login-register.js"></script>
</body>
</html>
