<?php include 'server/dbconnect.php' ?>
<?php
    $query1 = "SELECT * FROM tblpurok";
    $result1 = $conn->query($query1);

    $purok = array();
	while($row = $result1->fetch_assoc()){
		$purok[] = $row; 
	}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>CertiFast Portal</title>
        <link href="Homepage/vendor-login/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="Homepage/vendor-login/css/login-style.css">
        <link rel="icon" href="Homepage/vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
<div class="container">
    <section class="container forms">
        <div class="form">
            <div class="form-content">
                <a class="text-center ml-3" href="index.php"><img src="vendor-login/images/trans-title.png" alt="" class="image"></a>
                <form id="myForm" method="POST" action="model/signup.php">
                    <p class="text-center">To stay connected with us, please sign up with your personal information.</p>
                    <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"  id="closeModalButton" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if ($_SESSION['success'] == 'danger'): ?>
                                            <h5 class="modal-title text-center w-100">
                                                <i class="fas fa-exclamation-triangle fa-3x d-block mx-auto" style="color: #d64242"></i>
                                            </h5>
                                        <?php elseif ($_SESSION['success'] == 'success'): ?>
                                            <h5 class="modal-title text-center w-100">
                                                <i class="fas fa-check-circle fa-3x d-block mx-auto" style="color: #34c240"></i>
                                            </h5>
                                        <?php endif; ?>
                                        <br>
                                        <p class="text-center" style="font-size: 24px; font-weight: bold;"><?php echo $_SESSION['message']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <div class="form-group input-field mt-3">
                        <select class="form-control input" required name="purok" id="purok">
                            <option disabled selected>Select Purok Name</option>
                            <?php foreach($purok as $row):?>
                                <option value="<?= ucwords($row['purok']) ?>"><?= $row['purok'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group input-field">
                        <input id="fullname" type="text" name="fullname" autocomplete="off" placeholder="Name" class="input">
                    </div>
                    <div class="form-group input-field">
                        <input id="email" type="text" name="email" autocomplete="off" placeholder="Email" class="input">
                    </div>
                    <div class="form-group input-field">
                        <input id="address" type="text" name="address" autocomplete="off" placeholder="Address" class="input">
                    </div>
                    <div class="form-group input-field">
                        <input id="password" type="password" name="password" autocomplete="off" placeholder="Password" class="password">
                    </div>
                    <div class="form-group button-field">
                        <button type="submit" value="submit" class="submit-button">Submit</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Already have an account? <a href="login.php" class="login-link">Login</a></span>
                </div>
            </div>
            <footer class="footer mt-3">
                <div class="container-fluid">
                    <div class="copyright">
                        <?php
                            $year = date("Y");
                            echo $year . " &copy; Barangay Los Amigos - CertiFast Portal";
                        ?>
                    </div>
                    <p style="font-size: 13px;"><a href="#termprivacy" style="font-size: 13px;" data-toggle="modal">Privacy and Term of Use</a></p>
                </div>
            </footer>
            <?php if(!isset($_GET['closeModal'])){ ?>
            
            <script>
                setTimeout(function(){ openModal(); }, 1000);
            </script>
        <?php } ?>
    </section>
</div>

    <div class="modal fade" id="termprivacy" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Privacy, Cookies, and Terms of Use</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <div class="form-group form-floating-label">
                            <ul class="mt-2">
                                <li>
                                    <p>We prioritize your privacy and safeguard your personal information when using the Barangay Los Amigos - CertiFast Portal. By using the portal, you agree to allow us to collect, use, and store your personal information as needed for the portal's services.</p>
                                    <To>The CertiFast Portal uses necessary cookies for its functionalities to operate effectively. To learn more about the use of cookies and how CertiFast Portal uses personal information on behalf of your institution, please read <a href="termpolicy.php#featured-policy" target="_blank">CertiFast Portal Privacy Statement</a>.</span>
                                    <br><br>
                                    <span>When you select <b>"OK"</b> you are agreeing to Barangay Los Amigos - <a href="termpolicy.php#featured-term" target="_blank"> CertiFast Portal  Terms of Use</a>.</span>
                                </li>                        
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-dismiss="modal" id="closeModalButton">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var closeModalButton = document.getElementById('closeModalButton');
            closeModalButton.addEventListener('click', function() {
                var modal = document.getElementById('signupModal');
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                modal.style.display = 'none';
            });
            var modal = document.getElementById('signupModal');
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            modal.style.display = 'block';
        });
    </script>
    </body>
</html>