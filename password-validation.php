<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Certifast-Email Validation </title>  
        <!-- CSS FILES -->      
        <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>
        <link href="Homepage/css/password-validation.css" rel="stylesheet">
        <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </head>
    <body>
          <div class="wrapper">
            <div class="header">              
              <h2 class="fw-bold">Create a new password</h2>
            </div>
              <span class="text">Create a new password that is at least 8 characters long with letters, numbers, and symbols.</span>
                <div class="pass-field">
                  <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="New password" onClick="clearInput()" placeholder="Create password">
                  <i class="fa-solid fa-eye"></i>
                </div>
                <div class="content">
                  <div id="strength-wrapper">
                    <div id="strength-text">Password strength: <span id="strength-value"></span></div>
                      <div id="strength-bar">
                        <div id="strength-bar-inner"></div>
                      </div>
                    </div>
                  </div>  
                  <button><a href="forgot-password.php">Reset Password</a></button>
                </div>
            </div>
<script src="Homepage/js/password-validation.js"></script>
</body>
</html>