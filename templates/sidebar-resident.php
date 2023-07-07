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
                        <?= isset($_SESSION['fullname']) ? ucfirst($_SESSION['fullname']) : 'Resident' ?>
                            <span class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Resident' ?></span>
                        <?= isset($_SESSION['fullname']) && $_SESSION['role']=='resident' ? '<span class="caret"></span>' : null ?> 
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-danger">
                <li class="nav-item <?= $current_page=='' || $current_page==''  ? 'active' : null ?>">
                    <a href="resident_dashboard.php" >
                        <i class='bx bxs-dashboard'></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page=='resident_announcement.php'  ? : null ?>">
                    <a href="resident_announcement.php" >
                        <i class='bx bxs-bell' ></i>
                        <p>Announcement</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Account</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_status.php' ? 'active' : null ?>">
                    <a href="resident_status.php">
                        <i class="fas fa-file-alt"></i>
                        <p>Certificates Status</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">History</h4>
                </li>
                <li class="nav-item <?= $current_page=='resident_payment.php' ? 'active' : null ?>">
                    <a href="resident_payment.php">
                        <i class="fas fa-receipt"></i>
                        <p>Payments</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Feedback</h4>
                </li>
                <li class="nav-item <?= $current_page=='residenct_support.php' ? 'active' : null ?>">
                    <a href="resident_support.php">
                        <i class="fas fa-edit"></i>
                        <p>Support & Feedbacks</p>
                    </a>
                </li>
                <br>
                <li class="nav-item active">
                    <a class="see-all" href="model/logout.php"><i class="fas fa-sign-out-alt"></i><p>Logout</p></a>
                </li>
            </ul>
        </div>
    </div>
</div>