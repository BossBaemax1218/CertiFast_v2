<style>
    .card {
      max-width: 1200px;
      margin: auto 0px;
      border-radius: 5px;
    }

    .card-header {
      color: black;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }
    #description {
      font-size: 16px;
    }
    table {
    border-collapse: collapse;
    width: 100%;
  }
  
  th, td {
    padding: 8px;
    text-align: left;
  }
  
  th {
    text-align: left;
  }
    @media screen and (max-width: 600px) {
      .description {
        font-size: 12px;
      }
      .card {
      max-width: 1200px;
      width: 400px;
      height: 600px;
    }
    }

    @media screen and (max-width: 1100px) {
      #myChart3 {
        width: 100%;
        max-width: 1200px;
        height: 350px;
      }
    }

    @media screen and (max-width: 800px) {
      #myChart3 {
        max-width: 1200px;
        width: 100%;
      height: 100%;
      }
    }

    @media screen and (max-width: 400px) {
      .description {
        font-size: 10px;
      }
      #myChart3 {
        max-width: 1200px;
        width: 100%;
      height: 100%;
      }
    }
  </style>
  <div class="card">
    <div class="card-header">
      <strong>REPORTS</strong>
    </div>
    <div class="card-footer">
      <p class="description" id="description"></p>
    </div>
    <div class="card-body">
      <canvas id="myChart3"></canvas>
    </div>
  </div>

  <?php
include 'server/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$chartDataJson = "null";
$totalValuesJson = "null";

$currentDate = date('Y-m-d');

// Initialize the $dateType variable
$dateType = isset($_POST['dateType']) ? $_POST['dateType'] : '';

// Check if a specific filter is selected or not
$isFilterSelected = ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dateType']));

