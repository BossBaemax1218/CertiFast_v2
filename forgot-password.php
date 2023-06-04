<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>CertiFast-Forgot Password</title>
      <!-- CSS FILES -->   
      <link rel="stylesheet" href="Homepage/css/password-styles.css">
      <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>
      <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>  
   </head>
   <body>
      <div class="content">
         <img class="lock-icon" src="Homepage\images\icons\padlock.png">
         <header>Forgot Password</header>
         <form action="#">
         <span class="mt-1">Please enter your email and we'll send you a verification code.</span>
            <div class="field mt-2">
               <input onkeyup="check()" id="email" type="text" autocomplete="off" placeholder="Enter Email Address">
               <div class="icons">
                  <span class="invalid fas fa-times"></span>
                  <span class="valid fas fa-check"></span>
               </div>
            </div>
            <div class="error-text">
               Please Enter Valid Email Address
            </div>
            <button type="submit"><a href="verificationcode.php">Submit</a></button>
         </form>
      </div>
      <script src="Homepage/js/forgot-password.js"></script>
   </body>
</html>