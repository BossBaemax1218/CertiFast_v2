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
        <meta content='width=device-width, initial-scale=1' name='viewport' />
        <title>CertiFast Portal</title>
        <link rel="stylesheet" href="assets/css/login-style.css"/>
        <link rel="icon" href="assets/img/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>  
    </head>
    <body>
    <div class="container">
        <section class="container forms">
            <div class="form"  id="myForm">
                <div class="form-content">
                    <a class="text-center" href="index.php"><img src="Homepage/vendor-login/images/trans-title.png" alt="" class="text-center image"></a>
                    <form method="POST" action="model/login.php">
                    <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
                        <div class="modal-wrapper">
                            <div class="modal" id="loginModal">
                                <?php if ($_SESSION['success'] == 'danger'): ?>
                                    <h5 class="modal-title text-center">
                                        <i class="fas fa-exclamation-triangle fa-3x mt-5" style="color: #d64242"></i>
                                    </h5>
                                <?php elseif ($_SESSION['success'] == 'success'): ?>
                                    <h5 class="modal-title text-center">
                                        <i class="fas fa-check-circle fa-3x mt-5" style="color: #34c240"></i>
                                    </h5>
                                <?php endif; ?>
                                <br>
                                <p class="message text-center mb-5" style="font-size: 14px;"><?php echo $_SESSION['message']; ?></p>
                                <button type="button" class="button" id="closeModalButton">Dismiss</button>
                            </div>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <span class="text-center">Please sign in correctly with your personal information.</span>
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
                        <p style="font-size: 13px;"><a href="termpolicy.php" target="_blank" style="font-size: 13px; text-decoration: none;">Privacy and Term of Use</a></p>
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