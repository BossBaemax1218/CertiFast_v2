<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: forgot-password.php');
    exit;
}
if (isset($_SESSION['fullname'])) {
    header('Location: forgot-password.php');
    exit;
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
                        <h4 class="text-center">Change Password</h4>
                        <span class="text-center">You have requested to reset your password.</span>
                    </div>
                    <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                        <div class="modal-wrapper">
                            <div class="modal" id="signupModal">
                                <?php if ($_SESSION['success'] == 'danger'): ?>
                                    <h5 class="modal-title text-center w-100 mt-5">
                                        <i class="fas fa-exclamation-triangle fa-3x d-block mx-auto" style="color: #d64242"></i>
                                    </h5>
                                <?php elseif ($_SESSION['success'] == 'success'): ?>    
                                    <h5 class="modal-title text-center w-100 mt-5">
                                        <i class="fas fa-check-circle fa-3x d-block mx-auto" style="color: #34c240"></i>
                                    </h5>
                                <?php endif; ?>
                                <div class="text-center mt-3 mb-3">
                                    <span class="message text-center"><?php echo $_SESSION['message']; ?></span>                                 
                                </div>
                                <button type="button" class="button mt-3" id="closeModalButton">Dismiss</button>
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
                    <div class="field button-field text-center">
                        <button type="submit" value="submit"><i class="far fa-paper-plane"></i> &nbsp;Send</button>
                    </div>
                </form>
            </div>
            <footer class="footer mt-3">
                <div class="container-fluid">
                    <div class="copyright ml-auto text-center">
                        <?php  $year = date("Y"); echo  $year . " &copy; Barangay Los Amigos - CertiFast Portal" ?>
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
