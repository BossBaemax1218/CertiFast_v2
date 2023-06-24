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
												<div class="card-title fw-bold">
													<h4><strong>Certificate Status Reports</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 1%; margin-left: 1%;">
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
												<canvas id="myChart2" style="width:50%; max-width:55%; margin-left: 25%;"></canvas>
											<script>
												var ctx = document.getElementById("myChart2");
												var myChart2 = new Chart(ctx, {
												type: 'doughnut',
												data: {
													labels: ["Certificates Requested"],
													datasets: [{
													data: [50, 100],
													backgroundColor: [
														'#D32D41',
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
												}
												});

												function applyStatusFilter(filterOption) {
												var dataValue;
												var labelValue;

												if (filterOption === "all") {
													dataValue = [50, 100];
													labelValue = "Certificates Requested";
												} else if (filterOption === "requested") {
													dataValue = [30, 70];
													labelValue = "Certificates Requested";
												} else if (filterOption === "pending") {
													dataValue = [20, 80];
													labelValue = "Certificates Pending";
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
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-header">
											<div class="card-head-row">
												<div class="card-title fw-bold">
													<h4><strong>Completion Status Reports</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 1%; margin-left: 1%;">
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
											<canvas id="myChart4" style="width:50%; max-width:55%; margin-left: 25%;">
												<script>
													var xValues = ["Complete", "Incomplete"];
													var yValues = [14, 100];
													var barColors = [
													"#D32D41",
													"lightgrey"
													];

													var chart4 = new Chart("myChart4", {
													type: "doughnut",
													data: {
														labels: xValues,
														datasets: [{
														backgroundColor: barColors,
														data: yValues
														}]
													},
													options: {}
													});

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
													<h4><strong>Recent Tasks Reports</strong></h4>
												</div>
												<div class="filter" style="margin-bottom: 1%; margin-left: 1%;">
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
											<canvas id="myChart1" style="width:100%; max-width:55%; margin-left: 25%;">
												<script>
													var xValues = ["Total Task", "Completed Task"];
													var yValues = [100, 50];
													var barColors = ["Lightgrey","#D32D41"];
													var options = {
													pieceLabel: {
														render: function(d) {
														return d.label + " (" + d.percentage + "%)";
														},
														fontColor: '#000',
														position: 'inside',
														segment: true
													}
													};

													var chart1 = new Chart("myChart1", {
													type: "pie",
													data: {
														labels: xValues,
														datasets: [{
														backgroundColor: barColors,
														data: yValues
														}]
													},
													options: options
													});

													function applyTodoFilter(filterOption) {
													var newLabels, newValues;

													if (filterOption === "total") {
														newLabels = ["Total Tasks"];
														newValues = [50];
													} else if (filterOption === "complete") {
														newLabels = ["Completed Tasks"];
														newValues = [100];
													} else if (filterOption === "all") {
														newLabels = ["Total Tasks", "Completed Tasks"];
														newValues = [50, 100];
													}

													chart1.data.labels = newLabels;
													chart1.data.datasets[0].data = newValues;
													chart1.update();
													}
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
													<h4><strong>Certificates Reports</strong></h4>
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
											<canvas id="myChart3" style="width:100%; max-width:600%"></canvas>
											<script>
												var barChartData = {
													labels: ["2018", "2019", "2020", "2021", "2022"],
													datasets: [
														{
															data: [53, 85, 76, 57, 78, 100],
															label: "Barangay Clearance",
															backgroundColor: "#176B87",
															hidden: false,
														},
														{
															data: [80, 47, 84, 86, 59, 100],
															label: "Barangay Residency",
															backgroundColor: "#001C30",
															hidden: false,
														},
														{
															data: [80, 77, 63, 89, 80, 100],
															label: "Barangay Indengency",
															backgroundColor: "#64CCC5",
															hidden: false,
														},
														{
															data: [78, 87, 74, 86, 69, 100],
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
													myBar.data.datasets.forEach(function(dataset) {
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
												<h4><strong>Most Requested Certificates Reports</strong></h4>
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
										<canvas id="myChart" style="width:100%;max-width:600%"></canvas>
										<script>
											var xValues = ["Residency", "Indigency", "Clearance", "Business Permit","No Request"];
											var yValues = [40, 35, 60, 70, 100];
											var barColors = ["#176B87", "#001C30", "#64CCC5", "#05BFDB", "lightgrey"];

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