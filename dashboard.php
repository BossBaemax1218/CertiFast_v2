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
	<title>Overview - Dashboard</title>
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
									<div style="display:flex; flex-wrap: wrap; justify-content: left;">
										<div class="dropdown-customize ml-3">
											<button class="d-inline-block btn dropdown-toggle mr-3" type="button" id="filterButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 12px 12px; background-color: #FFF; border-radius: 2px; border-bottom: 3px solid #ccc;">
												<i class="fas fa-filter"> </i> Filter
											</button>				
											<div class="dropdown-menu" aria-labelledby="filterButton">
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="applyFilter('day')">
														Daily
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="applyFilter('month')">
														Monthly
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="applyFilter('year')">
														Yearly
													</label>
												</a>
											</div>
										</div>
										<div class="dropdown mr-2 ">
											<button class="date-input-container" type="button" style="display: inline-block; padding: 9px; border: 1px solid #ddd; background-color: #fff; border-radius: 4px; border: none; border-bottom: 3px solid #ccc;">
												<input class="text-center" type="text" id="datetimerange-input" size="20">
											</button>
										</div>
										<div class="mr-3" style="text-align: right;">
											<button class="btn btn-danger" type="button" id="pdf" style="padding: 10px 20px; background-color: #fff; border-radius: 2px; border-bottom: 3px solid #111;">
												<i class="fas fa-download"> </i>  Download PDF
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					<div class="page-inner mt-1">
						<div class="col">
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
											<canvas id="myChart3" style="width: 100%; max-width: 100%; height: 500px;"></canvas>
											<script>
												var barChartData = {
													labels: ["2018", "2019", "2020", "2021", "2022"],
													datasets: [
														{
															data: [53, 85, 76, 57, 78],
															label: "Barangay Clearance",
															backgroundColor: "#176B87",
															hidden: false,
														},
														{
															data: [80, 47, 84, 86, 59],
															label: "Barangay Residency",
															backgroundColor: "#001C30",
															hidden: false,
														},
														{
															data: [80, 77, 63, 89, 80],
															label: "Barangay Indigency",
															backgroundColor: "#64CCC5",
															hidden: false,
														},
														{
															data: [78, 87, 74, 86, 69],
															label: "Business Permit",
															backgroundColor: "#05BFDB",
															hidden: false,
														},
													],
												};

												var chartOptions = {
													responsive: true,
													maintainAspectRatio: false,
													legend: {
														position: "top",
													},
													scales: {
														yAxes: [
															{
																ticks: {
																	beginAtZero: true,
																},
															},
														],
													},
												};

												var ctx = document.getElementById("myChart3").getContext("2d");
												var myBar = new Chart(ctx, {
													type: "bar",
													data: barChartData,
													options: chartOptions,
												});

												function changeChart(label) {
													// Find the corresponding dataset based on the label
													var datasetIndex = barChartData.datasets.findIndex(function (dataset) {
														return dataset.label === label;
													});

													if (datasetIndex >= 0) {
														// Hide all datasets
														barChartData.datasets.forEach(function (dataset) {
															dataset.hidden = true;
														});

														// Show the selected dataset
														barChartData.datasets[datasetIndex].hidden = false;

														// Update the chart
														myBar.update();

														// Update active button
														var buttons = document.getElementsByClassName("btn");
														for (var i = 0; i < buttons.length; i++) {
															buttons[i].classList.remove("active");
															if (buttons[i].innerText.trim() === label) {
																buttons[i].classList.add("active");
															}
														}
													}
												}
											</script>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
					</div>
				</div>
				<?php include 'templates/main-footer.php' ?>
			</div>
		</div>
	<?php include 'templates/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.js"></script>
	<script>
		  $(document).on("click", "#pdf", function() {
		console.log("Exporting revenue table as PDF...");
		$("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
	});
	</script>
	<script>
	window.addEventListener("load", function (event) {
		let drp = new DateRangePicker('datetimerange-input',
			{
				ranges: {
					'Today': [moment().startOf('day'), moment().endOf('day')],
					'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
					'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
					'This Month': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf('day')],
				},
				locale: {
					format: "YYYY-MM-DD",
				}
			},
			function (start, end) {
				alert(start.format() + " - " + end.format());
			})
		window.addEventListener('apply.daterangepicker', function (ev) {
			console.log(ev.detail.startDate.format('YYYY-MM-DD'));
			console.log(ev.detail.endDate.format('YYYY-MM-DD'));
		});
	});
</script>
</body>
</html>