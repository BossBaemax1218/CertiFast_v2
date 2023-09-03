<?php
function PageName() {
  return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
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
<?php include 'model/fetch_brgy_info.php' ?>
<?php include 'main-footer.php' ?>

<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if (!empty($_SESSION['avatar'])): ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['username']) && ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff' || $_SESSION['role'] == 'purok leader') ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                            <?= isset($_SESSION['username']) ? ucwords($_SESSION['username']) : 'Guest User' ?>
                            <span class="user-level">
                                <?php
                                if (isset($_SESSION['role'])) {
                                    $role = ucwords($_SESSION['role']);
                                    if ($_SESSION['role'] == 'staff' || $_SESSION['role'] == 'purok leader') {
                                        $role = ucwords($_SESSION['role']) . '';
                                    }
                                    echo $role;
                                } else {
                                    echo 'Guest';
                                }
                                ?>
                            </span>
                            <?php if (isset($_SESSION['username']) && ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff' || $_SESSION['role'] == 'purok leader')) : ?>
                                <span class="caret"></span>
                            <?php endif; ?>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="" type="button" data-target="#edit_profile" data-toggle="modal">
                                    <span class="link-collapse">Profile Picture</span>
                                </a>
                                <a href="" type="button" data-target="#changepass" data-toggle="modal">
                                    <span class="link-collapse">Account Information</span>
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
            <!-- User Info and Collapse Menu -->
            <ul class="nav nav-danger">
                <!-- Purok Leader Specific Menu Items -->
                <?php if(isset($_SESSION['username']) && ($_SESSION['role'] == 'purok leader')): ?>
                    <!-- Introduction -->
                    <li class="nav-item <?= $current_page=='purok_intro.php' ? 'active' : null ?>">
                        <a href="purok_intro.php">
                            <i class="far fa-bookmark"></i>
                            <p>Introduction</p>
                        </a>
                    </li>
                    <!-- Dashboard -->
                    <li class="nav-item <?= $current_page=='dashboard.php' ? 'active' : null ?>">
                        <a href="dashboard.php">
                            <i class="bx bxs-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Notification</h4>
                    </li>
                    <!-- Announcement -->
                    <li id="announcementbtn" class="nav-item <?= $current_page == 'purok_announcement.php' ? 'active' : null ?>">
                        <a type="button" href="purok_announcement.php" class="notification">
                            <i class='far fa-bell'></i>
                            <p>Announcement</p>
                            <?php if ($totalAnnouncements > 0): ?>
                                <span id="notification-badge" class="badge badge-primary"><?= $totalAnnouncements ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <!-- Records -->
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Records</h4>
                    </li>
                    <li class="nav-item <?= $current_page=='purok_request.php' ? 'active' : null ?>">
                        <a href="purok_request.php">
                            <i class='bx bxs-file'></i>
                            <p>Resident Request</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page=='purok_records.php' ? 'active' : null ?>">
                        <a href="purok_records.php">
                            <i class='bx bx-file-find'></i>
                            <p>Purok Records</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">History</h4>
                    </li>
                    <li class="nav-item <?= $current_page=='list_purok_resident.php' ? 'active' : null ?>">
                        <a href="list_purok_resident.php">
                            <i class='fas fa-stream'></i>
                            <p>List of Resident</p>
                        </a>
                    </li>
                <?php endif ?>

                <!-- Staff and Administrator Specific Menu Items -->
                <?php if(isset($_SESSION['username']) && ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff')): ?>
                    <!-- Dashboard -->
                    <li class="nav-item <?= $current_page=='dashboard.php' ? 'active' : null ?>">
                        <a href="dashboard.php">
                            <i class="fas fa-chart-bar"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php if(isset($_SESSION['username']) && $_SESSION['role']=='staff'): ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Notification</h4>
                    </li>
                    <li class="nav-item">
                        <a href="#announcement" data-toggle="modal">
                            <i class='fas fa-bullhorn'></i>
                            <p>Post Announcement</p>
                        </a>
                    </li>
                    <?php endif ?>
                    <!-- Files Section -->
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Certifications</h4>
                    </li>
                    <li class="nav-item <?= $current_page=='list_certificates.php' ? 'active' : null ?>">
                        <a href="list_certificates.php">
                            <i class="fa-solid fa-list"></i>
                            <p>List of Certificates</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page=='business_permit.php' ? 'active' : null ?>">
                        <a href="business_permit.php">
                            <i class="fa-solid fa-list"></i>
                            <p>List of Businesses</p>
                        </a>
                    </li>
                    <!-- Reports Section -->
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Reports</h4>
                    </li>
                    <li class="nav-item <?= $current_page=='transaction_reports.php' ? 'active' : null ?>">
                        <a href="transaction_reports.php">
                            <i class="fa-solid fa-receipt"></i>
                            <p>Transaction Reports</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page=='certificates_reports.php' ? 'active' : null ?>">
                        <a href="certificates_reports.php">
                            <i class="fa-solid fa-file-lines"></i>
                            <p>Certificates Reports</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page=='resident.php' ? 'active' : null ?>">
                        <a href="resident.php">
                            <i class="fa-solid fa-house-chimney-user"></i>
                            <p>Resident Reports</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page=='officials.php' ? 'active' : null ?>">
                        <a href="officials.php">
                            <i class="fas fa-user-tie"></i>
                            <p>Official's Reports</p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Notification</h4>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#announcement" data-toggle="modal">
                            <i class="fa-solid fa-bullhorn"></i> 
                            <p>Post Announcement</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $current_page == 'support.php' ? 'active' : null ?>">
                        <a href="support.php">
                            <i class="fa-regular fa-envelope"></i> 
                            <p>Support</p>
                        </a>
                    </li>
                    <?php endif ?>
                
                <!-- Settings Section -->
                <?php if(isset($_SESSION['username'])): ?>
                    <?php if($_SESSION['role'] == 'purok leader'): ?>
                        <!-- Purok Leader Settings -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="settings"></i>
                            </span>
                            <h4 class="text-section">Settings</h4>
                        </li>
                        <li class="nav-item">
                            <a href="" type="button" data-target="#support" data-toggle="modal">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <p>Report a problem</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $current_page=='archive_purok_records.php' ? 'active' : null ?>">
                            <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                <i class="fa-regular fa-rectangle-list"></i>
                                <p>Activity Log</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?= $current_page == 'archive_purok_records.php' ? 'show' : null ?>" id="settings">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="archive_purok_records.php">
                                            <i class="fa fa-trash"></i> Trash
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php elseif ($_SESSION['role'] == 'staff'): ?>
                        <!-- Staff Settings -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="settings"></i>
                            </span>
                            <h4 class="text-section">Help & Support</h4>
                        </li>
                        <li class="nav-item">
                            <a href="" type="button" data-target="#support" data-toggle="modal">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <p>Report a problem</p>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endif ?>

                <!-- Administrator Settings -->
                    <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="settings"></i>
                            </span>
                            <h4 class="text-section">Settings</h4>
                        </li>
                        <li class="nav-item <?= $current_page == 'purok.php' || $current_page == 'position.php' || $current_page == 'announcement.php' || $current_page == 'user-resident.php' || $current_page == 'users.php' ? 'active' : null ?>">
                            <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                <i class="fa-solid fa-envelope-open-text"></i>
                                <p>Preferences</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?= $current_page == 'purok.php' || $current_page == 'position.php' || $current_page == 'announcement.php'  || $current_page == 'users.php' || $current_page == 'user-resident.php' ? 'show' : null ?>" id="settings">
                                <ul class="nav nav-collapse">
                                    <li class="<?= $current_page == 'purok.php' ? 'active' : null ?>">
                                        <a href="purok.php">
                                            <i class="fa-solid fa-list-check"></i> Purok Info
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'position.php' ? 'active' : null ?>">
                                        <a href="position.php">
                                            <i class="fa-solid fa-list-check"></i> Position Info
                                        </a>
                                    </li>
                                    <?php if ($_SESSION['role'] == 'staff'): ?>
                                        <li class="nav-section">
                                            <span class="sidebar-mini-icon">
                                                <i class="settings"></i>
                                            </span>
                                            <h4 class="text-section">Help & Support</h4>
                                        </li>
                                        <li class="nav-item">
                                            <a href="" data-target="#announcement" data-toggle="modal">
                                                <i class='fas fa-bullhorn'></i>
                                                <p>Post Announcement</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="" type="button" data-target="#support" data-toggle="modal">
                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                <p>Report a problem</p>
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="<?= $current_page == 'users.php' ? 'active' : null ?>">
                                            <a href="users.php">
                                                <i class="fa-solid fa-list-check"></i> Staff Info
                                            </a>
                                        </li>
                                        <li class="<?= $current_page == 'user-resident.php' ? 'active' : null ?>">
                                            <a href="user-resident.php">
                                                <i class="fa-solid fa-list-check"></i> Resident Info
                                            </a>
                                        </li>
                                        <li class="<?= $current_page == 'announcement.php' ? 'active' : null ?>">
                                            <a href="announcement.php">
                                                <i class="fa-solid fa-list-check"></i> Announcement Info
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#barangay" data-toggle="modal">
                                                <i class="fa-solid fa-list-check"></i> Barangay Info
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>
                    <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'): ?>
                        <li class="nav-item <?= $current_page == 'trash_cert_files.php' || $current_page == 'trash_trans_files.php' || $current_page == 'trash_support_files.php' || $current_page == 'trash_files.php' || $current_page=='backup.php' ? 'active' : null ?>">
                            <a href="#system" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                <i class="fa-solid fa-wrench"></i>
                                <p>Setting</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?=   $current_page == 'trash_cert_files.php' || $current_page == 'trash_trans_files.php' || $current_page == 'trash_support_files.php' || $current_page == 'trash_files.php' || $current_page=='backup.php'  ? 'show' : null ?>" id="system">
                                <ul class="nav nav-collapse">
                                    <li class="<?= $current_page == 'trash_cert_files.php' || $current_page == 'trash_trans_files.php' || $current_page == 'trash_support_files.php' || $current_page == 'trash_files.php' ? 'active' : null ?>">
                                        <a href="#trash" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                            <i class="fa fa-trash"></i>
                                            <p>Trash</p>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse <?= $current_page == 'trash_cert_files.php' || $current_page == 'trash_trans_files.php' || $current_page == 'trash_support_files.php' || $current_page == 'trash_files.php'  ? 'show' : null ?>" id="trash">
                                            <ul class="nav nav-collapse">
                                                <li class="nav-item <?= $current_page == 'trash_files.php' ? 'active' : null ?>">
                                                    <a href="trash_files.php">
                                                        <i class="fa-regular fa-folder-open"></i> Resident Files
                                                    </a>
                                                </li>
                                                <li class="nav-item <?= $current_page == 'trash_permit_files.php' ? 'active' : null ?>">
                                                    <a href="trash_permit_files.php">
                                                        <i class="fa-regular fa-folder-open"></i>  Permit Files
                                                    </a>
                                                </li>
                                                <li class="nav-item <?= $current_page == 'trash_cert_files.php' ? 'active' : null ?>">
                                                    <a href="trash_cert_files.php">
                                                        <i class="fa-regular fa-folder-open"></i>  Certificates Files
                                                    </a>
                                                </li>
                                                <li class="nav-item <?= $current_page == 'trash_trans_files.php' ? 'active' : null ?>">
                                                    <a href="trash_trans_files.php">
                                                        <i class="fa-regular fa-folder-open"></i>  Transaction Files
                                                    </a>
                                                </li>
                                                <li class="nav-item <?= $current_page == 'trash_support_files.php' ? 'active' : null ?>">
                                                    <a href="trash_support_files.php">
                                                        <i class="fa-regular fa-folder-open"></i>  Support Files
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="<?= $current_page=='backup/backup.php' ? 'active' : null ?>">
                                        <a href="#backres" data-toggle="collapse" class="collapsed" aria-expanded="false">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            <p>Backup & Restore</p>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse <?= $current_page == 'backup.php' ? 'show' : null ?>" id="backres">
                                            <ul class="nav nav-collapse">
                                                <li>
                                                    <a href="backup/backup.php">
                                                        <i class="fa-solid fa-file-arrow-down"></i> Backup
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#restore" data-toggle="modal">
                                                        <i class="fa-solid fa-file-arrow-up"></i> Restore
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
