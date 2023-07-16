<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$certificatesDataQuery = "SELECT details, COUNT(*) AS count FROM tblpayments GROUP BY details";
$stmt = $conn->prepare($certificatesDataQuery);
$stmt->execute();
$certificatesDataResult = $stmt->get_result();

$certificatesChartLabels = [];
$certificatesChartData = [];

if ($certificatesDataResult->num_rows > 0) {
    while ($row = $certificatesDataResult->fetch_assoc()) {
        $detailsValue = $row['details'];
        $count = $row['count'];

        $certificatesChartLabels[] = $detailsValue;
        $certificatesChartData[] = $count;
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        renderChart(<?php echo json_encode($certificatesChartLabels); ?>, <?php echo json_encode($certificatesChartData); ?>);
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

        var ctx = document.getElementById("certificatesChart").getContext("2d");
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
