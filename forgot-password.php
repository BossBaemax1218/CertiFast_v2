<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> 
  <link href="homepage/assets/css/password-style.css" rel="stylesheet">
  <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <h2 class="title">Forgot Password</h2>
    </div>
    <form action="#">
      <span class="description">Please enter your email and we'll send you a verification code.</span>
      <div class="pass-field">
        <input onkeyup="check()" id="email" type="text" autocomplete="off" placeholder="Enter Email Address">
        <div class="icons">
            <span class="invalid"></span>
            <span class="valid"></span>
         </div>
      </div>
      <div class="error-text">
        Please Enter Valid Email Address
      </div>
      <button><a href="verificationcode.php">Submit</a></button>
    </form>
  </div>
  <script src="homepage/js/forgot-password.js"></script>
</body>
</html>
