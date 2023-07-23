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

<?php if(isset($_SESSION['username']) && ($_SESSION['role'] == 'staff')): ?>
                    <li class="nav-item">
                        <a href="#announcement" data-toggle="modal">
                            <i class='fas fa-bullhorn'></i>
                            <p>Post Announcement</p>
                        </a>
                    </li>
                <?php else: ?>

                  if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: dashboard.php");
    exit;
}
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "staff") {
    header("Location: dashboard.php");
    exit;
}
if (!isset($_SESSION["fullname"]) || $_SESSION["role"] !== "resident") {
    header("Location: resident_dashboard.php");
    exit;
}


// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION["username"]) || !isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

// Check the user's role and redirect accordingly
if ($_SESSION["role"] === "admin") {
    header("Location: dashboard.php");
    exit;
} elseif ($_SESSION["role"] === "staff") {
    header("Location: dashboard.php");
    exit;
} elseif ($_SESSION["role"] === "purok leader") {
    header("Location: purok_dashboard.php");
    exit;
} elseif ($_SESSION["role"] === "resident") {
    header("Location: resident_dashboard.php");
    exit;
}

<!-- Modal -->
<div class="modal fade" id="term" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Term of Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="form-group form-floating-label">
                        <h3>Barangay Los Amigos - Certifast Portal! </h3>
                        <span>Please read these Terms of Services carefully before accessing or using the online certificate management system.</span>
                        <ul class="mt-2">
                            <li>
                                <label>Account Registration</label>
                                <p>1.1 You must create an account to access and use the CertiFast Portal. You agree to provide accurate and complete information during the registration process and keep your account credentials confidential.</p>
                                <p>1.2 You are responsible for all activities that occur under your account, and you must immediately notify Barangay Los Amigos of any unauthorized use or security breach of your account.</p>
                            </li>
                            <li>
                                <label>Use of the CertiFast Portal</label>
                                <p>2.1 The CertiFast Portal allows registered users to request, manage, and access various certificates and related documents issued by Barangay Los Amigos.</p>
                                <p>2.2 You agree to use the CertiFast Portal only for lawful purposes and in compliance with all applicable laws and regulations.</p>
                                <p>2.3 You are solely responsible for the accuracy and legality of the information you provide when using the CertiFast Portal.</p>
                                <p>2.4 You must not use the CertiFast Portal to:</p>
                                <p>a) Transmit any viruses, malware, or other malicious code.</p>
                                <p>b) Interfere with or disrupt the operation of the CertiFast Portal or its underlying infrastructure.</p>
                                <p>c) Collect or store personal information of other users without their consent.</p>
                                <p>d) Engage in any activity that could harm or damage the reputation of Barangay Los Amigos or its officials.</p>
                            </li>
                            <li>
                                <label>Certificate Requests and Processing</label>
                                <p>3.1 The CertiFast Portal allows you to submit requests for certificates electronically.</p>
                                <p>3.2 While Barangay Los Amigos aims to process certificate requests promptly, it does not guarantee the issuance or processing timeframes.</p>
                                <p>3.3 Barangay Los Amigos reserves the right to reject or cancel any certificate request if it determines, in its sole discretion, that the request violates applicable laws, regulations, or these ToS.</p>
                                <p>3.4 You understand that the issuance of certificates is subject to the verification of the provided information, and any false or misleading information may result in the rejection or revocation of the certificate.</p>
                            </li>
                            <li>
                                <label>Intellectual Property</label>
                                <p>4.1 The CertiFast Portal, including its content and any intellectual property rights therein, is owned by Barangay Los Amigos.
                                <p>4.2 You agree not to reproduce, modify, distribute, or create derivative works based on the CertiFast Portal or any of its content without the prior written consent of Barangay Los Amigos.</p>
                            </li>
                            <li>
                                <label>Use of the Certifast Portal</label>
                                <p>The Certifast Portal is provided to facilitate the management and issuance of certificates by the Barangay Los Amigos authorities. You may use the system to apply for, track, and obtain various certificates as required by the barangay.</p>
                            </li>
                            <li>
                                <label>Limitation of Liability</label>
                                <p>5.1 Barangay Los Amigos shall not be liable for any direct, indirect, incidental, consequential, or exemplary damages arising out of or in connection with your use of the CertiFast Portal.</p>
                                <p>5.2 You agree to indemnify and hold Barangay Los Amigos and its officials harmless from any claims, losses, damages, liabilities, costs, and expenses arising from your use of the CertiFast Portal.</p>
                            </li>
                            <li>
                                <label>Modification and Termination</label>
                                <p>6.1 Barangay Los Amigos may modify, suspend, or terminate the CertiFast Portal or your access to it at any time, without prior notice and for any reason.</p>
                                <p>6.2 These ToS will remain in effect even after your access to the CertiFast Portal is terminated.</p>
                            </li>
                            <li>
                                <label>Governing Law and Jurisdiction</label>
                                <p>7.1 These ToS shall be governed by and construed in accordance with the laws of the Philippines</p>
                                <p>7.2 Any disputes arising out of or in connection with these ToS shall be subject to the exclusive jurisdiction of the courts of the Philippines.</p>
                                <p><b>These are just a few key legal considerations related to online certificate management systems in the Philippines.</b></p>
                                <p>In the Philippines, the primary legislation governing data privacy and protection is the Data Privacy Act of 2012 (Republic Act No. 10173) and its implementing rules and regulations. It sets out the rights of individuals regarding the collection, use, processing, and disclosure of personal information. If your online certificate management system collects and processes personal data, it is important to comply with the requirements of the Data Privacy Act, including obtaining proper consent, implementing security measures, and ensuring the rights of data subjects.</p>
                                <p>The Electronic Commerce Act of 2000 (Republic Act No. 8792) governs electronic transactions and electronic signatures in the Philippines. It provides a legal framework for the recognition and validity of electronic documents, contracts, and signatures. If your online certificate management system involves electronic transactions, it's important to ensure compliance with the Electronic Commerce Act.</p>
                                <p>The Cybercrime Prevention Act of 2012 (Republic Act No. 10175) addresses cybersecurity concerns and criminalizes various forms of cybercrime, such as hacking, identity theft, and unauthorized access to computer systems. Implementing appropriate security measures to protect the integrity and confidentiality of the online certificate management system's data is crucial.</p>
                                <p>Intellectual property rights may apply to the content, software, or design of your online certificate management system. It's important to ensure that you have the necessary licenses or permissions for any copyrighted material used, and to respect the intellectual property rights of others.</p>
                            </li>
                            <li>
                                <label>Modification and Termination</label>
                                <p>6.1 Barangay Los Amigos may modify, suspend, or terminate the CertiFast Portal or your access to it at any time, without prior notice and for any reason.</p>
                                <p>6.2 These ToS will remain in effect even after your access to the CertiFast Portal is terminated.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeModalButton">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="policy" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRIVACY POLICY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="form-group form-floating-label">
                        <h3>Barangay Los Amigos - Certifast Portal! </h3>
                        <span>Thank you for using the Barangay Los Amigos - CertiFast Portal. This Privacy Policy explains how we collect, use, and disclose your personal information when you access and use our online certificate management system. By using the CertiFast Portal, you consent to the practices described in this Privacy Policy.</span>
                        <ul class="mt-2">
                            <li>
                                <label>Information We Collect</label>
                                <p>By accessing or using the Certifast Portal, you agree to be bound by these Terms of Use. If you do not agree to these terms, please refrain from using the system.</p>
                            </li>
                            <li>
                                <label>Use of the Certifast Portal</label>
                                <p>1.1 Personal Information: When you create an account on the CertiFast Portal, we collect certain personal information such as your name, email address, contact number, and other relevant details necessary for the issuance and management of certificates.</p>
                                <p>1.2  Usage Information: We may collect information about your use of the CertiFast Portal, including your IP address, browser type, operating system, and pages visited, to improve our services and user experience.</p>
                                <p>1.3 Cookies: We may use cookies and similar technologies to collect information and enhance your user experience. You can manage your cookie preferences through your browser settings.</p>
                            </li>
                            <li>
                                <label>Use of Information</label>
                                <p>2.1 We use the collected information to:</p>
                                <p>a. Provide and maintain the CertiFast Portal and its services.</p>
                                <p>b. Process and manage certificate requests and related documents.</p>
                                <p>c. Communicate with you regarding your account, updates, and notifications.</p>
                                <p>d.  Improve and personalize the CertiFast Portal and user experience.</p>
                                <p>2.2 We may also use the information in an aggregated and de-identified form for statistical analysis and research purposes.</p>
                            </li>
                            <li>
                                <label>Information Sharing and Disclosure</label>
                                <p>3.1 We may share your personal information with:</p>
                                <p>a. Barangay Los Amigos officials and personnel involved in the issuance and management of certificates.</p>
                                <p>b. Service providers and contractors who assist us in operating the CertiFast Portal and providing related services.</p>
                                <p>3.2 We may disclose your personal information if required by law, regulation, or legal process, or to protect our rights, property, or safety, or that of others.</p>
                            </li>
                            <li>
                                <label>Data Security</label>
                                <p>4.1 We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, loss, or alteration.</p>
                                <p>4.2 However, please note that no data transmission or storage system is entirely secure. We cannot guarantee the absolute security of your information.</p>
                            </li>
                            <li>
                                <label>Data Retention</label>
                                <p>5.1 We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law.</p>
                            </li>
                            <li>
                                <label>Your Rights</label>
                                <p>6.1 You have the right to access, update, and correct your personal information stored in the CertiFast Portal. You may also request the deletion of your account and personal data, subject to applicable laws.</p>
                                <p>6.2 For inquiries or requests related to your personal information, please contact us using the contact details provided at the end of this Privacy Policy.</p>
                            </li>
                            <li>
                                <label>Changes to this Privacy Policy</label>
                                <p>7.1 We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the updated Privacy Policy on the CertiFast Portal or by other means of communication.</p>
                            </li>
                            <li>
                                <label>Contact Us</label>
                                <p>If you have any questions, concerns, or requests regarding this Privacy Policy, please contact us at losamigosdavaocity.gov@gmail.com and (082) 228-8984.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="closeModalButton">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
