<?php
    session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Email Verification - CertiFast Portal  </title>

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
                    <form method="POST" action="model/email_verified.php">
                        <h3>Verification Code</h3>
                        <p>We sent you a code, please type the code to verified your account.</p>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                        <header id="header">
                            <div class="alert alert-<?php echo $_SESSION['success']; ?>" role="alert">
                                <?php if ($_SESSION['success'] == 'danger'): ?>
                                    <i class="fas fa-exclamation-triangle"></i>
                                <?php elseif ($_SESSION['success'] == 'success'): ?>
                                    <i class="fas fa-check-circle"></i>
                                <?php endif; ?>
                                <span class="alert-message"><?php echo $_SESSION['message']; ?></span>
                            </div>
                        </header>
                        <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <div class="field input-field">
                            <input type="text" name="verification_code" autocomplete="off" placeholder="Verification Code" class="input">
                        </div>
                        <div class="field button-field">
                            <button type="submit" value="submit" class="far fa-paper-plane text-center" style='font-size:20px'> Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>