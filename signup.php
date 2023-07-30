<?php include 'server/dbconnect.php' ?>
<?php
    if (isset($_SESSION['username'])) {
        header('Location: dashboard.php');
    }
    if (isset($_SESSION['fullname'])) {
        header('Location: resident_dashboard.php');
    }
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
        <meta content='width=device-width, initial-scale=1' name='viewport' />
        <title>CertiFast Portal</title>
        <link rel="stylesheet" href="assets/css/login-style.css"/>
        <link rel="icon" href="assets/img/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>  
</head>
<body>
<div class="container">
    <section class="container forms">
        <div class="form" id="myForm">
            <div class="form-content">
                <a class="text-left" href="index.php"><img src="Homepage/vendor-login/images/trans-title.png" alt="" class="image"></a>
                <form method="POST" action="model/signup.php">
                    <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'signup'): ?>
                            <div class="modal-wrapper">
                                <div class="modal" id="signupModal">
                                    <?php if ($_SESSION['success'] == 'danger'): ?>
                                        <h5 class="modal-title text-center w-100 mt-5">
                                            <i class="fas fa-exclamation-triangle fa-3x d-block mx-auto" style="color: #d64242"></i>
                                        </h5>
                                    <?php elseif ($_SESSION['success'] == 'success'): ?>
                                        <h5 class="modal-title text-center w-100 mt-5">
                                            <i class="fas fa-check-circle fa-3x d-block mx-auto" style="color: #34c240"></i>
                                        </h5>
                                    <?php endif; ?>
                                    <br>
                                    <span class="message text-center mb-5 ml-4"><?php echo $_SESSION['message']; ?></span>
                                    <button type="button" class="button" id="closeModalButton">Dismiss</button>
                                </div>
                            </div>                                     
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                    <span class="text-center">To stay connected with us, please sign up with your personal information.</span>
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
                        <button type="submit" value="submit" class="submit-button"> Submit</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Already have an account? <a href="login.php" class="login-link">Login</a></span>
                </div>
            </div>
            <footer class="footer mt-3">
                <div class="container-fluid text-center">
                    <div class="copyright">
                        <?php
                            $year = date("Y");
                            echo $year . " &copy; Barangay Los Amigos - CertiFast Portal";
                        ?>
                    </div>
                    <span><a href="termpolicy.php#featured-term" target="_blank">Privacy and Term of Use</a></span>
                </div>
            </footer>
            <?php if(!isset($_GET['closeModal'])){ ?>
            <script>
                setTimeout(function(){ openModal(); }, 1000);
            </script>
        <?php } ?>
    </section>
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