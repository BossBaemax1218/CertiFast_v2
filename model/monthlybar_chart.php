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
?>

<script>
  var monthlyChartDataLabels = <?php echo json_encode($monthlyChartLabels); ?>;
  var monthlyChartDatasets = [];

  <?php foreach ($monthlyChartDatasets as $detailsValue => $data) { ?>
    var <?php echo $detailsValue; ?>Data = {
      label: '<?php echo $detailsValue; ?>',
      data: <?php echo json_encode($data); ?>,
      backgroundColor: getRandomColor(),
      borderColor: '#ffffff',
      borderWidth: 1
    };
    monthlyChartDatasets.push(<?php echo $detailsValue; ?>Data);
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
    var ctx = document.getElementById("myChart2").getContext("2d");
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
} else {
    echo "No data found.";
}
?>