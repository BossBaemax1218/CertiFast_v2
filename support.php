<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tbl_support ORDER BY `date` DESC";
    $result = $conn->query($query);

    $ticket = array();
	while($row = $result->fetch_assoc()){
		$ticket[] = $row; 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
    <link rel="stylesheet" href="assets/css/support-style.css">
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content mt-4">
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<h1 class="text fw-bold" style = "font-size: 400%;"></h1>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-md-12">
                            <?php if(isset($_SESSION['message'])): ?>
                                    <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <?php echo $_SESSION['message']; ?>
                                    </div>
                                <?php unset($_SESSION['message']); ?>
                                <?php endif ?>
								<div class="card-body">
                                    <div class="mailbox">
                                        <div class="mailbox-header">
                                            <h1>Support</h1>
                                            <div class="card-tools mt-3">
                                                <a class="dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Filter Options
                                                </a>
                                                <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
                                                    <div class="dropdown-item">
                                                        <label>From Date:</label>
                                                        <input type="date" class="form-control" id="fromDate" placeholder="Select date range">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>To Date:</label>
                                                        <input type="date" class="form-control" id="toDate" placeholder="Select date range">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <button type="button" class="form-control btn btn-outline-primary" id="clearFilters">Clear Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="messages <?= $isNewMessage ? ' new-message' : '' ?>">
                                            <?php foreach ($ticket as $row): ?>
                                                <div class="message">
                                                    <div class="message-header">
                                                        <h3><?= $row['subject'] ?></h3>
                                                        <?php
                                                        $messageDateTime = strtotime($row['date']);
                                                        $currentTime = time();
                                                        $timeDifference = $currentTime - $messageDateTime;
                                                        
                                                        $isNewMessage = $timeDifference <= 24 * 60 * 60;
                                                        ?>
                                                        <?php if ($isNewMessage) : ?>
                                                            <span class="new-icon">New</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="message-content">
                                                        <p class="message-date text-right"><?= $row['date'] ?></p>
                                                        <p><strong>Name:</strong> <?= $row['name'] ?></p>
                                                        <p><strong>Email:</strong> <a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></p>
                                                    </div>
                                                    <div class="message-actions">
                                                        <a href="#messageModal<?= $row['id'] ?>" class="text-left view" data-toggle="modal"><i class="fas fa-eye"> View Details</i></a>
                                                        <a href="#confirmDeleteModal<?= $row['id'] ?>" class="text-right delete" data-toggle="modal"><i class="fas fa-trash"> Delete</i></a>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'templates/main-footer.php' ?>	
        </div>
    <?php include 'templates/footer.php' ?>
<?php foreach ($ticket as $row) { ?>
    <div class="modal fade" id="messageModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel"><?= $row['subject'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="message-details">
                        <p><strong>From:</strong> <?= $row['name'] ?> &lt;<a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a>&gt;</p>
                        <p><strong>Date:</strong> <?= $row['date'] ?></p>
                        <p><strong>Number:</strong> <a href="tel:<?= $row['number'] ?>"><?= $row['number'] ?></a></p>
                    </div>
                    <div class="message-content">
                        <p><?= nl2br($row['message']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
	<?php foreach ($ticket as $row) { ?>
        <div class="modal fade" id="confirmDeleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="font-size: 16px;">
                        Are you certain you want to remove this file?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/trash_support_records.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fromDate = document.getElementById("fromDate");
    const toDate = document.getElementById("toDate");
    const clearFiltersBtn = document.getElementById("clearFilters");
    
    const messages = document.querySelectorAll(".message");
    
    function messageMatchesFilter(message) {
        const messageDate = new Date(message.querySelector(".message-date").textContent);
        const from = new Date(fromDate.value);
        const to = new Date(toDate.value);
    
        return (isNaN(from) || messageDate >= from) &&
               (isNaN(to) || messageDate <= to);
    }
    
    function applyFilter() {
        messages.forEach(message => {
            const shouldDisplay = messageMatchesFilter(message);
            message.style.display = shouldDisplay ? "block" : "none";
        });
    }
    
    function clearFilters() {
        fromDate.value = "";
        toDate.value = "";
        applyFilter();
    }
    
    fromDate.addEventListener("change", applyFilter);
    toDate.addEventListener("change", applyFilter);
    clearFiltersBtn.addEventListener("click", clearFilters);
});
</script>
</body>
</html>