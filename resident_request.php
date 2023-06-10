<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CertiFast Portal</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="homepage/assets/css/login-register-styles.css">
    <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> 
</head>
<body>
            <form method="POST" action="model/login.php">
                <h1>WELCOME TO CERTIFAST (REGISTRATION)</h1>
                <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
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
            </form>
</body>
</html>
