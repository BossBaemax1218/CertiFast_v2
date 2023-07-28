<?php include 
'server/db_connection.php';

$query = "SELECT * FROM tbl_announcement ORDER BY `date_posted` DESC";
$result = $conn->query($query);

$purok = array();
while ($row = $result->fetch_assoc()) {
    $postedTime = strtotime($row['date_posted']);
    $currentTimestamp = time();
    $timeDiff = $currentTimestamp - $postedTime;

    if ($timeDiff < 60) {
        $timeDisplay = $timeDiff . ' seconds ago';
    } elseif ($timeDiff < 3600) {
        $timeDisplay = round($timeDiff / 60) . ' minutes ago';
    } elseif ($timeDiff < 86400) {
        $timeDisplay = round($timeDiff / 3600) . ' hours ago';
    } elseif ($timeDiff < 2592000) {
        $timeDisplay = round($timeDiff / 86400) . ' days ago';
    } elseif ($timeDiff < 31536000) {
        $timeDisplay = round($timeDiff / 2592000) . ' months ago';
    } else {
        $timeDisplay = round($timeDiff / 31536000) . ' years ago';
    }

    $row['time_display'] = $timeDisplay;
    $purok[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>                  
	<title>CertiFast Portal</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
        <?php include 'templates/main-header-resident.php' ?>
            <?php include 'templates/sidebar-resident.php' ?>
		    <div class="main-panel mt-5">
			    <div class="container">
                        <h1 class="text-center fw-bold mt-5" style="font-size: 400%;">Announcement</h1>
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
                    <div class="page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <section class=" text-center two-column-list mb-sm-5 pr-lg-3 container-fluid" id="two-column-list">
                                        <div class="announcement-slider border-r-xs-0 border-r position-relative">
                                            <?php foreach($purok as $row): ?>
                                                <ul class="nolist list-unstyled position-relative mb-0 px-lg-5 pt-lg-5">
                                                    <i class="text md-5 mt-3" style="font-size: 14px; color: green;"><?= $row['time_display']; ?></i>
                                                    <li class="border-bottom pb-3 mt-3">                                                       
                                                        <span class="meta text-uppercase md-3" style="font-size: 16px; font-weight: bold;"><?= date('F d, Y', strtotime($row['date_posted'])); ?></span>
                                                        <h3 class="text-uppercase font-weight-bold mt-3">
                                                            <a href="https://www.facebook.com/profile.php?id=100064303345469" style="font-size: 22px; color: red"><?= $row['subject'] ?></a>
                                                        </h3>
                                                        <p class="mt-2 post_intro" style="font-size: 18px;"><?= $row['message'] ?></p>
                                                        <i class=" text-left mt-5 post_intro" style="font-size: 15px;">- Barangay Los Amigos Officials</i>
                                                    </li>                                                
                                                </ul>
                                            <?php endforeach; ?>                                                     
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php include 'templates/main-footer.php' ?>
	        </div>
	    </div>
	<?php include 'templates/footer.php' ?>
</body>
</html>