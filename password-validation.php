<!Doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>New Password</title>

        <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
        <link href="homepage/assets/css/password-validation.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
          <nav id="navbar" class="navbar">
            <ul>
              <li>
                <input class="track-input" type="text" placeholder="Enter tracking code"></input>
              </li>
            </ul>
          </nav>
        </div>
    </header>
          <div class="wrapper">           
              <h2 class="title">Create a new password</h2>
              <span class="description">Create a new password that has a unique characters.</span>
              <form action="#">
                <div class="pass-field">
                  <input type="password" class="password" id="password" name="password" onClick="clearInput()" placeholder="Enter new password">
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
                  <button id="btnsubmit" class="btnsubmit"><a href="forgot-password.php">Reset Password</a></button>
                </div>
              </form>
            </div>
<script src="homepage/js/password-validation.js"></script>
</body>
</html>