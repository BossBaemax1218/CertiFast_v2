<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: reset-password.php');
    }
    if (isset($_SESSION['fullname'])) {
        header('Location: reset-password.php');
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Login - CertiFast Portal  </title>

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
                <a href="#"><img src="images/trans-title.png" alt="" class="image"></a>
                <form id="myForm" method="POST" action="model/edit_password.php">
                    <h4 class="text-center">Reset Password</h4>
                    <p class="text-center">Please register your personal information if you haven't registered yet.</p>
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
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly>
                    <div class="field input-field">
                        <input id="new_password" type="password" autocomplete="off" name="new_password" placeholder="New Password" class="new_password" required>
                        <i class='bx bx-hide eye-icon first_password'></i>
                    </div>
                    <div class="field input-field">
                        <input id="confirm_password" type="password" autocomplete="off" name="confirm_password" placeholder="Confirm Password" class="confirm_password" required>
                        <i class='bx bx-hide eye-icon second_password'></i>
                    </div>
                    <div class="field button-field">
                        <button type="submit" value="submit" class="far fa-paper-plane text-center" style='font-size:20px'> Send</button>
                    </div>
                </form>
            </div>
            <footer class="footer mt-4">
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
    <script>
document.addEventListener('mousedown', function(event) {
    // Check if the right mouse button (2) or middle mouse button (3) was clicked
    if (event.which === 2 || event.which === 3) {
        // Go back in the browser's history
        history.back();
    }
});
</script>

    <script src="vendor-login/js/reset-password.js"></script>
    </body>
</html>