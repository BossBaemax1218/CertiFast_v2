<?php include 'server/server.php';
if (!isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit;
}
?>
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
								<div class="container mt-3">
									<h3 class="fw-bold mb-4" style="font-size: 400%;">Overview</h3>
									<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
										<div class="row mb-3 ml-2">
											<div class="col-sm-12 col-md-2 mb-2">
												<label for="fromDate">From:</label>
												<input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo isset($_POST['fromDate']) ? htmlspecialchars($_POST['fromDate']) : date('Y-m-d'); ?>">
											</div>
											<div class="col-sm-12 col-md-2 mb-2">
												<label for="toDate">To:</label>
												<input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo isset($_POST['toDate']) ? htmlspecialchars($_POST['toDate']) : date('Y-m-d'); ?>">
											</div>
											<div class="col-sm-12 col-md-2 mb-2">
												<label for="dateType">Date Type:</label>
												<select class="form-control" id="dateType" name="dateType">
													<option value="weekly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'weekly') echo 'selected'; ?>>By Week</option>
													<option value="monthly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'monthly') echo 'selected'; ?>>By Month</option>
													<option value="yearly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'yearly') echo 'selected'; ?>>By Year</option>
													<option value="mostcert" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'mostcert') echo 'selected'; ?>>Most Requested</option>
												</select>
											</div>
											<div class="col-sm-12 col-md-3 mb-2">
												<label for="documentType">Document Type:</label>
												<select class="form-control" id="documentType" name="documentType">
													<option value="All" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'All') echo 'selected'; ?>>All</option>
													<option value="Barangay Clearance Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Barangay Clearance Payment') echo 'selected'; ?>>Barangay Clearance</option>
													<option value="Certificate of Residency Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Residency Payment') echo 'selected'; ?>>Certificate of Residency</option>
													<option value="Certificate of Indigency Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Indigency Payment') echo 'selected'; ?>>Certificate of Indigency</option>
													<option value="Business Permit Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Business Permit Payment') echo 'selected'; ?>>Business Permit</option>
												</select>
											</div>
											<div class="col-sm-12 col-md-3 mt-3">
												<button type="submit" class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
												<button type="button" class="btn btn-danger ml-3" id="pdfExportBtn">Export</button>
											</div>
										</div>
									</form>
									<div class="row md-5">
										<div class="col-md-12">
											<div class="chart-wrapper" id="chartRow">
												<?php include 'model/chart.php' ?>
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
	<script>
    document.getElementById("pdfExportBtn").addEventListener("click", function () {
      var doc = new jsPDF();
      var chartRow = document.getElementById("chartRow");
      var fromDate = document.getElementById("fromDate").value;
      var toDate = document.getElementById("toDate").value;
      var documentType = document.getElementById("documentType").value;

      var title = "Overview Chart Visualization Reports";
      doc.setFontSize(18);
      doc.text(title, 10, 10);

      var currentDate = new Date().toLocaleDateString();
      doc.setFontSize(12);
      doc.text("Current Date: " + currentDate, 10, 20);
      doc.text("Date Range: " + fromDate + " - " + toDate, 10, 30);
      doc.text("Document Type: " + documentType, 10, 40);

      var width = 180;
      var height = 200;

      html2canvas(chartRow, { scale: 2 }).then(function (canvas) {
        var imgData = canvas.toDataURL("image/png");
        doc.addImage(imgData, "PNG", 10, 50, width, height);

        doc.save("dashboard-chart.pdf");
      });
    });
</script>
</body>
</html>