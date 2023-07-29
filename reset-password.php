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
        <title>CertiFast Portal</title>
        <link rel="stylesheet" href="Homepage/vendor-login/css/password-style.css"/>
        <link rel="icon" href="Homepage/vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="Homepage/vendor-login/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <style>
.modal {
    position: absolute;
    width: 340px;
    height: 230px;
    top: 3%;
    left:2%;
    background: #fff;
    border-radius: 3px;
    box-shadow: 4px 8px 12px 0 rgba(0,0,0,0.4);
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
    font-size: 14px;
    font-weight: 400;
    cursor: pointer;
    border:none;
	transition: background .3s ease-in-out;
		
		&:hover {
			background: #EC3434;
		}
    }
}

.message {
    font-size: 14px;
    font-weight: 300;
    line-height: 19px;
    margin-top: 130px;
    padding: 0 30px;
}

#myForm {
    position: relative;
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
    max-width: 576px;
}
img{
    width: 80%;
    max-width: 400%;
}
.forms {
    width: 500%;
    max-width: 800px;
}
.message {
    font-size: 13px;
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
    max-width: 100%;
    max-height: 130%;
    padding: 15px;
    top: 0%;
    left:0%;
}
}

@media (max-width: 576px) {
#myform {
    width: 100%;
    max-width: 600px;
}
.forms {
    width: 500%;
    max-width: 600px;
}
img{
    width: 80%;
    max-width: 400px;
}
.message {
    font-size: 13px;
    font-weight: 300;
    line-height: 19px;
    margin: 0;
    padding: 0 30px;
}
.modal {
    max-width: 100%;
    max-height: 130%;
    padding: 10px;
    top: 0%;
    left:0%;
}
}
</style>                                          
    </head>
    <body>
    <div class="container">
        <section class="container forms">
            <div class="form" id="myForm" >
                <div class="form-content">
                    <form method="POST" action="model/edit_password.php">
                        <h4 class="text-center">Change Password</h4>
                        <p class="text-center">You have requested to reset your password.</p>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
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
                                <p class="message text-center"><?php echo $_SESSION['message']; ?></p>
                                <button type="button" class="button" id="closeModalButton">Dismiss</button>
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