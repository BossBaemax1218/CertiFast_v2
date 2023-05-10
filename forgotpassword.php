<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Certifast - Forgot Password  </title>

        <!-- CSS FILES -->        

        <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>

        <link href="Homepage/css/forgot-password.css" rel="stylesheet">

        <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">


    </head>
    
    <body>

        <main>
                <div class="card">
                    <div class="card-header">
                        <img class="lock-icon" src="Homepage\images\icons\padlock.png">                  
                        <h5 class="mt-2">Forgot your Password</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <span class="mt-2" style="font-size: 16px;">Enter your email and we'll send you a verification code to get back into your account.</span>
                            <input class="mt-4" type="email" id="email" name="email" placeholder="Email address">
                            <button type="submit"><a href="verificationcode.php">Reset Password</a></button>
                            <span class="mt-3">  or create account with  </span>
                            <div class="mt-3 mb-4">
                                    <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                                    <a class="google-link" href="">Sign up with Google</a>
                            </div>
                        </form>
                    </div>
                </div>
                <footer>
                <p>
                    Created by <a href="index.php">CertiFast Team</a> 2023           
                </p>
              </footer>
        </main>
    </body>
</html>