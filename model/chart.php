
  <div class="card">
    <div class="card-header">
      <strong>REPORTS</strong>
    </div>
    <div id="chartRow">
        <div class="card-footer">
          <p class="description" id="description"></p>
        </div>
        <div class="card-body">
          <canvas id="myChart3"></canvas>
        </div>
    </div>
  </div>

  <?php
include 'server/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$chartDataJson = "null";
$totalValuesJson = "null";

$currentDate = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dateType'])) {
        $dateType = $_POST['dateType'];

        $validDateTypes = array('weekly', 'monthly', 'yearly', 'mostcert');
        if (!in_array($dateType, $validDateTypes)) {
            echo "Invalid date type selected.";
            exit();
        }

        $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : date('Y-m-01');
        $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : $currentDate;
        $documentType = isset($_POST['documentType']) ? $_POST['documentType'] : 'All';

        switch ($dateType) {
            case 'weekly':
                $startOfWeek = date('Y-m-d', strtotime('monday this week', strtotime($fromDate)));
                $endOfWeek = date('Y-m-d', strtotime('sunday this week', strtotime($toDate)));

                $sql = "SELECT DATE_FORMAT(date, '%W') AS date_key, details, COUNT(*) AS count
                        FROM tblpayments
                        WHERE DATE_FORMAT(date, '%Y-%m-%d') BETWEEN :fromDate AND :toDate
                        AND (details = :documentType OR :documentType = 'All')
                        GROUP BY date_key, details
                        ORDER BY FIELD(date_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), date_key";
                break;
            case 'monthly':
                $sql = "SELECT MONTH(date) AS date_key, details, COUNT(*) AS count
                        FROM tblpayments
                        WHERE DATE_FORMAT(date, '%Y-%m-%d') BETWEEN :fromDate AND :toDate
                        GROUP BY date_key, details";
                break;
            case 'yearly':
                $sql = "SELECT YEAR(date) AS date_key, details, COUNT(*) AS count
                        FROM tblpayments
                        WHERE DATE_FORMAT(date, '%Y-%m-%d') BETWEEN :fromDate AND :toDate
                        GROUP BY date_key, details";
                break;
            case 'mostcert':
                $sql = "SELECT details, COUNT(*) AS count
                        FROM tblpayments
                        WHERE DATE_FORMAT(date, '%Y-%m-%d') BETWEEN :fromDate AND :toDate
                        GROUP BY details";
                break;
            default:
                $errorMessage = "Invalid date type selected.";
                exit();
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        if ($dateType === 'weekly') {
            // Bind the :documentType parameter for weekly and mostcert cases
            $stmt->bindParam(':documentType', $documentType);
        }
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            $errorMessage = "No data available for the selected period.";
            exit();
        }

        $chartData = [];
        $totalValues = [];
        foreach ($result as $row) {
            $count = $row['count'];
            $documentType = $row['details'];

            // If it's the 'mostcert' case, we'll use the document type as the date key
            $dateKey = $dateType === 'mostcert' ? $documentType : ($dateType === 'weekly' ? "" . $row['date_key'] : ($dateType === 'monthly' ? date('F', mktime(0, 0, 0, $row['date_key'], 1)) : $row['date_key']));

            if (!isset($chartData[$dateKey])) {
                $chartData[$dateKey] = [];
            }

            $chartData[$dateKey][$documentType] = $count;

            if (!isset($totalValues[$documentType])) {
                $totalValues[$documentType] = 0;
            }

            $totalValues[$documentType] += $count;
        }

        $chartDataJson = json_encode($chartData);
        $totalValuesJson = json_encode($totalValues);
    }
}
?>


<script>
    function displayChart() {
        var chartData = <?php echo isset($errorMessage) ? 'null' : $chartDataJson; ?>;
        var totalValues = <?php echo isset($errorMessage) ? 'null' : $totalValuesJson; ?>;

        if (chartData === null || totalValues === null) {
            var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : ''; ?>";
            var descriptionElement = document.getElementById('description');
            descriptionElement.innerHTML = "<p style='color: red; font-weight: bold;'>" + errorMessage + "</p>";
            return;
        }

        var days = Object.keys(chartData);
        var documentTypes = Object.keys(chartData[days[0]]);

        var datasets = [];
        documentTypes.forEach(function(documentType) {
            if (documentType === "Most Requested Cert") {
                var data = days.map(function(day) {
                    return chartData[day]["Most Requested Cert"] || 0;
                });
            } else if (documentType === "All") {
                var data = days.map(function(day) {
                    return chartData[day]["All"] || 0;
                });
            } else {
                var data = days.map(function(day) {
                    return chartData[day][documentType] || 0;
                });
            }

            datasets.push({
                label: documentType,
                data: data,
                backgroundColor: getRandomColor()
            });
        });

        var ctx = document.getElementById('myChart3').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: days,
                datasets: datasets
            },
            options: {
                maintainAspectRatio: true,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        var description = "<table><tr><th>This is the number of Requested Certification</th><th>Total Value</th></tr>";
        documentTypes.forEach(function(documentType) {
            var value;
            if (documentType === "Most Requested Cert") {
                value = totalValues["Most Requested Cert"] || 0;
            } else if (documentType === "All") {
                value = totalValues["All"] || 0;
            } else {
                value = totalValues[documentType] || 0;
            }

            description += "<tr><td>" + documentType + "</td><td><b>" + value + "</b></td></tr>";
        });
        description += "</table>";

        var descriptionElement = document.getElementById('description');
        descriptionElement.innerHTML = description;
    }

    window.addEventListener('load', function() {
        displayChart();
    });

    var applyFilterBtn = document.getElementById('applyFilterBtn');
    applyFilterBtn.addEventListener('click', function(event) {
        event.preventDefault();

        var form = document.querySelector('form');
        form.submit();
    });

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
