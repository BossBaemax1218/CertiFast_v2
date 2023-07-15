<footer class="footer">
    <div class="container-fluid">
        <div class="copyright ml-auto">
            <?php  $year = date("Y"); echo  $year . " &copy CertiFast Portal" ?> .
            <a class="text-muted" href="#term" data-toggle="modal" style="text-decoration: none;">Terms of Service </a> . <a class="text-muted" href="#policy" data-toggle="modal" style="text-decoration: none;">Privacy Policy</a>
        </div>				
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="barangay" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Barangay Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_brgy_info.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Province Name</label>
                                <input type="text" class="form-control" placeholder="Enter Province Name" name="province" required value="<?= $province ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Town Name</label>
                                <input type="text" class="form-control" placeholder="Enter Town Name" name="town" required value="<?= $town ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Barangay Name</label>
                                <input type="text" class="form-control" placeholder="Enter Barangay Name" name="brgy" required value="<?= $brgy ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" required value="<?= $number ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Barangay Email Address</label>
                        <input class="form-control" placeholder="Enter Barangay Email" name="b_email" required value="<?= $b_email ?>">
                    </div>
                    <div class="form-group">
                        <label>Barangay Address</label>
                        <input type="text" class="form-control" placeholder="Enter Barangay Address" name="brgy_address" required value="<?= $brgy_add ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Municipality/City Logo</label><br>
                                <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="120">
                                <input type="file" class='form-control' name="city_logo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Barangay Logo</label><br>
                                <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid" width="120">
                                <input type="file" class='form-control' name="brgy_logo" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dashboard Photo</label><br>
                        <img src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/LogoIcon.png' ?>" class="img-fluid">
                        <input type="file" class='form-control' name="db_img" accept="image/*">
                    </div>
                    <small class="form-text text-muted">Note: pls upload only image and not more than 20MB.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Photo Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_brgy_info.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="form-group">
                        <label>Cover Photo</label><br>
                        <img src="<?= !empty($cp_img) ? 'assets/uploads/'.$cp_img : 'assets/img/LogoIcon.png' ?>" class="img-fluid">
                        <input type="file" class='form-control' name="cp_img" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>About Photo</label><br>
                        <img src="<?= !empty($cp_img) ? 'assets/uploads/'.$cp_img : 'assets/img/LogoIcon.png' ?>" class="img-fluid">
                        <input type="file" class='form-control' name="cp_img" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Qoute Photo</label><br>
                        <img src="<?= !empty($cp_img) ? 'assets/uploads/'.$cp_img : 'assets/img/LogoIcon.png' ?>" class="img-fluid">
                        <input type="file" class='form-control' name="cp_img" accept="image/*">
                    </div>
                    <small class="form-text text-muted">Note: pls upload only image and not more than 20MB.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white">
                <form method="POST" action="model/save_support.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Name" name="name" required >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Email Address" name="email" required >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Contact Number(optional)" name="number">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" rows="5" placeholder="Enter Message" name="message" required ></textarea>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="announcement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white">
                <form method="POST" action="model/save_announcement.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Name" name="username" value="<?= $_SESSION['username'] ?>" readonly >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="date" class="form-control" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" rows="6" placeholder="Enter Message" name="message" required ></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/change_password.php">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Name" readonly name="username" value="<?= $_SESSION['username'] ?>" required >
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Current Password</label>
                        <input type="password" id="cur_pass" class="form-control" placeholder="Enter Current Password" name="cur_pass" required >
                        <span toggle="#cur_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>New Password</label>
                        <input type="password" id="new_pass" class="form-control" placeholder="Enter New Password" name="new_pass" required >
                        <span toggle="#new_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Confirm Password</label>
                        <input type="password" id="con_pass" class="form-control" placeholder="Confirm Password" name="con_pass" required >
                        <span toggle="#con_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="user_changepass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/change_password_user.php">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Enter Name" readonly name="fullname" value="<?= $_SESSION['fullname'] ?>" required >
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Current Password</label>
                        <input type="password" id="cur_user_pass" class="form-control" placeholder="Enter Current Password" name="cur_pass" required >
                        <span toggle="#cur_user_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>New Password</label>
                        <input type="password" id="new_user_pass" class="form-control" placeholder="Enter New Password" name="new_pass" required >
                        <span toggle="#new_user_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group form-floating-label">
                        <label>Confirm Password</label>
                        <input type="password" id="con_user_pass" class="form-control" placeholder="Confirm Password" name="con_pass" required >
                        <span toggle="#con_user_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="restore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restore Database</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/restore.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="form-group form-floating-label">
                        <label>Upload Sql file</label>
                        <input type="file" class="form-control" accept=".sql" name="backup_file" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Restore</button>
            </div>
            </form>
        </div>
    </div>
