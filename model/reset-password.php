<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: password-verify-code.php');
    }
    if (isset($_SESSION['fullname'])) {
        header('Location: password-verify-code.php');
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
            <div class="form" id="myForm" >
                <div class="form-content">
                    <form method="POST" action="model/edit_password.php">
                    <div class="text-center mt-3 mb-3">
                        <h3 class="text-center mt-2">Change Password</h3>
                        <span class="text-center mb-3">You have requested to reset your password.</span>
                    </div>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                            <div class="modal" id="signupModal">
                                <?php if ($_SESSION['success'] == 'danger'): ?>
                                    <h5 class="modal-title text-center w-100 mt-5 mb-3">
                                        <i class="fas fa-exclamation-triangle fa-3x d-block mx-auto" style="color: #d64242"></i>
                                    </h5>
                                <?php elseif ($_SESSION['success'] == 'success'): ?>
                                    <h5 class="modal-title text-center w-100 mt-5 mb-3">
                                        <i class="fas fa-check-circle fa-3x d-block mx-auto" style="color: #34c240"></i>
                                    </h5>
                                <?php endif; ?>
                                <span class="message text-center mt-3 ml-3"><?php echo $_SESSION['message']; ?></span>
                                <button type="button" class="button" id="closeModalButton">Dismiss</button>
                            </div>                                       
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly>
                        <div class="field input-field mt-3">
                            <input id="new_password" type="password" autocomplete="off" name="new_password" placeholder="New Password" class="new_password" required>
                            <i class='bx bx-hide eye-icon first_password'></i>
                        </div>
                        <div class="field input-field">
                            <input id="confirm_password" type="password" autocomplete="off" name="confirm_password" placeholder="Confirm Password" class="confirm_password" required>
                            <i class='bx bx-hide eye-icon second_password'></i>
                        </div>
                        <div class="field button-field text-center">
                            <button type="submit" value="submit" class="far fa-paper-plane"> &nbsp Send</button>
                        </div>
                    </form>
                </div>
                <footer class="footer mt-3 mb-2">
                    <div class="container-fluid">
                        <div class="copyright ml-auto text-center" style="font-size: 14px;">
                            <?php  $year = date("Y"); echo  $year . " &copy Barangay Los Amigos - CertiFast Portal" ?>
                        </div>				
                    </div>
                </footer>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-wOb5y1O7AA5uh4MtyOrFzr8qgq7uvLl8DCKhAt6nrL94vMyJOwF3HfjCC8e3VOYy1X/ZK8J2COlPYStxqB47Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <script>
        document.addEventListener('mousedown', function(event) {
            if (event.which === 2 || event.which === 3) {
                history.back();
            }
        });
    </script>
    <script src="Homepage/vendor-login/js/reset-password.js"></script>
    </body>
</html>