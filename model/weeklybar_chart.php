
    <div class="card">
      <div class="card-header">
      <strong>WEEKLY REPORTS</strong>
                    <span class="datetime" style="float: right;"><?php echo date('Y-m-d H:i:s'); ?></span>
        </div>
        <div class="card-body">
        <canvas id="weekly_charts" style="width: 100%; max-width: 1450px; height: 350px;"></canvas>
        </div>
    </div>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dataQuery = "SELECT DATE_FORMAT(date, '%W') AS week_name, details, COUNT(*) AS weekly_payments FROM tblpayments WHERE MONTH(date) = MONTH(CURDATE()) AND DAY(date) = DAY(CURDATE()) GROUP BY WEEK(date), details ORDER BY FIELD(DAYNAME(date), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
$stmt = $conn->prepare($dataQuery);
$stmt->execute();
$dataResult = $stmt->get_result();

$chartLabels = [];
$chartDatasets = [];

if ($dataResult->num_rows > 0) {
    while ($row = $dataResult->fetch_assoc()) {
        $week = $row['week_name'];
        $detailsValue = $row['details'];
        $weekly_payments = $row['weekly_payments'];

        if (!isset($chartDatasets[$detailsValue])) {
            $chartDatasets[$detailsValue] = [];
        }

        $chartDatasets[$detailsValue][] = $weekly_payments;

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

    var ctx = document.getElementById("weekly_charts").getContext("2d");
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

