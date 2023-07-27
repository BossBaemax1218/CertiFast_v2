<?php
function PageName() {
  return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
}

$current_page = PageName();
?>
<?php
include 'server/server.php';

$query1 = "SELECT COUNT(*) AS total_announcements FROM tbl_announcement";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();
$totalAnnouncements = $row1['total_announcements'];
?>
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
<?php include 'model/fetch_brgy_info.php' ?>
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(!empty($_SESSION['avatar'])): ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>                  
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && $_SESSION['role']=='administrator' ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                        <?= isset($_SESSION['username']) ? ucwords($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucwords($_SESSION['role']) : 'Guest' ?></span>
                        <?= isset($_SESSION['username']) && $_SESSION['role']=='administrator' ? '<span class="caret"></span>' : null ?> 
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#edit_profile" data-toggle="modal">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                                <a href="#changepass" data-toggle="modal">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-danger">
            <?php if(isset($_SESSION['username']) && ($_SESSION['role'] == 'staff' || $_SESSION['role'] == 'purok leader')): ?>
                <li class="nav-item <?= $current_page=='purok_intro.php' || $current_page=='purok_intro.php' ? 'active' : null ?>">
                    <a href="purok_intro.php">
                        <i class="far fa-bookmark"></i>
                        <p>Introduction</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if(isset($_SESSION['username']) && ($_SESSION['role'] == 'purok leader')): ?>
                <li class="nav-item <?= $current_page=='dashboard.php' || $current_page=='dashboard.php' || $current_page=='dashboard.php'  ? 'active' : null ?>">
                    <a href="dashboard.php" >
                        <i class="bx bxs-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li id="announcementbtn" class="nav-item <?= $current_page == 'purok_announcement.php' ? 'active' : null ?>">
                    <a href="purok_announcement.php" class="notification">
                        <i class='far fa-bell'></i>
                        <p>Announcement</p>
                        <?php if ($totalAnnouncements > 0): ?>
                            <span id="notification-badge" class="notification-badge"><?= $totalAnnouncements ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Records</h4>
                </li>
                <li class="nav-item <?= $current_page=='purok_records.php' || $current_page=='purok_records.php' || $current_page=='purok_records.php'  ? 'active' : null ?>">
                    <a href="purok_records.php" >
                        <i class='bx bx-file-find' ></i>
                        <p>Purok Management</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='purok_request.php' || $current_page=='purok_request.php' || $current_page=='purok_request.php'  ? 'active' : null ?>">
                    <a href="purok_request.php" >
                        <i class='bx bxs-file' ></i>
                        <p>Requester Management</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if(isset($_SESSION['username']) && ($_SESSION['role'] == 'staff' || $_SESSION['role'] == 'administrator')): ?>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Dashboard</h4>
                </li>
                <li class="nav-item <?= $current_page=='dashboard.php' || $current_page=='resident_info.php' || $current_page=='purok_info.php'  ? 'active' : null ?>">
                    <a href="dashboard.php" >
                        <i class="fas fa-chart-bar"></i>
                        <p>Overview</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Files</h4>
                </li>
                <li class="nav-item <?= $current_page=='list_certificates.php' || $current_page=='generate_brgy_cert.php' || $current_page=='generate_residency_cert.php' || $current_page=='generate_indi_cert.php' ? 'active' : null ?>">
                    <a href="list_certificates.php">
                        <i class="fas fa-stream"></i>
                        <p>List of Certificates</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='business_permit.php' || $current_page=='generate_business_permit.php'  ? 'active' : null ?>">
                    <a href="business_permit.php" >
                        <i class="fas fa-stream"></i>
                        <p>List of Business</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Reports</h4>
                </li>
                <li class="nav-item <?= $current_page=='transaction_reports.php' || $current_page=='revenue.php' || $current_page=='resident_info.php'  ? 'active' : null ?>">
                    <a href="transaction_reports.php" >
                        <i class="fas fa-history"></i>
                        <p>Transaction Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='certificates_reports.php' || $current_page=='resident_info.php' || $current_page=='purok_info.php'  ? 'active' : null ?>">
                    <a href="certificates_reports.php" >
                        <i class="far fa-file-alt"></i>
                        <p>Certificates Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident.php' || $current_page=='generate_resident.php' ? 'active' : null ?>">
                    <a href="resident.php" >
                        <i class="far fa-id-card"></i>
                        <p>Resident Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='officials.php' || $current_page=='resident_info.php' || $current_page=='purok_info.php'  ? 'active' : null ?>">
                    <a href="officials.php">
                        <i class="fas fa-user-tie"></i>
                        <p>Official's Reports</p>
                    </a>
                </li>
            <?php endif ?>
                <?php if(isset($_SESSION['username'])): ?>
                    <?php if($_SESSION['role'] == 'purok leader'): ?>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="settings"></i>
                            </span>
                            <h4 class="text-section">Settings</h4>
                        </li>
                        <li class="nav-item">
                            <a href="#support" data-toggle="modal">
                                <i class="fas fa-edit"></i>
                                <p>Support</p>
                            </a>
                        </li>
                    <?php elseif ($_SESSION['role'] == 'staff'): ?>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="settings"></i>
                            </span>
                            <h4 class="text-section">Settings</h4>
                        </li>
                        <li class="nav-item">
                            <a href="#announcement" data-toggle="modal">
                                <i class='fas fa-bullhorn'></i>
                                <p>Post Announcement</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#support" data-toggle="modal">
                                <i class="fas fa-edit"></i>
                                <p>Support</p>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endif ?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="settings"></i>
                            </span>
                            <h4 class="text-section">Settings</h4>
                        </li>
                        <li class="nav-item <?= $current_page=='purok.php' || $current_page=='position.php' || $current_page=='users.php' || $current_page=='support.php' || $current_page=='backup.php' ? 'active' : null ?>">
                            <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                <i class="fas fa-wrench"></i>
                                    <p>Settings</p>
                                <span class="caret"></span>
                            </a>
                        <div class="collapse <?= $current_page=='purok.php' || $current_page=='position.php' || $current_page=='users.php' || $current_page=='user-resident.php' || $current_page=='support.php' || $current_page=='backup.php' ? 'show' : null ?>" id="settings">
                            <ul class="nav nav-collapse">
                                <li class="<?= $current_page=='purok.php' ? 'active' : null ?>">
                                    <a href="purok.php">
                                        <span class="sub-item">Purok Management</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page=='position.php' ? 'active' : null ?>">
                                    <a href="position.php">
                                        <span class="sub-item">Position Management</span>
                                    </a>
                                </li>
                                <?php if($_SESSION['role']=='staff'):?>
                                        <li class="nav-section">
                                        <span class="sidebar-mini-icon">
                                            <i class="settings"></i>
                                        </span>
                                        <h4 class="text-section">Settings</h4>
                                    </li>
                                        <li class="nav-item">
                                            <a href="#announcement" data-toggle="modal">
                                                <i class='fas fa-bullhorn'></i>
                                                <p>Post Announcement</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="#support" data-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                            <p>Support</p>
                                        </a>
                                    </li>
                                    <?php else: ?>
                                    <li class="<?= $current_page=='users.php' ? 'active' : null ?>">
                                        <a href="users.php">
                                            <span class="sub-item">Staff Management</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page=='user-resident.php' ? 'active' : null ?>">
                                        <a href="user-resident.php">
                                            <span class="sub-item">Resident Management</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#barangay" data-toggle="modal">
                                            <span class="sub-item">Brgy Management</span>
                                        </a>
                                    </li>
                                    <!--<li>
                                        <a href="#photo" data-toggle="modal">
                                            <span class="sub-item">Photo Management</span>
                                        </a>
                                    </li>-->
                                    <li>
                                        <a href="#announcement" data-toggle="modal">
                                            <span class="sub-item">Post Announcement</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page=='support.php' ? 'active' : null ?>">
                                        <a href="support.php">
                                            <span class="sub-item">Support & Feedback</span>
                                        </a>
                                    </li>
                                    <li>                                   
                                        <a class="fw-bold">System</a>
                                        <a href="backup/backup.php">
                                            <span class="sub-item">Backup Management</span>
                                        </a>
                                        <a href="#restore" data-toggle="modal">
                                            <span class="sub-item">Restore Management</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>
                <br>
                <li class="nav-item active">
                    <a class="see-all" href="model/logout.php"><i class="fas fa-sign-out-alt"></i><p>Logout</p></a>
                </li>
            </ul>
        </div>
    </div>
</div>