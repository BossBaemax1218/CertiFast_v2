<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: login.php');
    }
    if (isset($_SESSION['fullname'])) {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta content='width=device-width, initial-scale=1' name='viewport' />
        <title>CertiFast Portal</title>
        <link rel="stylesheet" href="assets/css/password-style.css"/>
        <link rel="icon" href="assets/img/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>           
    </head>
    <body>
    <div class="container">
        <section class="container forms">
            <div class="form" id="myForm">
                <div class="form-content">      
                    <form method="POST" action="model/forgot_password.php">
                        <div class="header-title text-center mt-3 mb-3">
                            <h4 class="text-center">Forgot Password</h4>
                            <span class="text-center">Please enter your email address for verification code.</span>
                        </div>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                            <div class="modal-wrapper">
                                <div class="text-center modal" id="signupModal">
                                    <?php if ($_SESSION['success'] == 'danger'): ?>
                                        <h5 class="modal-title text-center w-100 mb-3 mt-5">
                                            <i class="fas fa-exclamation-triangle fa-3x d-block mx-auto" style="color: #d64242"></i>
                                        </h5>
                                    <?php elseif ($_SESSION['success'] == 'success'): ?>
                                        <h5 class="modal-title text-center w-100 mb-3 mt-5">
                                            <i class="fas fa-check-circle fa-3x d-block mx-auto" style="color: #34c240"></i>
                                        </h5>
                                    <?php endif; ?>
                                    <label class="message text-center mt-1"><?php echo $_SESSION['message']; ?></label>                                 
                                    <button type="button" class="button mt-3" id="closeModalButton">Dismiss</button>
                                </div>
                            </div>                                     
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                        <div class="field input-field mt-2">
                            <input id="email" type="email" autocomplete="off" name="email" placeholder="Email" class="input">
                        </div>
                        <div class="field button-field text-center">
                            <button type="submit" value="submit" class="far fa-paper-plane"> &nbsp Send</button>
                        </div>
                    </form>
                    <div class="form-link text-center">
                        <span class="text-center">Back to <a href="login.php" class="login-link">Login</a></span>
                    </div>
                </div>
                <footer class="footer mt-3">
                    <div class="container-fluid">
                        <div class="copyright ml-auto text-center">
                            <?php  $year = date("Y"); echo  $year . " &copy Barangay Los Amigos - CertiFast Portal" ?>
                        </div>				
                    </div>
                </footer>
            </div>
        </section>
    </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var closeModalButton = document.getElementById('closeModalButton');
            closeModalButton.addEventListener('click', function() {
                var modal = document.getElementById('signupModal');
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                modal.style.display = 'none';
            });
            var modal = document.getElementById('signupModal');
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            modal.style.display = 'block';
        });
    </script>
    </body>
</html>