</div>
 <!-- Modal -->
 <div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_profile.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="text-center">
                        <div id="my_camera" style="height: 250;" class="text-center">
                            <?php if(empty($_SESSION['avatar'])): ?>
                                <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                            <?php else: ?>
                                <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="img img-fluid" width="250" >
                            <?php endif ?>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                            <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                        </div>
                        <div id="profileImage">
                            <input type="hidden" name="profileimg">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= $_SESSION['id']; ?>" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit_user_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_profile_user.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                    <div class="text-center">
                        <div id="my_camera" style="height: 250;" class="text-center">
                            <?php if(empty($_SESSION['avatar'])): ?>
                                <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                            <?php else: ?>
                                <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="img img-fluid" width="250" >
                            <?php endif ?>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                            <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                        </div>
                        <div id="profileImage">
                            <input type="hidden" name="profileimg">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?= $_SESSION['fullname']; ?>" name="fullname">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
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
                        <h3>Barangay Los Amigos - Certifast Portal! </h3>
                        <span>Please read these Terms of Services carefully before accessing or using the online certificate management system.</span>
                        <ul class="mt-2">
                            <li>
                                <label>Account Registration</label>
                                <p>1.1 You must create an account to access and use the CertiFast Portal. You agree to provide accurate and complete information during the registration process and keep your account credentials confidential.</p>
                                <p>1.2 You are responsible for all activities that occur under your account, and you must immediately notify Barangay Los Amigos of any unauthorized use or security breach of your account.</p>
                            </li>
                            <li>
                                <label>Use of the CertiFast Portal</label>
                                <p>2.1 The CertiFast Portal allows registered users to request, manage, and access various certificates and related documents issued by Barangay Los Amigos.</p>
                                <p>2.2 You agree to use the CertiFast Portal only for lawful purposes and in compliance with all applicable laws and regulations.</p>
                                <p>2.3 You are solely responsible for the accuracy and legality of the information you provide when using the CertiFast Portal.</p>
                                <p>2.4 You must not use the CertiFast Portal to:</p>
                                <p>a) Transmit any viruses, malware, or other malicious code.</p>
                                <p>b) Interfere with or disrupt the operation of the CertiFast Portal or its underlying infrastructure.</p>
                                <p>c) Collect or store personal information of other users without their consent.</p>
                                <p>d) Engage in any activity that could harm or damage the reputation of Barangay Los Amigos or its officials.</p>
                            </li>
                            <li>
                                <label>Certificate Requests and Processing</label>
                                <p>3.1 The CertiFast Portal allows you to submit requests for certificates electronically.</p>
                                <p>3.2 While Barangay Los Amigos aims to process certificate requests promptly, it does not guarantee the issuance or processing timeframes.</p>
                                <p>3.3 Barangay Los Amigos reserves the right to reject or cancel any certificate request if it determines, in its sole discretion, that the request violates applicable laws, regulations, or these ToS.</p>
                                <p>3.4 You understand that the issuance of certificates is subject to the verification of the provided information, and any false or misleading information may result in the rejection or revocation of the certificate.</p>
                            </li>
                            <li>
                                <label>Intellectual Property</label>
                                <p>4.1 The CertiFast Portal, including its content and any intellectual property rights therein, is owned by Barangay Los Amigos.
                                <p>4.2 You agree not to reproduce, modify, distribute, or create derivative works based on the CertiFast Portal or any of its content without the prior written consent of Barangay Los Amigos.</p>
                            </li>
                            <li>
                                <label>Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label>Limitation of Liability</label>
                                <p>5.1 Barangay Los Amigos shall not be liable for any direct, indirect, incidental, consequential, or exemplary damages arising out of or in connection with your use of the CertiFast Portal.</p>
                                <p>5.2 You agree to indemnify and hold Barangay Los Amigos and its officials harmless from any claims, losses, damages, liabilities, costs, and expenses arising from your use of the CertiFast Portal.</p>
                            </li>
                            <li>
                                <label>Modification and Termination</label>
                                <p>6.1 Barangay Los Amigos may modify, suspend, or terminate the CertiFast Portal or your access to it at any time, without prior notice and for any reason.</p>
                                <p>6.2 These ToS will remain in effect even after your access to the CertiFast Portal is terminated.</p>
                            </li>
                            <li>
                                <label>Governing Law and Jurisdiction</label>
                                <p>7.1 These ToS shall be governed by and construed in accordance with the laws of the Philippines</p>
                                <p>7.2 Any disputes arising out of or in connection with these ToS shall be subject to the exclusive jurisdiction of the courts of the Philippines.</p>
                                <p><b>These are just a few key legal considerations related to online certificate management systems in the Philippines.</b></p>
                                <p>In the Philippines, the primary legislation governing data privacy and protection is the Data Privacy Act of 2012 (Republic Act No. 10173) and its implementing rules and regulations. It sets out the rights of individuals regarding the collection, use, processing, and disclosure of personal information. If your online certificate management system collects and processes personal data, it is important to comply with the requirements of the Data Privacy Act, including obtaining proper consent, implementing security measures, and ensuring the rights of data subjects.</p>
                                <p>The Electronic Commerce Act of 2000 (Republic Act No. 8792) governs electronic transactions and electronic signatures in the Philippines. It provides a legal framework for the recognition and validity of electronic documents, contracts, and signatures. If your online certificate management system involves electronic transactions, it's important to ensure compliance with the Electronic Commerce Act.</p>
                                <p>The Cybercrime Prevention Act of 2012 (Republic Act No. 10175) addresses cybersecurity concerns and criminalizes various forms of cybercrime, such as hacking, identity theft, and unauthorized access to computer systems. Implementing appropriate security measures to protect the integrity and confidentiality of the online certificate management system's data is crucial.</p>
                                <p>Intellectual property rights may apply to the content, software, or design of your online certificate management system. It's important to ensure that you have the necessary licenses or permissions for any copyrighted material used, and to respect the intellectual property rights of others.</p>
                            </li>
                            <li>
                                <label>Modification and Termination</label>
                                <p>6.1 Barangay Los Amigos may modify, suspend, or terminate the CertiFast Portal or your access to it at any time, without prior notice and for any reason.</p>
                                <p>6.2 These ToS will remain in effect even after your access to the CertiFast Portal is terminated.</p>
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
                        <h3>Barangay Los Amigos - Certifast Portal! </h3>
                        <span>Thank you for using the Barangay Los Amigos - CertiFast Portal. This Privacy Policy explains how we collect, use, and disclose your personal information when you access and use our online certificate management system. By using the CertiFast Portal, you consent to the practices described in this Privacy Policy.</span>
                        <ul class="mt-2">
                            <li>
                                <label>Information We Collect</label>
                                <p>By accessing or using the Certifast Portal, you agree to be bound by these Terms of Use. If you do not agree to these terms, please refrain from using the system.</p>
                            </li>
                            <li>
                                <label>Use of the Certifast Portal</label>
                                <p>1.1 Personal Information: When you create an account on the CertiFast Portal, we collect certain personal information such as your name, email address, contact number, and other relevant details necessary for the issuance and management of certificates.</p>
                                <p>1.2  Usage Information: We may collect information about your use of the CertiFast Portal, including your IP address, browser type, operating system, and pages visited, to improve our services and user experience.</p>
                                <p>1.3 Cookies: We may use cookies and similar technologies to collect information and enhance your user experience. You can manage your cookie preferences through your browser settings.</p>
                            </li>
                            <li>
                                <label>Use of Information</label>
                                <p>2.1 We use the collected information to:</p>
                                <p>a. Provide and maintain the CertiFast Portal and its services.</p>
                                <p>b. Process and manage certificate requests and related documents.</p>
                                <p>c. Communicate with you regarding your account, updates, and notifications.</p>
                                <p>d.  Improve and personalize the CertiFast Portal and user experience.</p>
                                <p>2.2 We may also use the information in an aggregated and de-identified form for statistical analysis and research purposes.</p>
                            </li>
                            <li>
                                <label>Information Sharing and Disclosure</label>
                                <p>3.1 We may share your personal information with:</p>
                                <p>a. Barangay Los Amigos officials and personnel involved in the issuance and management of certificates.</p>
                                <p>b. Service providers and contractors who assist us in operating the CertiFast Portal and providing related services.</p>
                                <p>3.2 We may disclose your personal information if required by law, regulation, or legal process, or to protect our rights, property, or safety, or that of others.</p>
                            </li>
                            <li>
                                <label>Data Security</label>
                                <p>4.1 We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, loss, or alteration.</p>
                                <p>4.2 However, please note that no data transmission or storage system is entirely secure. We cannot guarantee the absolute security of your information.</p>
                            </li>
                            <li>
                                <label>Data Retention</label>
                                <p>5.1 We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law.</p>
                            </li>
                            <li>
                                <label>Your Rights</label>
                                <p>6.1 You have the right to access, update, and correct your personal information stored in the CertiFast Portal. You may also request the deletion of your account and personal data, subject to applicable laws.</p>
                                <p>6.2 For inquiries or requests related to your personal information, please contact us using the contact details provided at the end of this Privacy Policy.</p>
                            </li>
                            <li>
                                <label>Changes to this Privacy Policy</label>
                                <p>7.1 We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the updated Privacy Policy on the CertiFast Portal or by other means of communication.</p>
                            </li>
                            <li>
                                <label>Contact Us</label>
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
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
