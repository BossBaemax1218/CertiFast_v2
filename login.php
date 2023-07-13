<?php
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: dashboard.php');
    }
    if (isset($_SESSION['fullname'])) {
        header('Location: resident_dashboard.php');
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Login - CertiFast Portal  </title>

        <link rel="stylesheet" href="vendor-login/css/login-style.css"/>
        <link rel="icon" href="vendor-login/images/CFLogo2.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link href="vendor-login/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'/>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>         
    </head>
    <body>
        <section class="container forms">
            <div class="form">
                <div class="form-content">
                    <a class="text-center" href="index.php"><img src="vendor-login/images/trans-title.png" alt="" class="image"></a>
                    <form method="POST" action="model/login.php">
                        <p class="text-center">Please sign in correctly with your personal information.</p>
                        <?php if (isset($_SESSION['message']) && isset($_SESSION['success']) && isset($_SESSION['form']) && $_SESSION['form'] == 'login'): ?>
                            <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="text-center" style="font-size: 18px;">Message</p>
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" id="closeModalButton">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <div class="form-group input-field">
                            <input id="email" type="text" name="email" autocomplete="off" placeholder="Email or username" class="input">
                        </div>
                        <div class="form-group input-field">
                            <input id="password" type="password" name="password" autocomplete="off" placeholder="Password" class="password">
                        </div>
                        <div class="form-link">
                            <p style="font-size: 13px;">Do you agree to our <a href="#term" style="font-size: 13px;" data-toggle="modal">Term of Services</a> and <a href="#policy" style="font-size: 13px;" data-toggle="modal">Privacy Policy</a></p>
                        </div>
                        <div class="form-link">
                            <a href="forgot-password.php" class="forgot-pass">Forgot password?</a>
                        </div>
                        <div class="form-group button-field">
                            <button type="submit" value="submit" class="fas fa-sign-in-alt text-center" style='font-size:20px'> Submit</button>
                        </div>
                    </form>
                    <div class="form-link">
                        <span>Don't have an account? <a href="signup.php" class="signup-link">Signup</a></span>
                    </div>
                </div>
                <footer class="footer mt-3">
                    <div class="container-fluid">
                        <div class="copyright ml-auto text-center" style="font-size: 14px;">
                            <?php  $year = date("Y"); echo  $year . " &copy Barangay Los Amigos - CertiFast Portal" ?>
                        </div>				
                    </div>
                </footer>
            </div>
        </section>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var closeModalButton = document.getElementById('closeModalButton');
            closeModalButton.addEventListener('click', function() {
                var modal = document.getElementById('loginModal');
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                modal.style.display = 'none';
            });
            var modal = document.getElementById('loginModal');
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            modal.style.display = 'block';
        });
    </script>
    <!-- Modal -->
<div class="modal fade" id="term" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Term of Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="form-group form-floating-label">
                        <span>Please read these Terms of Services carefully before accessing or using the online certificate management system.</span>
                        <ul class="mt-2">
                            <li>
                                <label style="font-weight:bold;">Acceptance of Terms</label>
                                <p>By accessing or using the Certifast Portal, you agree to be bound by these Terms of Use. If you do not agree to these terms, please refrain from using the system.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeModalButton">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="policy" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRIVACY POLICY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="form-group form-floating-label">
                        <span>Thank you for using the Barangay Los Amigos - CertiFast Portal. This Privacy Policy explains how we collect, use, and disclose your personal information when you access and use our online certificate management system. By using the CertiFast Portal, you consent to the practices described in this Privacy Policy.</span>
                        <ul class="mt-2">
                            <li>
                                <label style="font-weight:bold;">Information We Collect</label>
                                <p>By accessing or using the Certifast Portal, you agree to be bound by these Terms of Use. If you do not agree to these terms, please refrain from using the system.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of the Certifast Portal</label>
                                <p>1.1 Personal Information: When you create an account on the CertiFast Portal, we collect certain personal information such as your name, email address, contact number, and other relevant details necessary for the issuance and management of certificates.</p>
                                <p>1.2  Usage Information: We may collect information about your use of the CertiFast Portal, including your IP address, browser type, operating system, and pages visited, to improve our services and user experience.</p>
                                <p>1.3 Cookies: We may use cookies and similar technologies to collect information and enhance your user experience. You can manage your cookie preferences through your browser settings.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Use of Information</label>
                                <p>2.1 We use the collected information to:</p>
                                <p>a. Provide and maintain the CertiFast Portal and its services.</p>
                                <p>b. Process and manage certificate requests and related documents.</p>
                                <p>c. Communicate with you regarding your account, updates, and notifications.</p>
                                <p>d.  Improve and personalize the CertiFast Portal and user experience.</p>
                                <p>2.2 We may also use the information in an aggregated and de-identified form for statistical analysis and research purposes.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Information Sharing and Disclosure</label>
                                <p>3.1 We may share your personal information with:</p>
                                <p>a. Barangay Los Amigos officials and personnel involved in the issuance and management of certificates.</p>
                                <p>b. Service providers and contractors who assist us in operating the CertiFast Portal and providing related services.</p>
                                <p>3.2 We may disclose your personal information if required by law, regulation, or legal process, or to protect our rights, property, or safety, or that of others.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Data Security</label>
                                <p>4.1 We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, loss, or alteration.</p>
                                <p>4.2 However, please note that no data transmission or storage system is entirely secure. We cannot guarantee the absolute security of your information.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Data Retention</label>
                                <p>5.1 We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Your Rights</label>
                                <p>6.1 You have the right to access, update, and correct your personal information stored in the CertiFast Portal. You may also request the deletion of your account and personal data, subject to applicable laws.</p>
                                <p>6.2 For inquiries or requests related to your personal information, please contact us using the contact details provided at the end of this Privacy Policy.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Changes to this Privacy Policy</label>
                                <p>7.1 We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the updated Privacy Policy on the CertiFast Portal or by other means of communication.</p>
                            </li>
                            <li>
                                <label style="font-weight:bold;">Contact Us</label>
                                <p>If you have any questions, concerns, or requests regarding this Privacy Policy, please contact us at losamigosdavaocity.gov@gmail.com and (082) 228-8984.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeModalButton">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </body>
</html>