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
$lastMonday = date('Y-m-d', strtotime('last Monday'));

$dateType = isset($_POST['dateType']) ? $_POST['dateType'] : 'weekly';
$fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : $lastMonday;
$toDate = isset($_POST['toDate']) ? $_POST['toDate'] : $currentDate;
$documentType = isset($_POST['documentType']) ? $_POST['documentType'] : 'All';

$sql = "SELECT ";
if ($dateType === 'weekly') {
    $sql .= "CONCAT(' ', DATE_FORMAT(date, '%W')) AS date_key, ";
} elseif ($dateType === 'monthly') {
    $sql .= "DATE_FORMAT(date, '%Y-%m') AS date_key, ";
} elseif ($dateType === 'yearly') {
    $sql .= "DATE_FORMAT(date, '%Y') AS date_key, ";
}
$sql .= "details, COUNT(*) AS count
        FROM tblpayments
        WHERE DATE(date) BETWEEN :fromDate AND :toDate ";

if ($documentType !== 'All') {
    $sql .= "AND (details = :documentType) ";
}

$sql .= "GROUP BY date_key, details ";
$sql .= "ORDER BY FIELD(date_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', date_key), FIELD(details, 'Barangay Clearance', 'Certificate of Residency', 'Certificate of Indigency', 'Business Permit','Certificate of Good Moral',
'Certificate of Birth','Certificate of Oath Taking','First Time Jobseekers','Certificate of Live In','Barangay Identification','Certificate of Death','Business Permit','Family Home Estate')";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':fromDate', $fromDate);
$stmt->bindParam(':toDate', $toDate);

if ($documentType !== 'All') {
    $stmt->bindParam(':documentType', $documentType);
}

$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)) {
    echo "No data available for the selected period.";
    exit();
}

$chartData = [];
$totalValues = [];
foreach ($result as $row) {
    $count = $row['count'];
    $documentType = $row['details'];

    $dateKey = $dateType === 'weekly' ? "" . $row['date_key'] : ($dateType === 'monthly' ? date('F', mktime(0, 0, 0, (int)substr($row['date_key'], 5), 1)) : $row['date_key']);

    if (!isset($chartData[$dateKey])) {
        $chartData[$dateKey] = [];
    }
    if ($documentType === 'All') {
        $documentTypes = ['Barangay Clearance', 'Certificate of Residency', 'Certificate of Indigency', 'Business Permit','Certificate of Good Moral',
        'Certificate of Birth','Certificate of Oath Taking','First Time Jobseekers','Certificate of Live In','Barangay Identification','Certificate of Death','Business Permit','Family Home Estate'];
        foreach ($documentTypes as $type) {
            if (!isset($chartData[$dateKey][$type])) {
                $chartData[$dateKey][$type] = 0;
            }
        }
    } else {
        $chartData[$dateKey][$documentType] = $count;
    }

    if (!isset($totalValues[$documentType])) {
        $totalValues[$documentType] = 0;
    }

    $totalValues[$documentType] += $count;
}

$chartDataJson = json_encode($chartData);
$totalValuesJson = json_encode($totalValues);
?>

<script>
    function displayChart() {
        var chartData = <?php echo isset($errorMessage) ? 'null' : $chartDataJson; ?>;
        var totalValues = <?php echo isset($errorMessage) ? 'null' : $totalValuesJson; ?>;

        if (chartData === null || totalValues === null) {
            var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : ''; ?>";
            var descriptionElement = document.getElementById('description');
            descriptionElement.innerHTML = "<p style='color: red; font-weight: bold; font-size: 16px;'>" + errorMessage + "</p>";
            var canvasElement = document.getElementById('myChart3');
            canvasElement.style.display = 'none';
            return;
        }

        var days = Object.keys(chartData);
        var documentTypes = Object.keys(chartData[days[0]]);

        var datasets = [];
        documentTypes.forEach(function(documentType) {
            if (documentType === "All") {
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

        var description = "<table><tr><th>Document Type &nbsp</th><th>Total</th></tr>";
        documentTypes.forEach(function(documentType) {
            var value;
            if (documentType === "All") {
                value = totalValues["All"] || 0;
            } else {
                value = totalValues[documentType] || 0;
            }

            description += "<tr><td>" + documentType + " " + " " +"</td><td><b>" + value + "</b></td></tr>";
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
