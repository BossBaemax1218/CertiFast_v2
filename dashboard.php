<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT * FROM tblresident WHERE resident_type=1";
    $result = $conn->query($query);
	$total = $result->num_rows;

	$query1 = "SELECT * FROM tbl_user_admin WHERE user_type='staff'";
    $result1 = $conn->query($query1);
	$staff = $result1->num_rows;

	$query2 = "SELECT * FROM tblresident WHERE gender='Female' AND resident_type=1";
    $result2 = $conn->query($query2);
	$female = $result2->num_rows;

	$query5 = "SELECT * FROM tblpurok";
	$purok = $conn->query($query5)->num_rows;

	$query8 = "SELECT SUM(amounts) as am FROM tblpayments";
	$revenue = $conn->query($query8)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h1 class="text-center fw-bold" style="font-size: 400%;">Overview</h1>
							</div>
						</div>
					</div>
				</div>
					<div class="page-inner mt-2">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
						<!--<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-head-row">
											<div class="card-title fw-bold"><h1><strong>Barangay Los Amigos</strong></h1></div>
										</div>
									</div>
									<div class="card-body">
										<p><?= !empty($db_txt) ? $db_txt : 'Los Amigos is a barangay in Davao City.' ?></p>
										<div class="text-center">
											<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/bg-abstract.png' ?>" />
										</div>
									</div>
								</div>
							</div>
						</div>-->
						<div class="col">
							<div class="row">
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold"><h3><strong>Current Certificate Request</strong></h3></div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart2" style="width:200%; max-width:400%" >
												<script src="homepage/js/half-donut-chart.js"></script>
											</canvas>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold"><h3><strong>Weekly Requested Certificates</strong></h3></div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart1" style="width:100%; max-width:400%">
												<script src="homepage/js/pie-chart.js"></script>
											</canvas>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold"><h3><strong>Monhtly Requested Certificates</strong></h3></div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart4" style="width:100%; max-width:400%">
												<script src="homepage/js/doughnot-chart.js"></script>
											</canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold"><h3><strong>Yearly Reports Certification Requested</strong></h3></div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart3" style="width:100%;max-width:600%">
												<script src="homepage/js/group-bar-chart.js"></script>
											</canvas>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold"><h3><strong>Most Requested Certificates</strong></h3></div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart" style="width:100%;max-width:600%">
												<script src="homepage/js/bar-chart.js"></script>
											</canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
					</div>
				</div>
				<!-- Main Footer -->
				<?php include 'templates/main-footer.php' ?>
				<!-- End Main Footer -->
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>