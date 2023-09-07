<div class="card">
      <div class="card-header text-right">
        <div class="card-tools mb-3">
            <form method="POST" action="">
                <a class="btn btn-light btn-border btn-sm" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-filter" aria-hidden="true"></i> Filter
                </a>
                <div class="dropdown-menu mt-3" aria-labelledby="filterDropdown">
                    <div class="dropdown-item">
                        <label for="dateType">Date Type:</label>
                        <select class="form-control" id="dateType" name="dateType" onclick="event.stopPropagation();">
                            <option value="weekly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'weekly') echo 'selected'; ?>>Show By Week</option>
                            <option value="monthly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'monthly') echo 'selected'; ?>>Show By Month</option>
                            <option value="yearly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'yearly') echo 'selected'; ?>>Show By Year</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label>Select types of Certificates:</label>
                        <select class="form-control" id="documentType" name="documentType" onclick="event.stopPropagation();">
                            <option value="All" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'All') echo 'selected'; ?>>All</option>
                            <option value="Barangay Clearance" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                            <option value="Certificate of Residency" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                            <option value="Certificate of Indigency" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                            <option value="Business Permit" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Business Permit') echo 'selected'; ?>>Business Permit</option>
                            <option value="Certificate of Good Moral" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Good Moral') echo 'selected'; ?>>Certificate of Good Moral</option>
                            <option value="Certificate of Birth " <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Birth ') echo 'selected'; ?>>Certificate of Birth</option>
                            <option value="Certificate of Oath Taking" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Oath Taking') echo 'selected'; ?>>Certificate of Oath Taking</option>
                            <option value="First Time Jobseekers" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'First Time Jobseekers') echo 'selected'; ?>>First Time Jobseekers</option>
                            <option value="Certificate of Live In" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Live In') echo 'selected'; ?>>Certificate of Live In</option>
                            <option value="Barangay Identification" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Barangay Identification') echo 'selected'; ?>>Barangay Identification</option>
                            <option value="Certificate of Death" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Death') echo 'selected'; ?>>Certificate of Death</option>
                            <option value="Family Home Estate" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Family Home Estate') echo 'selected'; ?>>Family Home Estate</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="fromDate">From:</label>
                        <input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo isset($_POST['fromDate']) ? htmlspecialchars($_POST['fromDate']) : date('Y-m-d'); ?>" onclick="event.stopPropagation();">
                    </div>
                    <div class="dropdown-item">
                        <label for="toDate">To:</label>
                        <input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo isset($_POST['toDate']) ? htmlspecialchars($_POST['toDate']) : date('Y-m-d'); ?>" onclick="event.stopPropagation();">
                    </div>
                    <div class="dropdown-item">
                        <button type="submit" class="form-control applyFilterBtn btn btn-primary">Apply Filter</button>
                    </div>
                </div>
                <a id="pdfExportBtn" class="btn btn-light btn-border btn-sm">
                    <i class="fas fa-download"></i>
                </a>
            </form>
        </div>
    <div id="chartRow">
        <div class="card-footer">
            <p class="description" id="description"></p>
        </div>
        <div class="card-body">
            <canvas id="myChart3" width="350" height="150"></canvas>
        </div>
    </div>
</div>
<?php
include 'server/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$currentYear = date('Y');
$currentMonth = date('m', strtotime('last Month'));
$firstDayOfMonth = date('Y-m-d', strtotime("$currentYear-$currentMonth-01"));
$currentDate = date('Y-m-d');

$dateType = isset($_POST['dateType']) ? $_POST['dateType'] : 'weekly';
$fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : $firstDayOfMonth;
$toDate = isset($_POST['toDate']) ? $_POST['toDate'] : $currentDate;
$documentType = isset($_POST['documentType']) ? $_POST['documentType'] : 'All';

// Add variables to store selected week and year
$selectedWeek = '';
$selectedMonth = '';
$selectedYear = '';

$sql = "SELECT ";

