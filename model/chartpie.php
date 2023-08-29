    <div class="card">
        <div class="card-header text-right">
            <div class="card-tools">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <a class="btn btn-light btn-border btn-sm" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-filter" aria-hidden="true"></i> Filter
                </a>
                <div class="dropdown-menu mt-3" aria-labelledby="filterDropdown">
                    <div class="dropdown-item">
                        <label for="piestatusType">Status Type:</label>
                        <select class="form-control" id="piestatusType" name="piestatusType" onclick="event.stopPropagation();">
                            <option value="All" <?php if (isset($_POST['piestatusType']) && $_POST['piestatusType'] === 'All') echo 'selected'; ?>>All</option>
                            <option value="on hold" <?php if (isset($_POST['piestatusType']) && $_POST['piestatusType'] === 'on hold') echo 'selected'; ?>>On Hold</option>
                            <option value="approved" <?php if (isset($_POST['piestatusType']) && $_POST['piestatusType'] === 'approved') echo 'selected'; ?>>Approved</option>
                            <option value="rejected" <?php if (isset($_POST['piestatusType']) && $_POST['piestatusType'] === 'rejected') echo 'selected'; ?>>Rejected</option>
                            <option value="claimed" <?php if (isset($_POST['piestatusType']) && $_POST['piestatusType'] === 'claimed') echo 'selected'; ?>>Claimed</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="piedateType">Date Type:</label>
                        <select class="form-control" id="piedateType" name="piedateType" onclick="event.stopPropagation();">
                            <option value="weekly" <?php if (isset($_POST['piedateType']) && $_POST['piedateType'] === 'weekly') echo 'selected'; ?>>By Week</option>
                            <option value="monthly" <?php if (isset($_POST['piedateType']) && $_POST['piedateType'] === 'monthly') echo 'selected'; ?>>By Month</option>
                            <option value="yearly" <?php if (isset($_POST['piedateType']) && $_POST['piedateType'] === 'yearly') echo 'selected'; ?>>By Year</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label>Select types of Certificates:</label>
                        <select class="form-control" id="certificateType" name="certificateType" onclick="event.stopPropagation();">
                            <option value="All" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'All') echo 'selected'; ?>>All</option>
                            <option value="Barangay Clearance" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                            <option value="Certificate of Residency" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                            <option value="Certificate of Indigency" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                            <option value="Business Permit" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Business Permit') echo 'selected'; ?>>Business Permit</option>
                            <option value="Certificate of Good Moral" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Good Moral') echo 'selected'; ?>>Certificate of Good Moral</option>
                            <option value="Certificate of Birth " <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Birth ') echo 'selected'; ?>>Certificate of Birth</option>
                            <option value="Certificate of Oath Taking" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Oath Taking') echo 'selected'; ?>>Certificate of Oath Taking</option>
                            <option value="First Time Jobseekers" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'First Time Jobseekers') echo 'selected'; ?>>First Time Jobseekers</option>
                            <option value="Certificate of Live In" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Live In') echo 'selected'; ?>>Certificate of Live In</option>
                            <option value="Barangay Identification" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Barangay Identification') echo 'selected'; ?>>Barangay Identification</option>
                            <option value="Certificate of Death" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Certificate of Death') echo 'selected'; ?>>Certificate of Death</option>
                            <option value="Family Home Estate" <?php if (isset($_POST['certificateType']) && $_POST['certificateType'] === 'Family Home Estate') echo 'selected'; ?>>Family Home Estate</option>
                        </select>
                    </div>
                    <div class="dropdown-item">
                        <label for="piefromDate">From:</label>
                        <input type="date" class="form-control" id="piefromDate" name="piefromDate" value="<?php echo isset($_POST['piefromDate']) ? htmlspecialchars($_POST['piefromDate']) : date('Y-m-d'); ?>" onclick="event.stopPropagation();">
                    </div>
                    <div class="dropdown-item">
                        <label for="pietoDate">To:</label>
                        <input type="date" class="form-control" id="pietoDate" name="pietoDate" value="<?php echo isset($_POST['pietoDate']) ? htmlspecialchars($_POST['pietoDate']) : date('Y-m-d'); ?>" onclick="event.stopPropagation();">
                    </div>
                    <div class="dropdown-item">
                        <a type="button" class="text-white form-control PieapplyFilterBtn btn btn-primary">Apply Filter</a>
                    </div>
                </div>
                <a id="PiepdfExportBtn" class="btn btn-light btn-border btn-sm">
                    <i class="fas fa-download"></i>
                </a>
            </form>
        </div>                                 
    </div>
    <div id="chartRowPie">
        <div class="card-footer">
            <p class="description" id="description"></p>
        </div>
        <div class="card-body">
            <canvas id="certificateStatusChar"></canvas>
        </div>
    </div>
</div>
<?php
include 'server/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$piestatusType = isset($_POST['piestatusType']) ? $_POST['piestatusType'] : 'All';
$piedateType = isset($_POST['piedateType']) ? $_POST['piedateType'] : 'monthly';
$piefromDate = isset($_POST['piefromDate']) ? $_POST['piefromDate'] : date('Y-m-d');
$pietoDate = isset($_POST['pietoDate']) ? $_POST['pietoDate'] : date('Y-m-d');
$certificateType = isset($_POST['certificateType']) ? $_POST['certificateType'] : 'All';

