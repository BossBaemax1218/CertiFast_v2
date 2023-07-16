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
								<!--<div class="card-header" style="text-align: left; border: none; padding: none; background: none;">
									<div class="md-0">
										<button class="btn btn-danger" type="button" id="pdf" style="padding: 10px 20px; background-color: #fff; border-radius: 2px; border-bottom: 3px solid #111;">
											<i class="fas fa-download"></i>  Export PDF
										</button>
										<button class="btn btn-primary" type="button" placeholder="Pick date rage" id="kt_daterangepicker_3" data-toggle="modal" style="padding: 10px 20px; background-color: #fff; border-radius: 2px; border-bottom: 3px solid;">
											<i class="far fa-calendar-alt"></i>  DATE
										</button>										
									</div>
								</div>-->
							</div>
						</div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
						<div class="chart-container" id="chartContainer">
							<div class="chart">
								<div class="page-inner">
								<div class="col">
									<div class="row">
									<div class="col-md-12">
										<div class="card">
										<div class="card-header">
											<strong>WEEKLY REPORTS</strong>
										</div>
										<div class="card-body">
											<canvas id="myChart1" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
										</div>
										</div>
									</div>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="chart-container" id="chartContainer">
								<div class="chart">
									<div class="page-inner">
									<div class="col">
										<div class="row">
										<div class="col-md-12">
											<div class="card">
											<div class="card-header">
												<strong>MONTHLY REPORTS</strong>
											</div>
											<div class="card-body">
												<canvas id="monthlyChart" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
											</div>
											</div>
										</div>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="chart-container" id="chartContainer">
								<div class="chart">
									<div class="page-inner">
									<div class="col">
										<div class="row">
										<div class="col-md-12">
											<div class="card">
											<div class="card-header">
												<strong>YEARLY REPORTS</strong>
											</div>
											<div class="card-body">
												<canvas id="myChart3" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
											</div>
											</div>
										</div>
										</div>
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

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$monthlyDataQuery = "SELECT DATE_FORMAT(date, '%M') AS month_name, details, COUNT(*) AS total_payments FROM tblpayments GROUP BY MONTH(date), details";
$stmt = $conn->prepare($monthlyDataQuery);
$stmt->execute();
$monthlyDataResult = $stmt->get_result();

$monthlyChartLabels = [];
$monthlyChartDatasets = [];

if ($monthlyDataResult->num_rows > 0) {
    while ($row = $monthlyDataResult->fetch_assoc()) {
        $month = $row['month_name'];
        $detailsValue = $row['details'];
        $totalPayments = $row['total_payments'];

        if (!isset($monthlyChartDatasets[$detailsValue])) {
            $monthlyChartDatasets[$detailsValue] = [];
        }

        $monthlyChartDatasets[$detailsValue][] = $totalPayments;

        if (!in_array($month, $monthlyChartLabels)) {
            $monthlyChartLabels[] = $month;
        }
    }
}
?>
<script>
  var monthlyChartDataLabels = <?php echo json_encode($monthlyChartLabels); ?>;
  var monthlyChartDatasets = [];

  <?php foreach ($monthlyChartDatasets as $detailsValue => $data) { ?>
    monthlyChartDatasets.push({
      label: '<?php echo $detailsValue; ?>',
      data: <?php echo json_encode($data); ?>,
      backgroundColor: getRandomColor(),
      borderColor: '#ffffff',
      borderWidth: 1
    });
  <?php } ?>

  var monthlyChartData = {
    labels: monthlyChartDataLabels,
    datasets: monthlyChartDatasets
  };

  var monthlyChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: "top"
      }
    }
  };

  document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("monthlyChart").getContext("2d");
    try {
      new Chart(ctx, {
        type: "bar",
        data: monthlyChartData,
        options: monthlyChartOptions
      });
    } catch (error) {
      console.error(error);
    }
  });

  function getRandomColor() {
    var letters = "0123456789abcdef";
    var color = "#";
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
</script>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataQuery = "SELECT DATE_FORMAT(date, '%W') AS week_name, details, COUNT(*) AS total_payments FROM tblpayments GROUP BY WEEK(date), details";
$stmt = $conn->prepare($dataQuery);
$stmt->execute();
$dataResult = $stmt->get_result();

$chartLabels = [];
$chartDatasets = [];

if ($dataResult->num_rows > 0) {
    while ($row = $dataResult->fetch_assoc()) {
        $week = $row['week_name'];
        $detailsValue = $row['details'];
        $totalPayments = $row['total_payments'];

        if (!isset($chartDatasets[$detailsValue])) {
            $chartDatasets[$detailsValue] = [];
        }

        $chartDatasets[$detailsValue][] = $totalPayments;

        if (!in_array($week, $chartLabels)) {
            $chartLabels[] = $week;
        }
    }
}
?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    renderChart(<?php echo json_encode($chartLabels); ?>, <?php echo json_encode($chartDatasets); ?>);
  });

  function renderChart(labels, datasets) {
    var chartData = {
      labels: labels,
      datasets: Object.keys(datasets).map(function (detailsValue) {
        return {
          label: detailsValue,
          data: datasets[detailsValue],
          backgroundColor: getRandomColor(),
          borderColor: '#ffffff',
          borderWidth: 1
        };
      })
    };

    var chartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "top"
        }
      }
    };

    var ctx = document.getElementById("myChart1").getContext("2d");
    new Chart(ctx, {
      type: "bar",
      data: chartData,
      options: chartOptions
    });
  }

  function getRandomColor() {
    var letters = "0123456789abcdef";
    var color = "#";
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
</script>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

	$paymentDataQuery = "SELECT YEAR(date) AS year_only, details, COUNT(*) AS total_payments FROM tblpayments GROUP BY YEAR(date), details";
	$stmt = $conn->prepare($paymentDataQuery);
	$stmt->execute();
	$paymentDataResult = $stmt->get_result();

	$labels = [];
	$datasets = [];

	if ($paymentDataResult->num_rows > 0) {
		$barangays = [];
		while ($row = $paymentDataResult->fetch_assoc()) {
			$year = $row['year_only'];
			$barangay = $row['details'];

			if (!in_array($barangay, $barangays)) {
				$barangays[] = $barangay;
			}

			if (!isset($datasets[$barangay])) {
				$datasets[$barangay] = [];
			}

			$datasets[$barangay][$year] = $row['total_payments'];

			if (!in_array($year, $labels)) {
				$labels[] = $year;
			}
		}

		sort($labels);
		?>
		<script>
			var chartData = {
				labels: <?php echo json_encode($labels); ?>,
				datasets: [
					<?php foreach ($barangays as $barangay) { ?>
						{
							label: '<?php echo $barangay; ?>',
							data: [
								<?php foreach ($labels as $year) { ?>
									<?php echo isset($datasets[$barangay][$year]) ? $datasets[$barangay][$year] : 0; ?>,
								<?php } ?>
							],
							backgroundColor: getRandomColor(),
							borderColor: getRandomColor(),
							borderWidth: 1
						},
					<?php } ?>
				]
			};

			var chartOptions = {
				responsive: true,
				maintainAspectRatio: false,
				aspectRatio: 1.5,
				plugins: {
					legend: {
						position: "top"
					}
				},
				scales: {
					y: {
						beginAtZero: true
					}
				}
			};
			function getRandomColor() {
				var letters = "0123456789ABCDEF";
				var color = "#";
				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
			}

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
		<?php
	} else {
		echo "No data found.";
	}
?>
	<script>
		  $(document).on("click", "#pdf", function() {
		console.log("Exporting revenue table as PDF...");
		$("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
	});
	</script>
</body>
</html>