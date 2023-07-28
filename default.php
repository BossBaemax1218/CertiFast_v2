<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>CertiFast Portal</title>
        <link rel="stylesheet" href="vendor/css/default-style.css">
        <link rel="icon" href="vendor/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>        
    </head>
    <body>
    <div class="container">
        <section class="container forms">
            <div class="form">
                <div class="form-content">
                    <a class="text-left" href="https://losamigos.certifast.org/index.php"><img src="vendor/images/SealLogo.png" alt="" class="text-center image"></a>
                    <h2 class="text-center mt-4"><b>CertiFast Portal</b></h2>
                    <p class="text-center" style="font-size:16px;">CertiFast Portal is an online platform for efficient and streamlined certificate management, facilitating the issuance, tracking, and verification of certificates for various purposes.</p>
                    <a href="https://losamigos.certifast.org/index.php" target="_blank" class="form-group button-field mt-3" style="text-decoration: none;">
                        <button type="button" class="btn btn-danger" style="text-decoration: none; border-raduis:none; border: none;">Login to Barangay Los Amigos CertiFast</button>
                    </a>
                </div>
                <footer class="footer mt-3">
                    <div class="container-fluid">
                        <div class="copyright">
                            <?php
                                $year = date("Y");
                                echo $year . " &copy; Barangay Los Amigos - CertiFast Portal";
                            ?>
                        </div>
                        <p style="font-size: 13px;"><a href="losamigos/termpolicy.php" style="font-size: 13px; text-decoration: none;">Privacy and Term of Use</a></p>
                    </div>
                </footer>
            </div>
        </section>
    </div>
    </body>
</html>