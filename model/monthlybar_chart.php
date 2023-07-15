<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$dataQuery = "SELECT DATE_FORMAT(date, '%M') AS month_name, details, COUNT(*) AS total_payments FROM tblpayments GROUP BY MONTH(date), details";
$stmt = $conn->prepare($dataQuery);
$stmt->execute();
$dataResult = $stmt->get_result();

$chartLabels = [];
$chartDatasets = [];

if ($dataResult->num_rows > 0) {
    while ($row = $dataResult->fetch_assoc()) {
        $month = $row['month_name'];
        $detailsValue = $row['details'];
        $totalPayments = $row['total_payments'];

        if (!isset($chartDatasets[$detailsValue])) {
            $chartDatasets[$detailsValue] = [];
        }

        $chartDatasets[$detailsValue][] = $totalPayments;

        if (!in_array($month, $chartLabels)) {
            $chartLabels[] = $month;
        }
    }
?>

<div class="page-inner">
    <div class="col">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>MONTHLY REPORTS</strong>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var chartData = {
        labels: <?php echo json_encode($chartLabels); ?>,
        datasets: [
            <?php foreach ($chartDatasets as $detailsValue => $data) { ?>
                {
                    label: '<?php echo $detailsValue; ?>',
                    data: [
                        <?php echo implode(',', $data); ?>,
                    ],
                    backgroundColor: getRandomColor(),
                    borderColor: '#ffffff',
                    borderWidth: 1
                },
            <?php } ?>
        ]
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

    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("myChart2").getContext("2d");
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
