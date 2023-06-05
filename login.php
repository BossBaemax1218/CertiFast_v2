<?php 
	session_start(); 
	if(isset($_SESSION['username'])){
		header('Location: dashboard.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- CSS FILES -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="homepage/assets/css/login-register-styles.css">
    <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>

    <title>CertiFast Account</title>
</head>

<body>
    <div class="container">
        <div class="signin-signup">
            <form method="POST" action="model/login.php" class="sign-in-form">
                <h2 class="title">Sign in</h2>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif ?>
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
                <input type="submit" value="Login" class="btn">
                <p class="social-text" style="font-size: 18px;">or sign in with</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </div>
                <div class="link">
                    <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
                </div>
            </form>
            <form method="POST" action="model/signup.php" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif ?>
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
                <input type="submit" value="Sign up" class="btn">
                <p class="social-text">or sign up with</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </div>
                <div class="link">
                    <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
                </div>                
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <a href="index.php"><img src="homepage/images/trans-title.png" alt="" class="image"></a>
                <div class="content">
                    <h1>Welcome Back!</h1>
                    <p>If you are already registered and singed up, please click sign in instead.</p>
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
            </div>
            <div class="panel right-panel">
                <a href="index.php"><img src="homepage/images/trans-title.png" alt="" class="image"></a>
                <div class="content">
                    <h1>Welcome!</h1>
                    <p>To keep connected with us, please sign up with your personal info.</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="homepage/js/login-register.js"></script>
</body>

</html>
