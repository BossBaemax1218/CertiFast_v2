<?php // function to get the current page name
function PageName() {
  return substr( $_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") +1);
}

$current_page = PageName();
?>
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
                        <?= isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
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
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Dashboard</h4>
                </li>
                <li class="nav-item <?= $current_page=='dashboard.php' || $current_page=='resident_info.php' || $current_page=='purok_info.php'  ? 'active' : null ?>">
                    <a href="dashboard.php" >
                        <i class="fas fa-home"></i>
                        <p>Overview</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='#' || $current_page=='resident_info.php' || $current_page=='purok_info.php' ? 'active' : null ?>">
                    <a href="dashboard.php" >
                        <i class="fas fa-chart-bar"></i>
                        <p>Analytics</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Documents</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident.php' || $current_page=='generate_resident.php' ? 'active' : null ?>">
                    <a href="resident.php">
                        <i class="icon-people"></i>
                        <p>Resident Information</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='residency_certificate.php' || $current_page=='generate_resident_cert.php' ? 'active' : null ?>">
                    <a href="residency_certificate.php">
                        <i class="icon-home"></i>
                        <p>Barangay Residency</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident_certification.php' || $current_page=='generate_brgy_cert.php' ? 'active' : null ?>">
                    <a href="resident_certification.php">
                        <i class="icon-badge"></i>
                        <p>Barangay Clearance</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident_indigency.php' || $current_page=='generate_indi_cert.php' ? 'active' : null ?>">
                    <a href="resident_indigency.php">
                        <i class="icon-docs"></i>
                        <p>Barangay Indigency</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='business_permit.php' || $current_page=='generate_business_permit.php' ? 'active' : null ?>">
                    <a href="business_permit.php">
                        <i class="icon-briefcase"></i>
                        <p>Business Permit</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Reports</h4>
                </li>
                <li class="nav-item <?= $current_page=='#' ? 'active' : null ?>">
                    <a href="dashboard.php" >
                        <i class="fas fa-chart-line"></i>
                        <p>Sales Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='#' ? 'active' : null ?>">
                    <a href="dashboard.php" >
                        <i class="far fa-file-alt"></i>
                        <p>Certificates Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='user-resident.php' ? 'active' : null ?>">
                    <a href="user-resident.php" >
                        <i class="far fa-id-card"></i>
                        <p>User Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='officials.php' ? 'active' : null ?>">
                    <a href="officials.php">
                        <i class="fas fa-user-tie"></i>
                        <p>Officials and Staff</p>
                    </a>
                </li>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='staff'): ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Settings</h4>
                    </li>
                    <li class="nav-item">
                        <a href="#support" data-toggle="modal">
                            <i class="fas fa-flag"></i>
                            <p>Support</p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Settings</h4>
                </li>
                <li class="nav-item <?= $current_page=='purok.php' || $current_page=='position.php' || $current_page=='users.php' || $current_page=='support.php' || $current_page=='backup.php' ? 'active' : null ?>">
                    <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                        <i class="icon-wrench"></i>
                            <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= $current_page=='purok.php' || $current_page=='position.php' || $current_page=='users.php' || $current_page=='user-resident.php' || $current_page=='support.php' || $current_page=='backup.php' ? 'show' : null ?>" id="settings">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#barangay" data-toggle="modal">
                                    <span class="sub-item">Barangay Info</span>
                                </a>
                            </li>
                            <li class="<?= $current_page=='purok.php' ? 'active' : null ?>">
                                <a href="purok.php">
                                    <span class="sub-item">Purok</span>
                                </a>
                            </li>
                            <li class="<?= $current_page=='position.php' ? 'active' : null ?>">
                                <a href="position.php">
                                    <span class="sub-item">Position</span>
                                </a>
                            </li>
                            
                            <?php if($_SESSION['role']=='staff'):?>
                                <li>
                                    <a href="#support" data-toggle="modal">
                                        <span class="sub-item">Support</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#user_resident" data-toggle="modal">
                                        <span class="sub-item">Resident</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="<?= $current_page=='users.php' ? 'active' : null ?>">
                                    <a href="users.php">
                                        <span class="sub-item">Staff</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page=='user-resident.php' ? 'active' : null ?>">
                                    <a href="user-resident.php">
                                        <span class="sub-item">Resident</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page=='support.php' ? 'active' : null ?>">
                                    <a href="support.php">
                                        <span class="sub-item">Support</span>
                                    </a>
                                </li>
                                <li>                                   
                                    <a class="fw-bold">System</a>
                                    <a href="backup/backup.php">
                                        <span class="sub-item">Backup</span>
                                    </a>
                                    <a href="#restore" data-toggle="modal">
                                        <span class="sub-item">Restore</span>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </li>
                <?php endif ?>
                <br><br>
                <li class="nav-item active">
                    <?php if(isset($_SESSION['role'])):?>
                        <a class="see-all" href="model/logout.php"><i class="bx bx-log-out icon-logout" style="color:white"></i><p>Sign Out</p></a>
                    <?php else: ?>
                        <a class="see-all" href="login.php"><i class="icon-login" style="color:white"><p>Sign In</p></i> </a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
</div>