<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="chart-container" id="chartContainer">
  <div class="chart">
    <div class="page-inner">
    <div class="col">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <strong>MONTHLY REPORTS</strong>
          <span class="datetime" style="float: right;"><?php echo date('Y-m-d H:i:s'); ?></span>
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
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$monthlyDataQuery = "SELECT DATE_FORMAT(date, '%M') AS month_name, details, COUNT(*) AS monthly_payments FROM tblpayments WHERE YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date), details;";
$stmt = $conn->prepare($monthlyDataQuery);
$stmt->execute();
$monthlyDataResult = $stmt->get_result();

$monthlyChartLabels = [];
$monthlyChartDatasets = [];

if ($monthlyDataResult->num_rows > 0) {
    while ($row = $monthlyDataResult->fetch_assoc()) {
        $month = $row['month_name'];
        $detailsValue = $row['details'];
        $monthly_payments = $row['monthly_payments'];

        if (!isset($monthlyChartDatasets[$detailsValue])) {
            $monthlyChartDatasets[$detailsValue] = [];
        }

        $monthlyChartDatasets[$detailsValue][] = $monthly_payments;

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