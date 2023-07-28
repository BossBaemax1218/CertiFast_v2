<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: dashboard.php');
    }
    if (isset($_SESSION['fullname'])) {
        header('Location: resident_dashboard.php');
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CertiFast Portal</title>

        <link rel="stylesheet" href="vendor-login/css/login-style.css"/>
        <link rel="icon" href="vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>      
    </head>
    <body>
    <div class="container">
        <section class="container forms">
            <div class="form">
                <div class="form-content">
                    <a class="text-center ml-3" href="index.php"><img src="vendor-login/images/trans-title.png" alt="" class="image"></a>
                    <form method="POST" action="model/login.php">
                        <p class="text-center">Please sign in correctly with your personal information.</p>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
                            <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" id="closeModalButton" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($_SESSION['success'] == 'danger'): ?>
                                                <h5 class="modal-title text-center w-100">
                                                    <i class="fas fa-exclamation-triangle fa-3x d-block mx-auto" style="color: #d64242"></i>
                                                </h5>
                                            <?php elseif ($_SESSION['success'] == 'success'): ?>
                                                <h5 class="modal-title text-center w-100">
                                                    <i class="fas fa-check-circle fa-3x d-block mx-auto" style="color: #34c240"></i>
                                                </h5>
                                            <?php endif; ?>
                                            <br>
                                            <p class="text-center" style="font-size: 24px; font-weight: bold;"><?php echo $_SESSION['message']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <div class="form-group input-field">
                            <input id="email" type="text" name="email" autocomplete="off" placeholder="Email or username" class="input">
                        </div>
                        <div class="form-group input-field">
                            <input id="password" type="password" name="password" autocomplete="off" placeholder="Password" class="password">
                        </div>
                        <div class="form-link">
                            <a href="forgot-password.php" class="forgot-pass">Forgot password?</a>
                        </div>
                        <div class="form-group button-field">
                            <button type="submit" value="submit" class="submit-button">Submit</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Don't have an account? <a href="signup.php" class="signup-link">Signup</a></span>
                    </div>
                </div>
                <footer class="footer mt-3">
                    <div class="container-fluid">
                        <div class="copyright">
                            <?php
                                $year = date("Y");
                                echo $year . " &copy; Barangay Los Amigos - CertiFast Portal";
                            ?>
                        </div>
                        <p style="font-size: 13px;"><a href="#termprivacy" style="font-size: 13px;" data-toggle="modal">Privacy and Term of Use</a></p>
                    </div>
                </footer>
            </div>
            <?php if(!isset($_GET['closeModal'])){ ?>
                
                <script>
                    setTimeout(function(){ openModal(); }, 1000);
                </script>
            <?php } ?>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="termprivacy" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Privacy, Cookies, and Terms of Use</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <div class="form-group form-floating-label">
                            <ul class="mt-2">
                                <li>
                                    <p>We prioritize your privacy and safeguard your personal information when using the Barangay Los Amigos - CertiFast Portal. By using the portal, you agree to allow us to collect, use, and store your personal information as needed for the portal's services.</p>
                                    <To>The CertiFast Portal uses necessary cookies for its functionalities to operate effectively. To learn more about the use of cookies and how CertiFast Portal uses personal information on behalf of your institution, please read <a href="termpolicy.php#featured-policy" target="_blank">CertiFast Portal Privacy Statement</a>.</span>
                                    <br><br>
                                    <span>When you select <b>"OK"</b> you are agreeing to Barangay Los Amigos - <a href="termpolicy.php#featured-term" target="_blank"> CertiFast Portal  Terms of Use</a>.</span>
                                </li>                        
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="closeModalButton">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var closeModalButton = document.getElementById('closeModalButton');
            closeModalButton.addEventListener('click', function() {
                var modal = document.getElementById('loginModal');
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                modal.style.display = 'none';
            });
            var modal = document.getElementById('loginModal');
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            modal.style.display = 'block';
        });
    </script>
    </body>
</html>