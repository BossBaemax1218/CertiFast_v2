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
                    <?php if(!empty($_SESSION['avatar'])): ?>
                        <img src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/'.$_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else: ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>                  
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="<?= isset($_SESSION['fullname']) && $_SESSION['role']=='resident' ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span>
                        <?= isset($_SESSION['fullname']) ? ucfirst($_SESSION['fullname']) : 'Guest User' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Resident' ?></span>
                        <?= isset($_SESSION['fullname']) && $_SESSION['role']=='resident' ? '<span class="caret"></span>' : null ?> 
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
                <li id="announcementbtn" class="nav-item <?= $current_page == 'resident_announcement.php' ? 'active' : null ?>">
                    <a href="resident_announcement.php" class="notification">
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
                    <h4 class="text-section">Form</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_request.php' || $current_page=='resident_request.php' ? 'active' : null ?>">
                    <a href="resident_request.php">
                        <i class="far fa-paper-plane"></i>
                        <p>Submit Request Form</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident_bpermit.php' || $current_page=='resident_bpermit.php' ? 'active' : null ?>">
                    <a href="resident_bpermit.php">
                        <i class="far fa-paper-plane"></i>
                        <p>Apply Business Permit</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">History</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_payment.php' || $current_page=='resident_payment.php' ? 'active' : null ?>">
                    <a href="resident_payment.php">
                        <i class="fas fa-history"></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Support</h4>
                </li>
                <li class="nav-item">
                    <a href="#support" data-toggle="modal">
                        <i class="fas fa-edit"></i>
                        <p>Submit a Support</p>
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
                <br>
                <li class="nav-item <?= $current_page=='purok.php' || $current_page=='position.php' ? 'active' : null ?>">
                    <a href="#settings" data-toggle="collapse" class="collapsed" aria-expanded="false">
                        <i class="fas fa-wrench"></i>
                            <p> Account Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= $current_page=='purok.php' ? 'show' : null ?>" id="settings">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#edit_user_profile" data-toggle="modal">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                                <a href="#user_changepass" data-toggle="modal">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                                <a type="button" data-toggle="tooltip" href="model/remove_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete your account?');" class="btn btn-link btn-danger" data-original-title="Delete" style="text-decoration:none;">
                                    <span class="link-collapse">Delete Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <br>
                <li class="nav-item active">
                    <a class="see-all" href="model/logout.php"><i class="fas fa-sign-out-alt"></i><p>Logout</p></a>
                </li>
            </ul>
        </div>
    </div>
</div>

