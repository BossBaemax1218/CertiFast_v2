<?php
// Prepare and execute the SQL query to fetch data from tblpayments
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

<!-- Add the following HTML code to display the chart -->
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

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        var ctx = document.getElementById("myChart2").getContext("2d");
        new Chart(ctx, {
            type: "bar",
            data: chartData,
            options: chartOptions
        });
    }

    // Function to generate random colors
    function getRandomColor() {
        var letters = "0123456789abcdef";
        var color = "#";
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
