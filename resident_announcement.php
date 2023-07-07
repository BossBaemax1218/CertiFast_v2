<?php include 'server/db_connection.php' ?>
<?php 
    $query = "SELECT COUNT(DISTINCT details) as de FROM tblpayments WHERE details IN ('Barangay Clearance Payment', 'Business Permit Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment')"; 
    $revenue1 = $conn->query($query)->fetch_assoc();

    $sql = "SELECT * FROM tblpayments ORDER BY `date` DESC";
    $result = $conn->query($sql);

    $revenue = array();
	while($row = $result->fetch_assoc()){
		$revenue[] = $row; 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>     
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <script src="https://cdn.jsdelivr.net/npm/table-html-export"></script>              
	<title>Announcement</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
    <?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel">
			<div class="content">
                    <div>
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Announcement</h1>
                    </div>
					<div class="page-inner mt-2">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					</div>
                    <div class="page-inner">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    <div class="card-body">
                                        <div class="table-responsive mt-3">
                                            <table id="revenuetable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Recipient</th>
                                                        <th scope="col">Details</th>
                                                        <th scope="col">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($revenue)): ?>
                                                        <?php $no=1; foreach($revenue as $row): ?>
                                                        <tr>
                                                            <td><?= $row['date'] ?></td>
                                                            <td><?= $row['name'] ?></td>
                                                            <td><?= $row['details'] ?></td>
                                                            <td> <i class="fa-solid fa-peso-sign"></i> <?= number_format($row['amounts'],2) ?></td>
                                                        </tr>
                                                        <?php $no++; endforeach ?>
                                                    <?php endif ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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