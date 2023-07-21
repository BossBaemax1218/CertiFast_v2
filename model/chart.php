
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

$currentDate = date('Y-m-d');
$firstDayOfMonth = date('Y-m-01');

$chartDataJson = "null";
$totalValuesJson = "null";

// Get the first day of the current month
$firstDayOfMonth = date('Y-m-01');

// Get the current date
$currentDate = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['dateType'])) {
        $dateType = $_POST['dateType'];

        $validDateTypes = array('weekly', 'monthly', 'yearly', 'mostcert');
        if (!in_array($dateType, $validDateTypes)) {
            echo "Invalid date type selected.";
            $conn->close();
            exit();
        }

        $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : $firstDayOfMonth;
        $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : $currentDate;
        $dateType = isset($_POST['dateType']) ? $_POST['dateType'] : 'mostcert';
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
                $errorMessage = "Invalid date type selected."; 
                $conn->close();
                break;
        }

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        $stmt->bindParam(':documentType', $documentType);
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Process the results and create chart data
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

        // Convert chart data and total values to JSON
        $chartDataJson = json_encode($chartData);
        $totalValuesJson = json_encode($totalValues);
    }
}

// Get the most cert and all documents data before applying filters
$mostCertSql = "SELECT details, COUNT(*) AS count
               FROM tblpayments
               WHERE date BETWEEN :firstDayOfMonth AND :currentDate
               GROUP BY details
               ORDER BY count DESC
               LIMIT 10";
$mostCertStmt = $pdo->prepare($mostCertSql);
$mostCertStmt->bindParam(':firstDayOfMonth', $firstDayOfMonth);
$mostCertStmt->bindParam(':currentDate', $currentDate);
$mostCertStmt->execute();

$mostCertData = $mostCertStmt->fetchAll(PDO::FETCH_ASSOC);

$allDocumentsSql = "SELECT details, COUNT(*) AS count
                    FROM tblpayments
                    WHERE date BETWEEN :firstDayOfMonth AND :currentDate
                    GROUP BY details";
$allDocumentsStmt = $pdo->prepare($allDocumentsSql);
$allDocumentsStmt->bindParam(':firstDayOfMonth', $firstDayOfMonth);
$allDocumentsStmt->bindParam(':currentDate', $currentDate);
$allDocumentsStmt->execute();

$allDocumentsData = $allDocumentsStmt->fetchAll(PDO::FETCH_ASSOC);

$firstDayOfMonthData = [
    'MostCert' => $mostCertData,
    'All' => $allDocumentsData,
];
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

      var description = "<table><tr><th>Document</th><th>Value</th></tr>";
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

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }
</script>
