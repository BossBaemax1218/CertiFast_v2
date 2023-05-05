<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Certifast - Forgot Password  </title>

        <!-- CSS FILES -->        
        <link href="Homepage/css/bootstrap.min.css" rel="stylesheet">

        <link rel="icon" href="Homepage/images/CFLogo2.ico" type="image/x-icon"/>

        <link href="Homepage/css/bootstrap-icons.css" rel="stylesheet">

        <link href="Homepage/css/password.css" rel="stylesheet">

    </head>
    
    <body>

        <main>
            <section class="donate-section">
                <div class="section-overlay"></div>
                <div class="container">
                    <div class="row">                    
                        <div class="col-lg-6 col-12 mx-auto">
                            <form class="custom-form donate-form" action="model/reset-password.php" method="POST" role="form">
                                <h2 class="mb-4">Create New Password</h2>
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <p class="mb-3">Please type your new password.</p>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <h5 class="mt-1">New Password</h5>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-2">
                                        <input id="newpassword" name="newpassword" type="password" class="form-control" placeholder="Enter your new password" required>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-2">
                                        <h5 class="mt-1">Confirm Password</h5>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-2">
                                        <input id="confirmpassword" name="confirmpassword" type="password" class="form-control" placeholder="Confirm your new password" required>
                                    </div>

                                    <div class="col-lg-12 col-12 mt-4">
                                        <button type="submit" class="form-control">Confirm</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </main>
        <!-- JAVASCRIPT FILES -->
        <script src="Homepage/js/jquery.min.js"></script>
        <script src="Homepage/js/bootstrap.min.js"></script>
        <script src="Homepage/js/jquery.sticky.js"></script>
        <script src="Homepage/js/counter.js"></script>
        <script src="Homepage/js/custom.js"></script>

    </body>
</html>