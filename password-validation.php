<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Password</title>      
        <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
        <link href="homepage/assets/css/password-validation.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    </head>
    <body>
          <div class="wrapper">
            <div class="header">              
              <h2 class="title">Create a new password</h2>
            </div>
              <span class="description">Create a new password that is at least 8 characters long with letters, numbers, and symbols.</span>
              <form action="#">
                <div class="pass-field">
                  <input type="password" id="password" name="password" onClick="clearInput()" placeholder="Create password">
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
              </form>
            </div>
<script src="homepage/js/password-validation.js"></script>
</body>
</html>