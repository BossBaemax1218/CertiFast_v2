<?php include 'server/server.php' ?>
<?php 
	$query1 = "SELECT * FROM tbl_user_admin WHERE user_type='staff'";
    $result1 = $conn->query($query1);
	$staff = $result1->num_rows;

	$query5 = "SELECT * FROM tblpurok";
	$purok = $conn->query($query5)->num_rows;

	$query8 = "SELECT SUM(amounts) as am FROM tblpayments";
	$revenue = $conn->query($query8)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Overview - Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
		<div class="wrapper">
			<?php include 'templates/main-header.php' ?>
			<?php include 'templates/sidebar.php' ?>
				<div class="main-panel">
					<div class="content">
						<div class="panel-header">
							<div class="page-inner">
								<?php if(isset($_SESSION['message'])): ?>
										<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
											<?php echo $_SESSION['message']; ?>
										</div>
									<?php unset($_SESSION['message']); ?>
								<?php endif ?>
								<div class="d-flex align-items-left align-items-md-left flex-column flex-md-column">
									<div class="d-flex align-items-center align-items-md-center flex-row flex-md-row">
										<h3 class="fw-bold" style="font-size: 300%;">Overview</h3>
									</div>									
								</div>
							</div>
						</div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>					
							<div class="col">
								<div class="chart-container" id="chartContainer">
									<div class="chart-wrapper col-md-12">
										<?php include 'model/weeklybar_chart.php' ?>
									</div>
									<div class="chart-wrapper col-md-12">
										<?php include 'model/monthlybar_chart.php' ?>
									</div>
									<div class="chart-wrapper col-md-12">
										<?php include 'model/yearlybar_chart.php' ?>
									</div>
									<div class="chart-wrapper col-md-12">
										<?php include 'model/mostcertbar_chart.php' ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php include 'templates/main-footer.php' ?>
			</div>
		</div>
	<?php include 'templates/footer.php' ?>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		  $(document).on("click", "#pdf", function() {
		console.log("Exporting revenue table as PDF...");
		$("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
	});
	</script>
</body>
</html>