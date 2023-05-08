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

            <section class="donate">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 mx-auto">
                            <form class="custom-form donate-form" action="model/signup.php" method="POST" role="form">
                                <h2 class="mb-4">My CertiFast Account</h2>

                                <div class="row">

                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input class="form-check-input" type="radio" name="Signin" id="Signin">
                                            
                                            <label class="form-check-label" for="Signin">
                                                <a href="Login.php">Sign in</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input class="form-check-input" type="radio" name="Signup" id="Signup" checked>
                                            
                                            <label class="form-check-label" for="Signup">
                                                Sign up
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <h5 class="mt-2"></h5>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <span class="mt-4">Create an account to get started and register.</span>
                                    </div>

                                    <div class="col-lg-6 col-12 mt-4">
                                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" required>
                                    </div>

                                    <div class="col-lg-6 col-12 mt-4">
                                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" required>
                                    </div>
                                    <div class="col-lg-12 col-12 mt-2">
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email" required>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-2">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-2">
                                        <input type="password" name="password" id="password-input" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Password" required><span class="toggle-password">Show</span>
                                        
                                    </div>
                                    
                                    <!--<div class="col-lg-6 col-12 mt-3">
                                        <label>Confirm Password:</label>
                                        <input type="password" name="confirm_password" id="confirm_password" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Re-type your confirm Password" required>                                       
                                    </div>-->

                                    <div class="col-md-12 mt-4">                          
                                        <span class="term-conditions">By signing up, you are agree to our <a class="terms-conditions" href="">Terms and Conditions</a>, <a href="">Privacy Policy</a> for membership.</span>
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="form-control mt-1">Sign up</button>
                                    </div>


                                    <div class="col-lg-12 col-12 mt-4">
                                        <div class="progress mt-2">
                                            <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <div class="form-check-group mt-4">
                                            <a href="#" class="google-btn ">
                                                <div class="google-icon-wrapper">
                                                  <img class="google-icon" src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google Logo">
                                                </div>
                                                <span class="google-btn-text">Sign up with Google</span>
                                            </a>
                                            <a href="#" class="facebook-btn mt-2">
                                                <div class="facebook-icon-wrapper">
                                                  <img class="facebook-icon" src="https://img.icons8.com/color/16/000000/facebook.png" alt="Facebook Logo">
                                                </div>
                                                <span class="facebook-btn-text">Sign up with Facebook</span>
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

        <!--<footer>
            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-7 col-12">
                            <p class="copyright-text mb-0">Copyright © 2023 <a href="index.php">Barangay Los Amigos</a><br>
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
    <script>

        const passwordInput = document.getElementById("password-input");
        const togglePassword = document.querySelector(".toggle-password");

        togglePassword.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.classList.remove("show-password");
            togglePassword.classList.add("hide-password");
        } else {
            passwordInput.type = "password";
            togglePassword.classList.remove("hide-password");
            togglePassword.classList.add("show-password");
        }
        });
    </script>
</body>
</html>