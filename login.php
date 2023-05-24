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
    <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Homepage/css/login-register-styles.css">
    <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>

    <title>CertiFast Account</title>

</head>

<body>
    <div class="container">
        <div class="signin-signup">
            <form method="POST" action="model/login.php" class="sign-in-form">
                <h2 class="title">Sign in</h2>
                <br>
                
                <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                            <?= $_SESSION['message']; ?>
                        </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif ?>
                
                <br>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="username" name="username" type="text" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" name="password" type="password" placeholder="Password" required>
                </div>
                
                <a href="forgotpassword.php">Forgot your password?</a>
                
                <input type="submit" value="Login" class="btn">
                <p class="social-text" style="font-size: 18px;">or sign in with</p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </div>
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>
            <form method="POST" action="model/signup.php" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <br>

                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="fullname" name="fullname" type="text" placeholder="Name">
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
                <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <img src="Homepage/images/trans-title.png" alt="" class="image">
                <div class="content">
                    <h1>Welcome Back!</h1>
                    <p>If you are already registered and singed up, please click sign in instead.</p>
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
            </div>
            <div class="panel right-panel">
                <img src="Homepage/images/trans-title.png" alt="" class="image">
                <div class="content">
                    <h1>Welcome!</h1>
                    <p>To keep connected with us, please sign up with your personal info.</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="Homepage/js/login-register.js"></script>
</body>

</html>