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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
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
								<div class="d-flex align-items-right align-items-md-right flex-column flex-md-column">
									<?php if(isset($_SESSION['message'])): ?>
											<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
												<?php echo $_SESSION['message']; ?>
											</div>
										<?php unset($_SESSION['message']); ?>
									<?php endif ?>
									<div class="d-flex align-items-center align-items-md-center flex-row flex-md-row">
										<h3 class="fw-bold" style="font-size: 300%;">Overview</h3>
									</div>								
									<div style="display: inline-flex; flex-wrap: wrap; gap: 3px; justify-content: right;">
										<div class="dropdown-customize">
											<button class="d-inline-block btn dropdown-toggle mr-3" type="button" id="filterButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 10px 12px; background-color: #FFF; border-radius: 2px; border-bottom: 3px solid #ccc;">
												<i class="bx bx-edit"> </i> Customization
											</button>
											<div class="dropdown-menu" aria-labelledby="filterButton">
													<a class="dropdown-item">
														<label class="fw-bold">
															Data
														</label>
													</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="customizeChart('pie')">
														Individual
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="customizeChart('pie')">
														Group
													</label>
												</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item">
													<label class="fw-bold">
														Charts
													</label>
												</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="customizeChart('pie')">
														Pie
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="customizeChart('bar')">
														Bar
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="customizeChart('line')">
														Line
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" onchange="customizeChart('doughnut')">
														Doughnut
													</label>
												</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item">
													<label class="fw-bold">
														Reports
													</label>
												</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" id="userReportsCheckbox" onchange="applyFilter('userreports')">
														User's Reports
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" id="resReportsCheckbox" onchange="applyFilter('resreports')">
														Residents Reports
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" id="certReportsCheckbox" onchange="applyFilter('certreports')">
														Certificates Reports
													</label>
												</a>
												<a class="dropdown-item" href="#">
													<label class="checkbox-label">
														<input type="checkbox" class="checkbox-input" id="transReportsCheckbox" onchange="applyFilter('transreports')">
														Transaction Reports
													</label>
												</a>
											</div>
										</div>
										<div class="dropdown mr-2">
											<button class="d-inline-block dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline-block; padding: 9px; border: 1px solid #ddd; background-color: #fff; border-radius: 4px; border: none; border-bottom: 3px solid #ccc;">
												<i class="far fa-calendar-alt" style="padding: 5px;"></i>
												<input id="startDate" name="startDate" class="date-input" style="width: 75px; background-color: #fff; border: none;" disabled> 
												<label>-</label>
												<input id="endDate" name="endDate" class="date-input" style="width: 75px; background-color: #fff; border: none;" disabled>
											</button>
											<div class="dropdown-menu" aria-labelledby="filterDropdown">
												<a class="dropdown-item" href="#" onclick="applyFilter('day')">Day</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('yesterday')">Yesterday</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('last7days')">Last 7 Days</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('last30days')">Last 30 Days</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('thismonth')">This Month</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('lastmonth')">Last Month</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('thisyear')">This Year</a>
												<a class="dropdown-item" href="#" onclick="applyFilter('lastyear')">Last Year</a>
												<a class="dropdown-item" href="#" id="applyRangeButton" onclick="applyDateRangeFilter()">Custom Range</a>
											</div>
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
										<div class="card-header">
											<div class="card-head">
												<div class="d-flex flex-row flex-md-row filter">
													<h2>All Reports</h2>
													<div class="dropdown" style="margin-left: 85%; text-align: right;">
														<button class="btn dropdown-toggle" type="button" id="filterButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 4px 20px; border: 1px solid #ddd; background-color: #FFF; border-radius: 2px; border-bottom: 3px solid #ccc;">
															<i class="fas fa-filter"></i> Filter
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
																	<input type="checkbox" class="checkbox-input" onchange="applyFilter('week')">
																	Weekly
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
												</div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart3" style="width:100%; max-width:100%; height: 500px;"></canvas>
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
															label: "Barangay Indengency",
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

												function applyFilter(filterOption) {
														// Add code to handle filter selection
														var filteredData = [40, 65, 35, 55, 100]; // Placeholder data for demonstration

														// Update chart data with filtered values
														chart.data.datasets[0].data = filteredData;
														chart.update();
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
	<script src="assets/js/custom-date-range.js"></script>
	<script>
		  $(document).on("click", "#pdf", function() {
		console.log("Exporting revenue table as PDF...");
		$("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
	});
	</script>
</body>
</html>