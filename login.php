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

        <header class="site-header">
            <div class="container">
                <div class="row">
                    <?php include 'templates/loading_screen.php' ?>
                    <div class="col-lg-8 col-12 d-flex flex-wrap">
                        <p class="d-flex me-4 mb-0">
                            <i class="bi-geo-alt me-2"></i>
                            Barangay Los Amigos, Tugbok, Davao City, Davao Del Sur. 8000
                        </p>

                        <p class="d-flex mb-0">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@company.com">
                                losamigosdavaocity.gov@gmail.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
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
                        </ul>
                    </div>

                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="Homepage/images/trans-title.png" class="logo img-fluid" style="width: 140px;" alt="Kind Heart Charity">
                    <span>
                        Barangay Los Amigos
                        
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_1">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_2">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php">Services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_6">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>

            <section class="donate-section">
                <div class="section-overlay"></div>
                <div class="container">
                    <div class="row">                    
                        <div class="col-lg-6 col-12 mx-auto">
                            <form class="custom-form donate-form" action="model/login.php" method="POST" role="form">
                                <h1 class="mb-4">Sign in</h1>
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <h6 class="mb-3">The faster you fill up, the faster you sign in. </h6>
                                    </div>

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
                                        <h5 class="mt-1">Personal Info</h5>
                                    </div>

                                    <div class="col-lg-6 col-12 mt-2">
                                        <input id="username" name="username" type="text" class="form-control" placeholder="Username" required>
                                    </div>

                                    <div class="col-lg-6 col-12 mt-2">
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    
                                    <a class="forgot-password-link mt-2" href="forgotpassword.php">Forgot Password? </a>

                                    <div class="col-lg-12 col-12 mt-4">
                                        <div class="progress mt-2">
                                            <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <button type="submit" class="form-control">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 mb-4">
                        <img src="Homepage/images/trans-title.png" class="logo img-fluid" style="width: 250px;" alt="">
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <h5 class="site-footer-title mb-3">Barangay Links</h5>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">About</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Services</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Contact</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link"></a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link"></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mx-auto" >
                        <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                        <p class="text-white d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: 120-240-9600" class="site-footer-link">
                                (082) 228-8984
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                losamigosdavaocity.gov@gmail.com
                            </a>
                        </p>

                        <p class="text-white d-flex mt-3">
                            <i class="bi-geo-alt me-2"></i>
                            Barangay Los Amigos, Tugbok, Davao City, Davao Del Sur. 8000
                        </p>

                        <a href="https://www.google.com/maps/place/Barangay+Los+Amigos/@7.1416029,125.4797257,15z/data=!4m6!3m5!1s0x32f913ff9378a1b7:0x626e3b5d2a8b7f6f!8m2!3d7.1416029!4d125.4797257!16s%2Fg%2F11c1vl_d7r" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

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
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="Homepage/js/jquery.min.js"></script>
        <script src="Homepage/js/bootstrap.min.js"></script>
        <script src="Homepage/js/jquery.sticky.js"></script>
        <script src="Homepage/js/counter.js"></script>
        <script src="Homepage/js/custom.js"></script>

    </body>
</html>