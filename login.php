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
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <title>CertiFast Portal</title>
        <link rel="stylesheet" href="Homepage/vendor-login/css/login-style.css">
        <link rel="icon" href="Homepage/vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
        <style>
.modal {
    position: absolute;
    width: 340px;
    height: 230px;
    top: 5%;
    left:10%;
    background: #fff;
    border-radius: 3px;
    box-shadow: 8px 10px 14px 10px rgba(0,0,0,0.4);
    overflow: hidden;
    margin: auto;
	animation: show-modal .7s ease-in-out;
	
	&.hide {
		animation: hide-modal .6s ease-in-out both;
	}

.button {
    position: absolute;
    height: 40px;
    bottom: 0;
    left: 0;
    right: 0;
    background: #F65656;
    color: #fff;
    line-height: 40px;
    font-size: 16px;
    font-weight: 400;
    cursor: pointer;
    border:none;
	transition: background .3s ease-in-out;
		
		&:hover {
			background: #EC3434;
		}
    }
}
@keyframes show-modal {
	0% {
		transform: scale(0);
	}
	60% {
		transform: scale(1.1);
	}
	80% {
		transform: scale(.95);
	}
	100% {
		transform: scale(1);
	}
}

@keyframes hide-modal {
	0% {
		transform: scale(1);
	}
	20% {
		transform: scale(1.1);
	}
	100% {
		transform: scale(0);
	}
}

@media (max-width: 767px) {
#myform {
    width: 100%;
    max-width: 400px;
}
img{
    width: 80%;
    max-width: 400px;
}

.message {
    font-size: 12px;
    font-weight: 300;
    line-height: 19px;
    margin: 0;
    padding: 0 30px;
}

.form-content {
    padding: 10px;
}

.form-group input,
.form-group button,
.form-link,
.form-group button {
    font-size: 14px;
}
.modal {
    max-width: 95%;
    max-height: 100%;
    padding: 15px;
    top: 5%;
    left:0;
    right: 0;
}
}

@media (max-width: 576px) {
#myform {
    left: 15px;
    right: 15px;
    max-width: 150%;
}
img{
    width: 80%;
    max-width: 400px;
}
.message {
    font-size: 12px;
    font-weight: 300;
    line-height: 19px;
    margin: 0;
    padding: 0 30px;
}
.modal {
    max-width: 95%;
    max-height: 90%;
    padding: 10px;
    top: 5%;
    left:0;
    right: 0;
}
}
</style>   
    </head>
    <body>
    <div class="container">
        <section class="container forms">
            <div class="form"  id="myForm">
                <div class="form-content">
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
                        <p class="text-center mb-5" style="font-size: 14px;"><?php echo $_SESSION['message']; ?></p>
                        <button type="button" class="button" id="closeModalButton">Dismiss</button>
                    </div>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
                    <a class="text-left" href="index.php"><img src="Homepage/vendor-login/images/trans-title.png" alt="" class="text-center image"></a>
                    <form method="POST" action="model/login.php">
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