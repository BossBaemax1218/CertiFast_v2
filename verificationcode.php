<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verification Code</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> 
    <link href="homepage/assets/css/password-verification.css" rel="stylesheet">
    <link rel="icon" href="homepage/images/CFLogo2.ico" type="image/x-icon"/>
    <link href="homepage/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>  
    <body>
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo"><a href="index.php"><img src="homepage/assets/img/title-logo.png" alt="title-logo"></a></h1>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><input class="track-input" type="text" placeholder="Enter tracking code"></input></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="wrapper">          
                <h2 class="title">Verification Code</h2>
            <form action="#">
                <span class="description">To reset your password, type the code we sent to your email address.</span>
                <div class="pass-field">
                    <input class="verify-code" type="text" id="verify-code" name="verify-code" placeholder="Enter your code">
                </div>
                <div class="content">
                    <button id="btnsubmit" class="btnsubmit"><a href="password-validation.php">Confirm</a></button>
                </div>
            </form>
        </div>
</body>
</html>