$query = "SELECT ";
if ($piedateType === 'weekly') {
    $query .= "CONCAT(YEAR(date_applied), '-', WEEK(date_applied)) AS pie_key, ";
} elseif ($piedateType === 'monthly') {
    $query .= "DATE_FORMAT(date_applied, '%Y-%m') AS pie_key, ";
} elseif ($piedateType === 'yearly') {
    $query .= "YEAR(date_applied) AS pie_key, ";
}
$query .= ($filterBy === 'piestatusType') ? "status, " : "certificate_name, ";
$query .= "COUNT(*) AS request_count
        FROM tblresident_requested
        WHERE DATE(date_applied) BETWEEN :piefromDate AND :pietoDate ";

if ($certificateType !== 'All') {
    $query .= "AND (certificate_name = :certificateType) ";
} elseif ($filterBy !== 'All') {
    $query .= "AND (status = :piestatusType) ";
}

if ($filterBy === 'piestatusType') {
    $query .= "GROUP BY pie_key, status ";
} elseif ($filterBy === 'certificateType') {
    $query .= "GROUP BY week_key, certificate_name ";
}
$query .= "ORDER BY FIELD(pie_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', pie_key),
                    FIELD(status, 'on hold', 'approved', 'rejected', 'claimed', status),
                    FIELD(certificate_name, 'Barangay Clearance', 'Certificate of Residency', 'Certificate of Indigency', 'Business Permit', 'Certificate of Good Moral', 'Certificate of Birth', 'Certificate of Oath Taking', 'First Time Jobseekers', 'Certificate of Live In', 'Barangay Identification', 'Certificate of Death', 'Family Home Estate')";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':piefromDate', $piefromDate);
$stmt->bindParam(':pietoDate', $pietoDate);

if ($certificateType !== 'All') {
    $stmt->bindParam(':certificateType', $certificateType);
} elseif ($filterBy !== 'All') {
    $stmt->bindParam(':piestatusType', $filterBy);
}

$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)) {
    echo "No data available for the selected period.";
    exit();
}

$chartLabels = [];
$chartData = []; 

foreach ($result as $row) {
    $requestCount = round($row['request_count']);
    $pievalueKey = ($filterBy === 'status') ? $row['status'] : $row['certificate_name'];

    $piedateKey = $piedateType === 'weekly' ? $row['pie_key'] : ($piedateType === 'monthly' ? $row['pie_key'] : $row['pie_key']);

    if (!isset($piechartData[$piedateKey])) {
        $piechartData[$piedateKey] = [];
    }
    if (!isset($piechartData[$piedateKey][$pievalueKey])) {
        $piechartData[$piedateKey][$pievalueKey] = 0;
    }
    $piechartData[$piedateKey][$pievalueKey] += $requestCount;

    if (!isset($pietotalValues[$pievalueKey])) {
        $pietotalValues[$pievalueKey] = 0;
    }

    $pietotalValues[$pievalueKey] += $requestCount;
}

$chartLabelsJson = json_encode($chartLabels);
$chartDataJson = json_encode($chartData);
}
?>

<script>
    function displayChart() {
        var chartLabels = <?php echo $chartLabelsJson; ?>;
        var chartData = <?php echo $chartDataJson; ?>;

        if (pierequestData === null || pietotalRequestCounts === null) {
            var errorMessage = "<?php echo isset($errorMessage) ? $errorMessage : ''; ?>";
            var descriptionElement = document.getElementById('description');
            descriptionElement.innerHTML = "<p style='color: red; font-weight: bold; font-size: 16px;'>" + errorMessage + "</p>";
            var canvasElement = document.getElementById('certificateStatusChart');
            canvasElement.style.display = 'none';
            return;
        }

        var piedateKeys = Object.keys(pierequestData);
        var pievalueKeys = Object.keys(pierequestData[piedateKeys[0]]);

        var piedatasets = [];
        pievalueKeys.forEach(function (pievalueKey) {
            var piedata = piedateKeys.map(function (piedateKey) {
                var pievalue = piechartData[piedateKey][pievalueKey] || 0;  
                return Math.round(pievalue);
            });

            piedatasets.push({ 
                label: pievalueKey,
                data: piedata,
                backgroundColor: getRandomColor()
            });
        });

        var ctx = document.getElementById('certificateStatusChart').getContext('2d');
        var piechart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: piedateKeys,
                datasets: piedatasets
            },
            options: {
                maintainAspectRatio: true,
                responsive: true,
                scales: {
                    y: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });

        piedateKeys.forEach(function (piedateKey) {
            pievalueKeys.forEach(function (pievalueKey) {
                var pievalue = piechartData[piedateKey][pievalueKey] || 0;
                piedescription += "<tr><td>" + piedateKey + "</td><td>" + pievalueKey + "</td><td><b>" + pievalue + "</b></td></tr>";
            });
        });
        piedescription += "</table>";

        var piedescriptionElement = document.getElementById('description');
        piedescriptionElement.innerHTML = piedescription;
    }

    window.addEventListener('load', function () {
        displayChart();
    });

    var pieapplyFilterBtn = document.querySelector('.PieapplyFilterBtn');
    pieapplyFilterBtn.addEventListener('click', function (event) {
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



