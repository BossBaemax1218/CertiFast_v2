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
									<div style="display: flex; flex-wrap: wrap; gap: 3px; justify-content: right;">
										<div class="dropdown-customize">
											<button class="d-inline-block btn dropdown-toggle mr-3" type="button" id="filterButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 9px 12px; background-color: #FFF; border-radius: 2px; border-bottom: 3px solid #ccc;">
												<i class="bx bx-edit"> </i> Customize Charts
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
													<div class="dropdown" style="margin-left: 80%; text-align: right;">
														<button class="btn dropdown-toggle" type="button" id="filterButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 4px 20px; border: 1px solid #ddd; background-color: #eee; border-radius: 2px; border-bottom: 3px solid #ccc;">
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
													<div class="ml-3" style="text-align: right;">
														<button class="btn" type="button" id="pdf" style="padding: 4px 20px; background-color: #eee; border-radius: 2px; border: 1px solid #ddd; border-bottom: 3px solid #111;">
															<i class="fas fa-download"></i>
														</button>
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
							<!--<div class="row">
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h4><strong>Most Requested Certificates</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 1%; margin-left: 1%;">
													<div class="dropdown">
														<a class="text link" href="#" role="button" id="compareFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Filter <i class='bx bx-filter' ></i>
														</a>
														<div class="dropdown-menu" aria-labelledby="compareFilterDropdown">
															<a class="dropdown-item" href="#" onclick="applyFilter('day'); return false;">Day</a>
															<a class="dropdown-item" href="#" onclick="applyFilter('week'); return false;">Week</a>
															<a class="dropdown-item" href="#" onclick="applyFilter('month'); return false;">Month</a>
															<a class="dropdown-item" href="#" onclick="applyFilter('year'); return false;">Year</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart" style="width:100%; max-width:100%; height: 300px;"></canvas>
											<script>
											var xValues = [];
											var yValues = [];
											var barColors = ["#176B87", "#001C30", "#64CCC5", "#05BFDB"];
											var percentages = [];

											<?php
											// Execute the SQL query and fetch the details column
											$query = "SELECT details, COUNT(*) AS count FROM tblpayments WHERE details IN ('Barangay Clearance Payment', 'Business Permit Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment') GROUP BY details";
											$result = $conn->query($query);

											if ($result) {
												// Initialize an empty counts array
												$counts = [
												"Residency" => 0,
												"Indigency" => 0,
												"Clearance" => 0,
												"Business Permit" => 0,
												"" => 0
												];

												$total = 0; // Variable to store the total count

												while ($row = $result->fetch_assoc()) {
												// Retrieve the certificate and count from the query result
												$certificate = $row["details"];
												$count = $row["count"];

												// Update the count in the counts array based on the certificate
												switch ($certificate) {
													case "Certificate of Residency Payment":
													case "certificate of residency payment":
													$counts["Residency"] = $count;
													break;
													case "Certificate of Indigency Payment":
													case "certificate of indigency payment":
													$counts["Indigency"] = $count;
													break;
													case "Barangay Clearance Payment":
													case "barangay clearance payment":
													$counts["Clearance"] = $count;
													break;
													case "Business Permit Payment":
													case "business permit payment":
													$counts["Business Permit"] = $count;
													break;
												}

												$total += $count; // Update the total count
												}

												// Generate the JavaScript arrays for xValues, yValues, and percentages
												foreach ($counts as $certificate => $count) {
												$percentage = ($count / $total) * 100; // Calculate the percentage
												echo "xValues.push('" . $certificate . "');";
												echo "yValues.push(" . $percentage . ");";
												echo "percentages.push('" . round($percentage, 2) . "%');"; // Store the rounded percentage for display
												}
											} else {
												echo "console.log('Error: " . $conn->error . "');";
											}

											// Close the database connection
											$conn->close();
											?>

											var chart = new Chart("myChart", {
												type: "bar",
												data: {
												labels: xValues,
												datasets: [{
													backgroundColor: barColors,
													data: yValues
												}]
												},
												options: {
												responsive: true,
												maintainAspectRatio: false,
												legend: {
													display: false
												},
												scales: {
													y: {
													beginAtZero: true,
													max: 100, // Set the maximum value to 100 for percentage
													ticks: {
														callback: function (value) {
														return value + "%"; // Add the percentage symbol to the y-axis labels
														}
													}
													}
												},
												plugins: {
													datalabels: {
													anchor: "end",
													align: "end",
													font: {
														weight: "bold"
													},
													formatter: function (value, context) {
														return percentages[context.dataIndex]; // Display the percentage value fromthe percentages array
													}
													}
												}
												}
											});
											function applyFilter(filterOption) {
														// Add code to handle filter selection
														var filteredData = [40, 65, 35, 55, 100]; // Placeholder data for demonstration

														// Update chart data with filtered values
														chart.data.datasets[0].data = filteredData;
														chart.update();
													}

													function applyDateRangeFilter() {
														var startDate = document.getElementById("startDate").value;
														var endDate = document.getElementById("endDate").value;

														// Add code to handle date range filter
														console.log("Start Date:", startDate);
														console.log("End Date:", endDate);
													}
											</script>
										</div>
									</div>
								</div>
							</div>-->
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