if ($dateType === 'weekly') {
    $sql .= "CONCAT(DATE_FORMAT(date, '%M '), ";
    $sql .= "CASE 
                WHEN DAY(date) BETWEEN 1 AND 7 THEN '1st week'
                WHEN DAY(date) BETWEEN 8 AND 14 THEN '2nd week'
                WHEN DAY(date) BETWEEN 15 AND 21 THEN '3rd week'
                WHEN DAY(date) BETWEEN 22 AND 28 THEN '4th week'
                ELSE '5th week'
            END) AS date_key, ";
    $sql .= "DATE_FORMAT(date, '%U') AS week, "; // Added to select week
    $orderExpression = "DATE_FORMAT(date, '%Y-%m-%d')";
} elseif ($dateType === 'monthly') {
    $sql .= "DATE_FORMAT(date, '%M %Y') AS date_key, ";
    $sql .= "DATE_FORMAT(date, '%Y') AS year, "; // Added to select year
    $orderExpression = "DATE_FORMAT(date, '%Y-%m')";
} elseif ($dateType === 'yearly') {
    $sql .= "DATE_FORMAT(date, '%Y') AS date_key, ";
    $orderExpression = "DATE_FORMAT(date, '%Y')";
}

$sql .= "details, COUNT(*) AS count
        FROM tblpayments
        WHERE DATE(date) BETWEEN :fromDate AND :toDate ";

if ($documentType !== 'All') {
    $sql .= "AND (details = :documentType) ";
}

$sql .= "GROUP BY date_key, details ";
$sql .= "ORDER BY $orderExpression, FIELD(details,'Barangay Clearance', 'Certificate of Residency', 'Certificate of Indigency', 'Business Permit','Certificate of Good Moral','Certificate of Birth','Certificate of Oath Taking','First Time Jobseekers','Certificate of Live In','Barangay Identification','Certificate of Death','Family Home Estate')";

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
    $count = (int)$row['count'];
    $documentType = $row['details'];

    $dateKey = $row['date_key'];

    // Update selected month, week, and year based on the row data
    $selectedMonth = isset($row['month']) ? $row['month'] : '';
    $selectedWeek = isset($row['week']) ? $row['week'] : '';
    $selectedYear = isset($row['year']) ? $row['year'] : '';

    if (!isset($chartData[$dateKey])) {
        $chartData[$dateKey] = [];
    }
    if ($documentType === 'All') {
        $documentTypes = ['Barangay Clearance', 'Certificate of Residency', 'Certificate of Indigency', 'Business Permit', 'Certificate of Good Moral', 'Certificate of Birth', 'Certificate of Oath Taking', 'First Time Jobseekers', 'Certificate of Live In', 'Barangay Identification', 'Certificate of Death', 'Family Home Estate'];
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

    var days = Object.keys(chartData);
    var documentTypes = Object.keys(chartData[days[0]]);

    var datasets = [];
    documentTypes.forEach(function(documentType) {
        var data = days.map(function(day) {
            var value = chartData[day][documentType] || 0;
            return Math.round(value);
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
                y: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                        callback: function(value) {
                            if (value === 1 || value === 2) {
                                return value.toFixed(0);
                            } else {
                                return Math.round(value);
                            }
                        }
                    }
                }]
            }
        }
    });
    
    var description = "<table><tr><th style=' font-size: 18px;'> This is all the data of the certifications that has been requested. </th><th></th></tr>";
    documentTypes.forEach(function(documentType) {
        var value;
        if (documentType === "All") {
            value = totalValues["All"] || 0;
        } else {
            value = totalValues[documentType] || 0;
        }

        description += "<tr><td style='text-align: left; font-size: 14px;'>" + documentType + "</td><td style='text-align: left; font-size: 14px;'><b>" + value + "</b></td></tr>";
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

    <script>
    document.getElementById("pdfExportBtn").addEventListener("click", function () {
      var doc = new jsPDF();
      var chartRow = document.getElementById("chartRow");
      var fromDate = document.getElementById("fromDate").value;
      var toDate = document.getElementById("toDate").value;
      var documentType = document.getElementById("documentType").value;

      var title = "Overview Bar Chart Visualization Reports";
      doc.setFontSize(18);
      doc.text(title, 10, 10);

      var currentDate = new Date().toLocaleDateString();
      doc.setFontSize(14);
      doc.text("Today Date: " + currentDate, 10, 20);
      doc.text("Date: " + fromDate + " to " + toDate, 10, 30);
      doc.text("Document Type: " + documentType, 10, 40);

      var width = 200;
      var height = 150;

      html2canvas(chartRow, { scale: 1 }).then(function (canvas) {
        var imgData = canvas.toDataURL("image/png");
        doc.addImage(imgData, "PNG", 5, 60, width, height);

        doc.save("Dashboard-Chart.pdf");
      });
    });
</script>
