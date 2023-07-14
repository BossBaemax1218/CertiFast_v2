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
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
												<input class="text-center" type="text" id="datetimerange-input" size="20" readonly>
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
												<canvas id="myChart3" style="width: 100%; max-width: 800px; height: 500px;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
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
	<?php
	// Prepare and execute the SQL query to fetch data from tblpayments
	$paymentDataQuery = "SELECT * FROM tblpayments";
	$stmt = $conn->prepare($paymentDataQuery);
	$stmt->execute();
	$paymentDataResult = $stmt->get_result();

	var_dump($labels);
	var_dump($dataset1);
	var_dump($dataset2);
	var_dump($dataset3);
	var_dump($dataset4);
	

	if ($paymentDataResult->num_rows > 0) {
		while ($row = $paymentDataResult->fetch_assoc()) {
			$labels[] = $row['year'];
			$dataset1[] = $row['value1'];
			$dataset2[] = $row['value2'];
			$dataset3[] = $row['value3'];
			$dataset4[] = $row['value4'];
		}
	} else {
		echo "No data found.";
	}
	?>
	var chartData = {
		labels: <?php echo json_encode($labels); ?>,
		datasets: [
			{
				label: 'Barangay Clearance',
				data: <?php echo json_encode($dataset1); ?>,
				backgroundColor: '#176B87',
				hidden: false
			},
			{
				label: 'Barangay Residency',
				data: <?php echo json_encode($dataset2); ?>,
				backgroundColor: '#001C30',
				hidden: false
			},
			{
				label: 'Barangay Indigency',
				data: <?php echo json_encode($dataset3); ?>,
				backgroundColor: '#64CCC5',
				hidden: false
			},
			{
				label: 'Business Permit',
				data: <?php echo json_encode($dataset4); ?>,
				backgroundColor: '#05BFDB',
				hidden: false
			}
		]
	};
	var chartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		plugins: {
			legend: {
				position: "top"
			}
		},
		scales: {
			x: {
				stacked: true
			},
			y: {
				beginAtZero: true
			}
		}
	};

	document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("myChart3").getContext("2d");
    try {
        new Chart(ctx, {
            type: "bar",
            data: chartData,
            options: chartOptions
        });
    } catch (error) {
        console.error(error);
    }
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