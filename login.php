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

        <title>CertiFast</title>

        <!-- CSS FILES -->        
        <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">

        <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>

        <link href="Homepage/css/bootstrap-icons.css" rel="stylesheet">

        <link href="Homepage/css/certifast.css" rel="stylesheet">

    </head>
    
    <body>
     <main>

            <section class="section">
                <div class="container">
                    <div class="row">                    
                        <div class="col-lg-6 col-12 mx-auto">
                            <form class="custom-form donate-form" action="model/login.php" method="POST" role="form">
                                <h2 class="mb-4">My CertiFast Account</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input class="form-check-input" type="radio" name="DonationFrequency" id="DonationFrequencyOne" checked>
                                            
                                            <label class="form-check-label" for="DonationFrequencyOne">
                                                Sign in
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input class="form-check-input" type="radio" name="DonationFrequency" id="DonationFrequencyMonthly">
                                            
                                            <label class="form-check-label" for="DonationFrequencyMonthly">
                                                <a href="Signup.php">Sign up</a>
                                            </label>
                                        </div>
                                    </div>
                                    <?php if(isset($_SESSION['message'])): ?>
                                    <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                        <?= $_SESSION['message']; ?>
                                    </div>
                                    <?php unset($_SESSION['message']); ?>
                                    <?php endif ?>
                                    <div class="col-lg-12 col-12">
                                        <h5 class="mt-2"></h5>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <span class="mt-4"></span>
                                    </div>

                                    <div class="col-lg-6 col-12 mt-4">
                                        <label>Email or username </label>
                                        <input id="username" name="username" type="text" class="form-control" placeholder="username@mail.com" required>
                                    </div>

                                    <div class="col-lg-6 col-12 mt-4">
                                        <label>Password </label>
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Enter password" required>
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    
                                    <a class="forgot-password-link mt-2" href="forgotpassword.php">Forgot Password? </a>
                                        
                                    <div class="col-md-12 mt-4">
                                        <button type="submit" class="form-control mt-1">Sign up</button>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-4">
                                        <div class="progress mt-2">
                                            <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">

                                            </div>
                                        </div>
                                        <div class="form-check-group mt-4">
                                            <a href="#" class="google-btn ">
                                                <div class="google-icon-wrapper">
                                                  <img class="google-icon" src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google Logo">
                                                </div>
                                                <span class="google-btn-text">Sign in with Google</span>
                                            </a>
                                            <a href="#" class="facebook-btn mt-2">
                                                <div class="facebook-icon-wrapper">
                                                  <img class="facebook-icon" src="https://img.icons8.com/color/16/000000/facebook.png" alt="Facebook Logo">
                                                </div>
                                                <span class="facebook-btn-text">Sign in with Facebook</span>
                                              </a>                                                                                             
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <!--<footer class="site mt-12">
            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-7 col-12">
                            <p class="copyright-text mb-0">Copyright © 2023 <a href="#">Barangay Los Amigos</a><br>
                        	Created at:<a href="#" target="_blank"> CertiFast</a></p>
                        </div>
                        
                        <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
                            <ul class="social-icon">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="https://www.facebook.com/Barangay-Los-Amigos-122021251193091/?ref=page_internal" class="social-icon-link bi-facebook"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-linkedin"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="https://youtube.com/" class="social-icon-link bi-youtube"></a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>-->

        <!-- JAVASCRIPT FILES -->
        <script src="Homepage/js/jquery.min.js"></script>
        <script src="Homepage/js/bootstrap.min.js"></script>
        <script src="Homepage/js/jquery.sticky.js"></script>
        <script src="Homepage/js/counter.js"></script>
        <script src="Homepage/js/custom.js"></script>

    </body>
</html>