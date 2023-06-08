<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Forgot Password</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> 
  <link href="homepage/assets/css/password-style.css" rel="stylesheet">
  <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
  <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li>
            <input class="track-input" type="text" placeholder="Enter tracking code">
          </li>
        </ul>
      </nav>
    </div>
  </header>
    <div class="wrapper">
      <h2 class="title">Forgot Password</h2>
      <form action="#">
        <span class="description">Please enter your email address and wait for verification code via email.</span>
        <div class="pass-field">
          <input onkeyup="check()" id="email" class="email" type="text" autocomplete="off" placeholder="Enter email address">
          <div class="icons">
              <span class="invalid"></span>
              <span class="valid"></span>
          </div>
        </div>
        <div class="error-text">
          Please enter valid email address
        </div>
        <div class="submit-btn">
          <button id="btnsubmit" class="btnsubmit"><a href="verificationcode.php">Confirm your email</a></button>
        </div>
      </form>
  </div>
  <script src="homepage/js/forgot-password.js"></script>
</body>
</html>
