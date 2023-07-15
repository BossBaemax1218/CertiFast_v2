<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$dataQuery = "SELECT details, COUNT(*) AS count FROM tblpayments GROUP BY details";
$stmt = $conn->prepare($dataQuery);
$stmt->execute();
$dataResult = $stmt->get_result();

$chartLabels = [];
$chartData = [];

if ($dataResult->num_rows > 0) {
    while ($row = $dataResult->fetch_assoc()) {
        $detailsValue = $row['details'];
        $count = $row['count'];

        $chartLabels[] = $detailsValue;
        $chartData[] = $count;
    }
}
?>
<div class="page-inner">
    <div class="col">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart4" style="width: 100%; max-width: 1450px; height: 550px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        renderChart(<?php echo json_encode($chartLabels); ?>, <?php echo json_encode($chartData); ?>);
    });

    function renderChart(labels, data) {
    var chartData = {
        labels: labels,
        datasets: [{
            label: 'Most Requested Certificates',
            data: data,
            backgroundColor: getRandomColor(),
            borderColor: '#ffffff',
            borderWidth: 1
        }]
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

        var ctx = document.getElementById("myChart4").getContext("2d");
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
