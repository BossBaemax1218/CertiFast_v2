<?php 
	session_start(); 
	if(isset($_SESSION['username'])){
		header('Location: dashboard.php');
	}
?>
<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>CertiFast - Barangay Los Amigos</title>

        <!-- CSS FILES -->        

        <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">

        <link href="Homepage/css/login-certifast.css" rel="stylesheet">

        <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>

    </head>
    
    <body>
    <main>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="POST" action="model/signup.php">
                    <h1 style="color: black;">CertiFast Account</h1>
                  
                    <span class="mt-2">--------------------------------------------------</span>
                    <br>
                    <input class="form-control input-border-bottom" name="householdno" id="householdno" type="text" placeholder="Household no." required/>
                    <input class="form-control input-border-bottom" name="fullname" id="fullname" type="text" placeholder="Name" required/>
                    <input class="form-control input-border-bottom" name="email" id="email" type="email" placeholder="Email" required/>
                    <input class="form-control input-border-bottom" name="password" id="password" type="password" placeholder="Password" required/>
                    
                    <button type="submit" class="mt-4">Sign Up</button>
                    <span class="mt-4">----------  or   ----------</span>
                    <div class="social-container">
                        <a href="#" class="social-google"><i class="fab fa-google-plus-g"></i></a>
                        <span>Sign up with Google</span>
                    </div>
                    
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="model/login.php">
                    <h1 style="color: black;">Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social-google"><i class="fab fa-google-plus-g"></i></a>
                        <span>Sign in with Google</span>
                    </div>
                    <span>----------  or   ----------</span>
                    <br>
                    
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                            <?= $_SESSION['message']; ?>
                        </div>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif ?>

                    <input id="username" name="username" type="text" class="form-control input-border-bottom" placeholder="Username" required />
                    <input id="password" name="password" type="password" class="form-control input-border-bottom" placeholder="Password" required />
                    <a href="forgotpassword.php">Forgot your password?</a>
                    <button type="submit" >Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <a href="index.php">
                            <img src="assets/img/trans-title.png" alt="certifast-logo">
                        </a>
                        <h1>Welcome Back!</h1>
                        
                        <p>If you are already registered and singed up, please click sign in instead.</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <a href="index.php">
                            <img src="assets/img/trans-title.png" alt="certifast-logo">
                        </a>
                        <h1>Welcome!</h1>
                        <p>To keep connected with us, please sign in with your personal info.</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p>
                Created by <a href="index.php">CertiFast Team</a> 2023               
            </p>
        </footer>

    </main>

<script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</body>
</html>