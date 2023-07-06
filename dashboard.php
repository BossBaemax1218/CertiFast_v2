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
							<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
								<div>
									<h3 class="text-center fw-bold" style="font-size: 400%;">Overview</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="page-inner mt-1">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
						<div class="col">
							<div class="row">
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h4><strong>Status Reports</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 2%; margin-left: 1%;">
													<div class="dropdown">
														<a class="text link" href="#" role="button" id="statusFilterDropdown" data-toggle="dropdown" aria-expanded="false">
															<span>Filter <i class='bx bx-filter' ></i></span>
														</a>
														<ul class="dropdown-menu" aria-labelledby="statusFilterDropdown">
															<li><a class="dropdown-item" href="#" onclick="applyStatusFilter('all')">All</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyStatusFilter('requested')">Requested</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyStatusFilter('pending')">Pending</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyStatusFilter('completed')">Completed</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart2" style="width:50%; max-width:100%; height: 300px; margin-left: 3%;">
												<script>
													var ctx = document.getElementById("myChart2");
													var myChart2 = new Chart(ctx, {
													type: 'doughnut',
													data: {
														labels: ["Requested", "Pending","Complete"],
														datasets: [{
														data: [14,20,50,100],
														backgroundColor: [
															'#D32D41',
															'blue',
															'green',
															'lightgrey'
														],
														borderColor: [
															'white'
														],
														borderWidth: 0
														}]
													},
													options: {
														rotation: 1 * Math.PI,
														circumference: 1 * Math.PI,
														legend: {
														position: 'right',
														align: 'start',
														labels: {
															generateLabels: function (chart) {
															var data = chart.data;
															if (data.labels.length && data.datasets.length) {
																return data.labels.map(function (label, i) {
																var meta = chart.getDatasetMeta(0);
																var ds = data.datasets[0];
																var arc = meta.data[i];
																var custom = arc && arc.custom || {};
																var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
																var arcOpts = chart.options.elements.arc;
																var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
																var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
																var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

																return {
																	text: label + ' (' + ds.data[i] + ')',
																	fillStyle: fill,
																	strokeStyle: stroke,
																	lineWidth: bw,
																	hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
																	index: i
																};
																});
															}
															return [];
															}
														}
														},
														responsive: true,
														maintainAspectRatio: false
													}
													});

													function applyStatusFilter(filterOption) {
													var dataValue;
													var labelValue;

													if (filterOption === "all") {
														dataValue = [50, 100];
														labelValue = "Requested";
													} else if (filterOption === "requested") {
														dataValue = [30, 70];
														labelValue = "Pending";
													} else if (filterOption === "pending") {
														dataValue = [20, 80];
														labelValue = "Complete";
													} else if (filterOption === "completed") {
														dataValue = [10, 90];
														labelValue = "Certificates Completed";
													}

													myChart2.data.labels[0] = labelValue;
													myChart2.data.datasets[0].data = dataValue;
													myChart2.update();

													// Add code to set active state for selected filter option
													var filterDropdown = document.getElementById("statusFilterDropdown");
													var filterOptions = filterDropdown.nextElementSibling.getElementsByClassName("dropdown-item");

													// Remove active class from all options
													for (var i = 0; i < filterOptions.length; i++) {
														filterOptions[i].classList.remove("active");
													}

													// Add active class to the selected option
													var selectedOption = filterDropdown.nextElementSibling.querySelector("[onclick=\"applyStatusFilter('" + filterOption + "')\"]");
													selectedOption.classList.add("active");
													}
												</script>
											</canvas>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h4><strong>Weekly Reports</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 2%; margin-left: 1%;">
													<div class="dropdown">
														<a class="text link" href="#" role="button" id="completionFilterDropdown" data-toggle="dropdown" aria-expanded="false">
															<span>Filter <i class='bx bx-filter' ></i></span>
														</a>
													<ul class="dropdown-menu" aria-labelledby="completionFilterDropdown">
														<li><a class="dropdown-item" href="#" onclick="applyCompletionFilter('complete')">Complete</a></li>
														<li><a class="dropdown-item" href="#" onclick="applyCompletionFilter('incomplete')">Incomplete</a></li>
														<li><a class="dropdown-item" href="#" onclick="applyCompletionFilter('all')">All</a></li>
													</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart4" style="width:50%; max-width:100%; height: 300px; margin-left: 3%;"></canvas>
											<script>
												var xValues = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
												var yValues = [14, 54, 12, 34, 32, 12, 100];
												var barColors = ["#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41"];

												var options = {
												plugins: {
													datalabels: {
													color: '#000',
													font: {
														weight: 'bold'
													},
													anchor: 'end',
													align: 'end',
													formatter: function (value, context) {
														return value + '%';
													}
													}
												},
												responsive: true,
												maintainAspectRatio: false,
												legend: {
													position: 'right',
													align: 'center', // Add this line to align the legend labels to the start
													labels: {
													generateLabels: function (chart) {
														var data = chart.data;
														if (data.labels.length && data.datasets.length) {
														return data.labels.map(function (label, i) {
															var meta = chart.getDatasetMeta(0);
															var ds = data.datasets[0];
															var arc = meta.data[i];
															var custom = arc && arc.custom || {};
															var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
															var arcOpts = chart.options.elements.arc;
															var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
															var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
															var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

															// Return modified label object
															return {
															text: label + ' (' + ds.data[i] + '%)',
															fillStyle: fill,
															strokeStyle: stroke,
															lineWidth: bw,
															hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
															index: i
															};
														});
														}
														return [];
													}
													}
												},
												layout: {
													padding: {
													left: 0,
													right: 50,
													top: 0,
													bottom: 0
													}
												}
												};

												var chart4 = new Chart("myChart4", {
												type: "doughnut",
												data: {
													labels: xValues,
													datasets: [{
													backgroundColor: barColors,
													data: yValues
													}]
												},
												options: options
												});

												// Add labels with percentages on the right side of the chart
												Chart.plugins.register({
												afterDraw: function (chart) {
													var ctx = chart.ctx;
													ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
													ctx.textAlign = 'center';
													ctx.textBaseline = 'middle';
													var chartArea = chart.chartArea;
													var labels = chart.data.labels;
													var datasets = chart.data.datasets;
													var totalValue = datasets[0].data.reduce((a, b) => a + b, 0);

													datasets.forEach(function (dataset) {
													for (var i = 0; i < dataset.data.length; i++) {
														var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
														var midRadius = model.innerRadius + (model.outerRadius - model.innerRadius) / 2;
														var startAngle = model.startAngle;
														var endAngle = model.endAngle;
														var angle = startAngle + (endAngle - startAngle) / 2;
														var x = model.x + midRadius * Math.cos(angle);
														var y = model.y + midRadius * Math.sin(angle);

														var percentage = Math.round((dataset.data[i] / totalValue) * 100);
														ctx.fillText(percentage + '%', x, y);
													}
													});
												}
												};

												function applyCompletionFilter(filterOption) {
												var newLabels, newValues;

												if (filterOption === "complete") {
													newLabels = ["Complete"];
													newValues = [14];
												} else if (filterOption === "incomplete") {
													newLabels = ["Incomplete"];
													newValues = [100];
												} else if (filterOption === "all") {
													newLabels = ["Complete", "Incomplete"];
													newValues = [14, 100];
												}

												chart4.data.labels = newLabels;
												chart4.data.datasets[0].data = newValues;
												chart4.update();
												});
											</script>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h4><strong>Monthly Reports</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 2%; margin-left: 1%;">
													<div class="dropdown">
														<a class="text link" href="#" role="button" id="todoFilterDropdown" data-toggle="dropdown" aria-expanded="false">
															<span>Filter <i class='bx bx-filter'></i></span>
														</a>
														<ul class="dropdown-menu" aria-labelledby="todoFilterDropdown">
															<li><a class="dropdown-item" href="#" onclick="applyTodoFilter('total')">Recent</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyTodoFilter('complete')">Last Week</a></li>
															<li><a class="dropdown-item" href="#" onclick="applyTodoFilter('all')">Last Month</a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="card-body">
											<canvas id="myChart1" style="width:100%; max-width:100%; height: 300px; margin-left: 3%;">
												<script>
													var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
													var yValues = [4, 5, 7, 7, 8, 4, 7, 7, 5, 24, 6, 16];
													var barColors = ["#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "#D32D41", "Lightgrey"];

													// Calculate the total of yValues
													var total = yValues.reduce((a, b) => a + b, 0);

													// Calculate the percentage for each value
													var percentages = yValues.map(value => (value / total) * 100);

													var options = {
													plugins: {
														datalabels: {
														display: false
														}
													},
													responsive: true,
													maintainAspectRatio: false,
													legend: {
														display: true,
														position: 'right',
														align: 'center',
														labels: {
														generateLabels: function(chart) {
															var data = chart.data;
															if (data.labels.length && data.datasets.length) {
															return data.labels.map(function(label, i) {
																var meta = chart.getDatasetMeta(0);
																var ds = data.datasets[0];
																var arc = meta.data[i];
																var custom = arc && arc.custom || {};
																var getValueAtIndexOrDefault = Chart.helpers.getValueAtIndexOrDefault;
																var arcOpts = chart.options.elements.arc;
																var fill = custom.backgroundColor ? custom.backgroundColor : getValueAtIndexOrDefault(ds.backgroundColor, i, arcOpts.backgroundColor);
																var stroke = custom.borderColor ? custom.borderColor : getValueAtIndexOrDefault(ds.borderColor, i, arcOpts.borderColor);
																var bw = custom.borderWidth ? custom.borderWidth : getValueAtIndexOrDefault(ds.borderWidth, i, arcOpts.borderWidth);

																// Value and percentage
																var value = chart.config.data.datasets[0].data[i];
																var percentage = (value / total * 100).toFixed(1);

																return {
																text: label + ' (' + percentage + '%)',
																fillStyle: fill,
																strokeStyle: stroke,
																lineWidth: bw,
																hidden: isNaN(ds.data[i]) || meta.data[i].hidden,
																index: i
																};
															});
															}
															return [];
														}
														}
													}
													};

													var chart1 = new Chart("myChart1", {
													type: "pie",
													data: {
														labels: xValues,
														datasets: [{
														backgroundColor: barColors,
														data: percentages
														}]
													},
													options: options
													});
												</script>
											</canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h4><strong>Yearly Reports</strong></h4>
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
											<canvas id="myChart3" style="width:100%; max-width:100%; height: 300px;"></canvas>
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
													// Add code to handle the selected filter option
													// You can use the filterOption value to determine the date range logic
													// and update the chart accordingly

													// Reset chart data to initial values when filter is applied
													myBar.data.datasets.forEach(function (dataset) {
														dataset.hidden = false;
													});

													myBar.update();

													// Add code to set active state for selected filter option
													var filterDropdown = document.getElementById("filterDropdown");
													var filterOptions = filterDropdown.nextElementSibling.getElementsByClassName("dropdown-item");

													// Remove active class from all options
													for (var i = 0; i < filterOptions.length; i++) {
														filterOptions[i].classList.remove("active");
													}

													// Add active class to the selected option
													var selectedOption = filterDropdown.nextElementSibling.querySelector("[onclick=\"applyFilter('" + filterOption + "')\"]");
													selectedOption.classList.add("active");
												}
											</script>
										</div>
									</div>
								</div>
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
</body>
</html>