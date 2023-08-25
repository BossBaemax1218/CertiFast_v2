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
    <style>
    .announcement-table {
        width: 100%;
        border-collapse: collapse;
    }

    .announcement-table th,
    .announcement-table td {
        padding: 10px;
        text-align: left;
        vertical-align: top;
    }

    .announcement-table th {
        font-size: 18px;
        font-weight: bold;
    }
    .announcement-table td.title-header {
        color: #fff;
        padding: 15px;
        background-color: #e42654;
        font-weight: bold;
        border-radius: 12px 12px 0 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .announcement-table h5.date {
        font-size: 14px;
        text-align: right;
        color: #fff;
    }

    .announcement-table h3.subject {
        color: #fff;
        font-size: 24px;
        text-align: left;
        font-weight: bold;
    }

    .announcement-table td.message {
        padding: 15px;
        background-color: #fff;
        border-radius: 1px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .announcement-table p {
        color: #000;
        font-size: 16px;
        margin-top: 10px;
    }

    .announcement-table td.officials {
        font-size: 15px;
        color: green;
        text-align: center;
        padding: 10px 15px;
        background-color: #fff;
        color: green;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 0 0 12px 12px;
    }
</style>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
        <div class="wrapper">
            <?php include 'templates/main-header-resident.php' ?>
                <?php include 'templates/sidebar-resident.php' ?>
                <div class="main-panel mt-2">
                    <div class="container">
                        <?php if(isset($_SESSION['message'])): ?>
                            <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo $_SESSION['message']; ?>
                            </div>
                        <?php unset($_SESSION['message']); ?>
                        <?php endif ?>
                        <section class="text-center two-column-list mb-sm-5 pr-lg-3 container-fluid" id="two-column-list">
                            <div class="announcement-slider border-r-xs-0 border-r position-relative">
                        	<h1 class="text-center fw-bold mt-4 mb-5" style="font-size: 300%;">Announcement</h1>
                                <table class="announcement-table">
                                    <?php foreach($purok as $row): ?>
                                        <tr>
                                            <td class="title-header" colspan="1">
                                                <h5 class="date">
                                                    <?= date('F d, Y', strtotime($row['date_posted'])); ?>
                                                </h5>
                                                <h3 class="subject">
                                                    <a href="https://www.facebook.com/profile.php?id=100064303345469"><?= $row['subject'] ?></a>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="message" colspan="2">
                                                <p><?= $row['message'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="officials" colspan="2"><i>- Barangay Los Amigos</i></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"></td>
                                        </tr>
                                    <?php endforeach; ?>                                                     
                                </table>
                            </div>
                        </section>
                    </div>
				<?php include 'templates/main-footer.php' ?>
	        </div>
	    </div>
	<?php include 'templates/footer.php' ?>
</body>
</html>