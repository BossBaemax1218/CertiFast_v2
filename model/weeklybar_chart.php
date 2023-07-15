<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
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
<div class="page-inner">
    <div class="col">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart2" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

        var ctx = document.getElementById("myChart2").getContext("2d");
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
