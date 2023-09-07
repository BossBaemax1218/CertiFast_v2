<?php
function PageName() {
  return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
}

$current_page = PageName();
?>
<?php
include 'server/db_connection.php';

$query1 = "SELECT COUNT(*) AS total_announcements FROM tbl_announcement";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();
$totalAnnouncements = $row1['total_announcements'];
?>
<?php 
$query1 = "SELECT * FROM tbl_user_resident WHERE user_type= 'resident' LIMIT 1";
$result1 = $conn->query($query1); 

$supportres = array();
while($row2 = $result1->fetch_assoc()){
    $supportres[] = $row2; 
}?>
<style>
.notification-badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
}
</style>
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(!empty($_SESSION['photo'])): ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['photo']) ? $_SESSION['photo'] : 'assets/uploads/avatar/'.$_SESSION['photo'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>                  
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['fullname']) && ($_SESSION['role'] == 'resident') ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                            <?= isset($_SESSION['fullname']) ? ucwords($_SESSION['fullname']) : 'Guest User' ?>
                            <span class="user-level">
                                <?php
                                if (isset($_SESSION['role'])) {
                                    $role = ucwords($_SESSION['role']);
                                    if ($_SESSION['role'] == 'resident') {
                                        $role = ucwords($_SESSION['role']) . '';
                                    }
                                    echo $role;
                                } else {
                                    echo 'Guest';
                                }
                                ?>
                            </span>
                            <?php if (isset($_SESSION['fullname']) && ($_SESSION['role'] == 'resident' || $_SESSION['role'] == 'resident' || $_SESSION['role'] == 'resident')) : ?>
                                <span class="caret"></span>
                            <?php endif; ?>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="" type="button" data-target="#edit_user_profile" data-toggle="modal">
                                    <span class="link-collapse">Account Information</span>
                                </a>
                                <a href="" type="button" data-target="#user_changepass" data-toggle="modal">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                                <a href="" type="button" data-target="#DeactivateDeleteModal" data-toggle="modal">
                                    <span class="link-collapse">Delete Account</span>
                                </a>
                                <br>
                                <a type="button" class="see-all btn btn-danger" href="model/logout.php" style="padding: 4px 5px; text-decoration:none;">
                                    <span class="link-collapse text-white"> Sign out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-danger">
                <li class="nav-item <?= $current_page=='resident_intro.php' || $current_page=='resident_intro.php' ? 'active' : null ?>">
                    <a href="resident_intro.php">
                        <i class="far fa-bookmark"></i>
                        <p>Introduction</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident_dashboard.php' || $current_page=='resident_dashboard.php'  ? 'active' : null ?>">
                    <a href="resident_dashboard.php" >
                        <i class='bx bxs-dashboard'></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Notification</h4>
                </li>
                <li id="announcementbtn" class="nav-item <?= $current_page == 'resident_announcement.php' ? 'active' : null ?>">
                    <a type="button" href="resident_announcement.php" class="notification">
                        <i class='far fa-bell'></i>
                        <p>Announcement</p>
                        <?php if ($totalAnnouncements > 0): ?>
                            <span id="notification-badge" class="badge badge-primary"><?= $totalAnnouncements ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Profiling</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_profiling.php' || $current_page=='resident_profiling.php' ? 'active' : null ?>">
                    <a href="resident_profiling.php">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <p>Personal Information</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Certification</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_request.php' || $current_page=='resident_request.php' ? 'active' : null ?>">
                    <a href="resident_request.php">
                        <i class="fa-regular fa-paper-plane"></i>
                        <p>Request Cetificates</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">History</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_certificates.php' || $current_page=='resident_certificates.php' ? 'active' : null ?>">
                    <a href="resident_certificates.php">
                        <i class="fa-solid fa-certificate"></i>
                        <p>Certificates History</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident_payment.php' || $current_page=='resident_payment.php' ? 'active' : null ?>">
                    <a href="resident_payment.php">
                        <i class="fa-solid fa-file-invoice"></i>
                        <p>Payments History</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Reports</h4>
                </li>
                <li class="nav-item">
                    <a href="" type="button" data-target="#support_user" data-toggle="modal">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <p>Report a problem</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Services</h4>
                </li>
                <li class="nav-item">
                    <a href="index.php#services">
                        <i class="far fa-lightbulb"></i>
                        <p>Services</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="DeactivateDeleteModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Deleting your CertiFast account.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <form method="POST" action="model/delete_account.php">
                        <div class="col-md-12">
                            <div class="form-group">
                                <span>If you want to take a break from CertiFast, please let us know if you want to permanently delete your CertiFast account.</span>
                                <input type="text" class="form-control mt-2 text-left btn btn-outline-dark disabled" id="email" name="email" value="<?= $_SESSION['user_email'] ?>"> 
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="reason" id="reason" required>
                                    <option value="" disabled selected>Select a reason</option>
                                    <option value="take a break">Take a break</option>
                                    <option value="personal reasons">Personal reasons</option>
                                    <option value="privacy concern">Privacy concerns</option>
                                    <option value="transfer residency">Transfer Residency</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Additional comments" name="message" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <input type="hidden" name="active" value="inactive">
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">
                            <span class="link-collapse">Cancel</span>
                        </button>
                        <button class="btn btn-primary mr-2" type="submit" name="submit">
                            <span class="link-collapse">Continue</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div class="modal" id="support_user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contact Concern</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/save_support.php">
                    <div class="form-group">
                        <input type="text" class="form-control text-left btn btn-outline-dark disabled" placeholder="Enter Name" name="name" value="<?= $_SESSION['fullname'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control text-left btn btn-outline-dark disabled" placeholder="samplename@gmail.com" name="email" value="<?= $_SESSION['user_email'] ?>" >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Contact Number(optional)" name="number" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject (Concern, Problems and etc...)" name="subject" required>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" rows="5" placeholder="Message" name="message" required ></textarea>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <?php foreach ($supportres as $row2) { ?>
                    <input type="hidden" name="user" value="<?= $row2['user_type'] ?>" required >
                    <?php } ?>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit_user_profile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Personal and Account Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/edit_profile_user.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div class="text-center">
                    <div id="my_camera" style="height: 250;" class="text-center">
                        <?php if(empty($_SESSION['photo'])): ?>
                            <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                        <?php else: ?>
                            <img src="<?= preg_match('/data:image/i', $_SESSION['photo']) ? $_SESSION['photo'] : 'assets/uploads/avatar/'.$_SESSION['photo'] ?>" alt="..." class="img img-fluid" width="250" >
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
            <div class="modal-footer d-flex justify-content-center">
                <input type="hidden" value="<?= $_SESSION['fullname']; ?>" name="fullname">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="user_changepass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="model/change_password_user.php">
                    <input type="hidden" class="form-control" placeholder="Enter Name" name="fullname" value="<?= $_SESSION['fullname'] ?>" required >
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
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>