session_start();
include '../server/db_connect.php';

function deleteAccount($connection, $email)
{
    $email = mysqli_real_escape_string($connection, $email);

    $query = "DELETE u.*, r.* FROM tbl_user_resident AS u 
              JOIN tblresident AS r ON u.user_email = r.email
              WHERE u.user_email = '$email'";

    if (mysqli_query($connection, $query)) {

        return true;
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $result = deleteAccount($connection, $email);
        if ($result) {
            session_destroy();
            header('Location: ../index.php');
            exit();
        } else {
            header('Location: ../resident_dashboard.php');
            exit();
        }
    } else {
        header('Location: ../resident_dashboard.php');
        exit();
    }
}

mysqli_close($connection);
?>

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
                $errorMessage = "Invalid date type selected.";
                $conn->close();
                break;
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

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }
</script>
var mostCertDataLastMonth = <?php echo $mostCertJsonLastMonth; ?>;
            var allDocumentsDataLastMonth = <?php echo $allDocumentsJsonLastMonth; ?>;

$mostCertSqlLastMonth = "SELECT details, COUNT(*) AS count
                                FROM tblpayments
                                WHERE date BETWEEN :lastFirstDayOfMonth AND :currentDate
                                GROUP BY details
                                ORDER BY count DESC
                                LIMIT 10";
        $mostCertStmtLastMonth = $pdo->prepare($mostCertSqlLastMonth);
        $mostCertStmtLastMonth->bindParam(':lastFirstDayOfMonth', $lastFirstDayOfMonth);
        $mostCertStmtLastMonth->bindParam(':currentDate', $currentDate);
        $mostCertStmtLastMonth->execute();

        $mostCertDataLastMonth = $mostCertStmtLastMonth->fetchAll(PDO::FETCH_ASSOC);

        $allDocumentsSqlLastMonth = "SELECT details, COUNT(*) AS count
                                    FROM tblpayments
                                    WHERE date BETWEEN :lastFirstDayOfMonth AND :currentDate
                                    GROUP BY details";
        $allDocumentsStmtLastMonth = $pdo->prepare($allDocumentsSqlLastMonth);
        $allDocumentsStmtLastMonth->bindParam(':lastFirstDayOfMonth', $lastFirstDayOfMonth);
        $allDocumentsStmtLastMonth->bindParam(':currentDate', $currentDate);
        $allDocumentsStmtLastMonth->execute();

        $allDocumentsDataLastMonth = $allDocumentsStmtLastMonth->fetchAll(PDO::FETCH_ASSOC);

        $mostCertJsonLastMonth = json_encode($mostCertDataLastMonth);
        $allDocumentsJsonLastMonth = json_encode($allDocumentsDataLastMonth);



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
            $conn->close();
            exit();
        }

        $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : $firstDayOfMonth;
        $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : $currentDate;
        $documentType = isset($_POST['documentType']) ? $_POST['documentType'] : 'All';
        switch ($dateType) {
            case 'weekly':
                // Calculate the start and end of the week for the given date
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
                $sql = "SELECT details AS date_key, COUNT(*) AS count
                        FROM tblpayments
                        WHERE date BETWEEN :fromDate AND :toDate
                        GROUP BY details
                        ORDER BY count DESC
                        LIMIT 10";
                break;
            default:
                $errorMessage = "Invalid date type selected."; 
                $conn->close();
                break;
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':fromDate', $fromDate);
        $stmt->bindParam(':toDate', $toDate);
        if ($dateType === 'weekly' || $dateType === 'mostcert') {
            // Bind the :documentType parameter for weekly and mostcert cases
            $stmt->bindParam(':documentType', $documentType);
        }
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $chartData = [];
        $totalValues = [];
        foreach ($result as $row) {
            $count = $row['count'];
        
            if ($dateType === 'mostcert') {
                $documentType = $row['date_key'];
                $dateKey = $documentType; 
            } else {
                $dateKey = $dateType === 'weekly' ? "" . $row['date_key'] : ($dateType === 'monthly' ? date('F', mktime(0, 0, 0, $row['date_key'], 1)) : $row['date_key']);
                $documentType = $row['details']; 
            }
        
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

        $sql = "SELECT ";
        if ($dateType === 'weekly') {
            $sql .= "DATE_FORMAT(date, '%W') AS date_key, ";
        } elseif ($dateType === 'monthly') {
            $sql .= "DATE_FORMAT(date, '%Y-%m') AS date_key, ";
        } elseif ($dateType === 'yearly') {
            $sql .= "DATE_FORMAT(date, '%Y') AS date_key, ";
        } elseif ($dateType === 'mostcert') {
            $sql .= "CASE WHEN details = 'All' THEN 'All' ELSE details END AS date_key, ";
        }
        $sql .= "details, COUNT(*) AS count
                FROM tblpayments
                WHERE DATE(date) BETWEEN :fromDate AND :toDate ";
        
        if ($documentType !== 'All') {
            $sql .= "AND (details = :documentType OR (details = 'All' AND :documentType = 'All')) ";
        } else {
            $sql .= "AND (details IN ('Barangay Clearance Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment', 'Business Permit Payment', 'All')) ";
        }

        if ($dateType === 'weekly' || $dateType === 'mostcert') {
            $sql .= "GROUP BY date_key, details ";
            
            if ($dateType === 'weekly') {
                $sql .= "ORDER BY FIELD(date_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', date_key), FIELD(details, 'Barangay Clearance Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment', 'Business Permit Payment', 'All')";
            } elseif ($dateType === 'mostcert') {
                $sql .= "ORDER BY FIELD(details, 'Barangay Clearance Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment', 'Business Permit Payment', 'All'), date_key";
            }
        } elseif ($dateType === 'monthly') {
            $sql .= "GROUP BY date_key, details ";
            $sql .= "ORDER BY date_key, FIELD(details, 'Barangay Clearance Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment', 'Business Permit Payment', 'All')";
        } else {
            $sql .= "GROUP BY date_key, details";
        }

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

            $dateKey = $dateType === 'mostcert' ? $documentType : ($dateType === 'weekly' ? "" . $row['date_key'] : ($dateType === 'monthly' ? date('F', mktime(0, 0, 0, (int)substr($row['date_key'], 5), 1)) : $row['date_key']));

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
            if (documentType === "Most Requested") {
                var data = days.map(function(day) {
                    return chartData[day]["Most Requested"] || 0;
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

<?php
include 'server/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$chartDataJson = "null";
$totalValuesJson = "null";

$currentDate = date('Y-m-d');
$lastMonday = date('Y-m-d', strtotime('last Monday'));

// Fetch chart data for the last Monday date and the current date without filtering
// Set the dateType to 'weekly' to get data for the week
$dateType = 'weekly';

$fromDate = $lastMonday;
$toDate = $currentDate;
$documentType = 'All'; // Set documentType to 'All' to get data for all document types

$sql = "SELECT ";
if ($dateType === 'weekly') {
    $sql .= "CONCAT('Week ', WEEK(date), ', ', DATE_FORMAT(date, '%W')) AS date_key, ";
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
$sql .= "ORDER BY FIELD(date_key, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', date_key), FIELD(details, 'Barangay Clearance Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment', 'Business Permit Payment')";

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
        $documentTypes = ['Certificate of Indigency Payment', 'Barangay Clearance Payment', 'Certificate of Residency Payment', 'Business Permit Payment'];
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
            descriptionElement.innerHTML = "<p style='color: red; font-weight: bold;'>" + errorMessage + "</p>";
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

        var description = "<table><tr><th>The number of Requested Certification</th><th>Total</th></tr>";
        documentTypes.forEach(function(documentType) {
            var value;
            if (documentType === "All") {
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

