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
                        <h4 class="text-center">Forgot Password</h4>
                        <p class="text-center">Please enter your email address for verification code.</p>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                            <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" id="closeModalButton">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <div class="field input-field">
                            <input id="email" type="email" autocomplete="off" name="email" placeholder="Email" class="input">
                        </div>
                        <div class="field button-field">
                            <button type="submit" value="submit" class="far fa-paper-plane text-center" style='font-size:20px'> Send</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Back to <a href="login.php" class="login-link">Login</a></span>
                    </div>
                </div>
                <footer class="footer mt-3">
                    <div class="container-fluid">
                        <div class="copyright ml-auto text-center" style="font-size: 14px;">
                            <?php  $year = date("Y"); echo  $year . " &copy Barangay Los Amigos - CertiFast Portal" ?>
                        </div>				
                    </div>
                </footer>
            </div>
        </section>
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