if ($isFilterSelected) {
    // Process the selected filter
    $validDateTypes = array('weekly', 'monthly', 'yearly', 'mostcert');
    if (!in_array($dateType, $validDateTypes)) {
        echo "Invalid date type selected.";
        $conn->close();
        exit();
    }

    $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : $currentDate;
    $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : $currentDate;

    $documentType = isset($_POST['documentType']) ? $_POST['documentType'] : 'All';

    switch ($dateType) {
        case 'weekly':
            $sql = "SELECT DATE_FORMAT(date, '%W') AS date_key, details, COUNT(*) AS count
                    FROM tblpayments
                    WHERE date BETWEEN :fromDate AND :toDate
                    AND (details = :documentType OR :documentType = 'All')
                    GROUP BY date_key, details
                    ORDER BY FIELD(date_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), date_key";
            break;
        case 'monthly':
            $sql = "SELECT MONTH(date) AS date_key, details, COUNT(*) AS count
                    FROM tblpayments
                    WHERE date BETWEEN :fromDate AND :toDate
                    AND (details = :documentType OR :documentType = 'All')
                    GROUP BY date_key, details";
            break;
        case 'yearly':
            $sql = "SELECT YEAR(date) AS date_key, details, COUNT(*) AS count
                    FROM tblpayments
                    WHERE date BETWEEN :fromDate AND :toDate
                    AND (details = :documentType OR :documentType = 'All')
                    GROUP BY date_key, details";
            break;
        case 'mostcert':
            $sql = "SELECT details AS date_key, COUNT(*) AS count
                    FROM tblpayments
                    WHERE date BETWEEN :fromDate AND :toDate
                    AND (details = :documentType OR :documentType = 'All')
                    GROUP BY date_key, details
                    ORDER BY count DESC
                    LIMIT 10";
            break;
        default:
            echo "Invalid date type selected.";
            $conn->close();
            exit();
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fromDate', $fromDate);
    $stmt->bindParam(':toDate', $toDate);
    $stmt->bindParam(':documentType', $documentType);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $chartData = [];
    $totalValues = [];
    foreach ($result as $row) {
        $dateKey = $dateType === 'monthly' ? date('F', mktime(0, 0, 0, $row['date_key'], 1)) : ($dateType === 'yearly' ? $row['date_key'] : $row['date_key']);
        $documentType = $row['details'] ?? '';
        $count = $row['count'] ?? 0;

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

// Fetch the data for the most requested certificate as default (for the last Monday and this week)
$lastMonday = date('Y-m-d', strtotime('last monday'));
$thisWeek = date('Y-m-d');
$defaultFromDate = $lastMonday;
$defaultToDate = $thisWeek;

$mostRequestedSql = "SELECT DATE_FORMAT(date, '%W') AS date_key, details, COUNT(*) AS count
                    FROM tblpayments
                    WHERE date BETWEEN :defaultFromDate AND :defaultToDate
                    GROUP BY date_key, details
                    ORDER BY FIELD(date_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), date_key";

$mostRequestedStmt = $pdo->prepare($mostRequestedSql);
$mostRequestedStmt->bindParam(':defaultFromDate', $defaultFromDate);
$mostRequestedStmt->bindParam(':defaultToDate', $defaultToDate);
$mostRequestedStmt->execute();

$mostRequestedResult = $mostRequestedStmt->fetchAll(PDO::FETCH_ASSOC);

$defaultChartData = [];
$defaultTotalValues = [];

foreach ($mostRequestedResult as $row) {
    $dateKey = $row['date_key'] ?? '';
    $documentType = $row['details'] ?? '';
    $count = $row['count'] ?? 0;

    if (!isset($defaultChartData[$dateKey])) {
        $defaultChartData[$dateKey] = [];
    }

    $defaultChartData[$dateKey][$documentType] = $count;

    if (!isset($defaultTotalValues[$documentType])) {
        $defaultTotalValues[$documentType] = 0;
    }

    $defaultTotalValues[$documentType] += $count;
}

// Convert the default chart data to JSON
$defaultChartDataJson = json_encode($defaultChartData);
$defaultTotalValuesJson = json_encode($defaultTotalValues);
?>

<script>
    function displayDefaultChart() {
      var chartData = <?php echo isset($errorMessage) ? 'null' : $chartDataJson; ?>;
            var totalValues = <?php echo isset($errorMessage) ? 'null' : $totalValuesJson; ?>;
            var defaultChartData = <?php echo $defaultChartDataJson; ?>;
            var defaultTotalValues = <?php echo $defaultTotalValuesJson; ?>;

            if (chartData === null || totalValues === null) {
                var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : ''; ?>";
                var descriptionElement = document.getElementById('description');
                descriptionElement.innerHTML = "<p style='color: red; font-weight: bold;'>" + errorMessage + "</p>";
                return;
            }

            // Use default data for most requested certificates if no specific filter is selected
            if (Object.keys(chartData).length === 0 && Object.keys(totalValues).length === 0) {
                chartData = defaultChartData;
                totalValues = defaultTotalValues;
            }
    }

    function displayFilteredChart() {
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
            var data = days.map(function(day) {
                return chartData[day][documentType] || 0;
            });

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

        var description = "<table><tr><th>Result</th><th>Value</th></tr>";
        var documentTypes = Object.keys(totalValues);
        documentTypes.forEach(function(documentType) {
            var value = totalValues[documentType];
            if (documentType === "All") {
                description += "<tr><td>" + documentType + "</td><td><b>" + value + " (Total)</b></td></tr>";
            } else {
                description += "<tr><td>" + documentType + "</td><td><b>" + value + "</b></td></tr>";
            }
        });
        description += "</table>";

        var descriptionElement = document.getElementById('description');
        descriptionElement.innerHTML = description;
    }



    window.addEventListener('load', function () {
        displayChart();
    });

    var applyFilterBtn = document.getElementById('applyFilterBtn');
    applyFilterBtn.addEventListener('click', function(event) {
        event.preventDefault(); 

        var form = document.querySelector('form');
        form.submit();
    });


    </script>
