<?php include 'server/server.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Overview - Dashboard</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
			<div class="wrapper">
				<?php include 'templates/main-header.php' ?>
				<?php include 'templates/sidebar.php' ?>
					<div class="main-panel">
						<div class="content d-flex flex-column">
							<div class="panel-header d-flex flex-column mt-1">
								<?php if (isset($_SESSION['message'])): ?>
									<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
										<?php echo $_SESSION['message']; ?>
									</div>
									<?php unset($_SESSION['message']); ?>
								<?php endif ?>
								<div class="d-flex flex-column mt-3">
									<h3 class="fw-bold ml-4" style="font-size: 400%;">Overview</h3>
									<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
										<div class="row" id="filterRow">
											<div class="col-md-2 ml-4">
												<label for="fromDate">From:</label>
												<input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo ($fromDate) ?>">
											</div>
											<div class="col-md-2">
												<label for="toDate">To:</label>
												<input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo ($toDate) ?>">
											</div>
											<div class="col-md-3">
												<label for="documentType">Document Type:</label>
												<select class="form-control" id="documentType" name="documentType">
													<option value="All">All</option>
													<option value="Barangay Clearance Payment">Barangay Clearance</option>
													<option value="Certificate of Residency Payment">Certificate of Residency</option>
													<option value="Certificate of Indigency Payment">Certificate of Indigency</option>
													<option value="Business Permit Payment">Business Permit</option>
												</select>
											</div>
											<div class="col-md-3 mt-3">
												<button type="submit" class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
												<button type="button" class="btn btn-danger" id="pdfExportBtn">Export</button>
											</div>
										</div>
									</form>
								<div class="row ml-2 mt-3" id="chartRow">
										<div class="col-md-12">
										<div class="chart-wrapper">
											<?php include 'model/yearlybar_chart.php' ?>
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
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</body>
</html>