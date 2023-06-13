<?php
session_start();
?>
<!Doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>New Password Verification - CertiFast Portal</title>

        <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
        <link href="homepage/assets/css/password-validation.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
        </div>
    </header>
    <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
        <header id="header1">
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
          <div class="wrapper">           
              <h2 class="title"> Password Verification Code</h2>
              <span class="description">To reset your password, type the code we sent to your email address.</span>
              <form method="POST" action="model/edit_pass_code.php">
                <div class="pass-field">
                  <input type="text" class="password" id="password" name="verification_code" placeholder="Enter the code here">
                </div>
                <div class="content">
                  <button id="btnsubmit" class="btnsubmit">Confirm Verification Code</button>
                </div>
              </form>
            </div>
<script src="homepage/js/password-validation.js"></script>
</body>
</html>