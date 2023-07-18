<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="chart-container" id="chartContainer">
    <div class="chart">
        <div class="page-inner">
            <div class="col">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <strong>MOST REQUESTED CERTIFICATES REPORTS</strong>
                        <span class="datetime" style="float: right;"><?php echo date('Y-m-d H:i:s'); ?></span>
                    </div>
                    <div class="card-body">
                        <canvas id="certificatesChart" style="width: 300%; max-width: 1450px; height: 400px;"></canvas>
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

$certificatesDataQuery = "SELECT details, COUNT(*) AS most_certreq FROM tblpayments WHERE YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE()) GROUP BY details";
$stmt = $conn->prepare($certificatesDataQuery);
$stmt->execute();
$certificatesDataResult = $stmt->get_result();

$certificatesChartLabels = [];
$certificatesChartData = [];

if ($certificatesDataResult->num_rows > 0) {
    while ($row = $certificatesDataResult->fetch_assoc()) {
        $detailsResult = $row['details'];
        $most_certreq = $row['most_certreq'];

        $certificatesChartLabels[] = $detailsResult;
        $certificatesChartData[] = $most_certreq;
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (!empty($certificatesChartLabels) && !empty($certificatesChartData)) { ?>
            renderCertificatesChart(<?php echo json_encode($certificatesChartLabels); ?>, <?php echo json_encode($certificatesChartData); ?>);
        <?php } else { ?>
            showChartMessage("No data found.");
        <?php } ?>
    });

    function renderCertificatesChart(certificatesChartLabels, certificatesChartData) {
        var chartData = {
            labels: certificatesChartLabels,
            datasets: [{
                label: 'Most Requested Certificates',
                data: certificatesChartData,
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

    function showChartMessage(message) {
        var chartMessage = document.getElementById("chartMessage");
        chartMessage.textContent = message;
        chartMessage.style.display = "block";
    }
</script>