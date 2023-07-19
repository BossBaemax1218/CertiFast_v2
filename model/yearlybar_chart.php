
<div class="card mr-4 mt-3">
  <div class="card-header">
    <strong>REPORTS</strong>
  </div>
  <div class="card-footer">
    <p class="description" style="font-size: 14px;" id="description"></p>
  </div>
  <div class="card-body">
    <canvas id="myChart3" style="width: 100%; max-width: 1450px; height: 440px;"></canvas>
  </div>
</div>

<?php
include 'server/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

  $fromDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : date('Y-m-d', strtotime('last monday'));
  $toDate = isset($_POST['toDate']) ? $_POST['toDate'] : date('Y-m-d', strtotime('next sunday'));
  $documentType = isset($_POST['documentType']) ? $_POST['documentType'] : 'All';


$query = "SELECT DATE_FORMAT(date, '%W') AS day_name, details, COUNT(*) AS count
          FROM tblpayments
          WHERE date BETWEEN :fromDate AND :toDate
          AND (details = :documentType OR :documentType = 'All')
          GROUP BY day_name, details
          ORDER BY FIELD(day_name, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), day_name";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':fromDate', $fromDate);
$stmt->bindParam(':toDate', $toDate);
$stmt->bindParam(':documentType', $documentType);
$stmt->execute();

$chartData = [];
$totalValues = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dayName = $row['day_name'];
    $documentType = $row['details'];
    $count = $row['count'];

    if (!isset($chartData[$dayName])) {
        $chartData[$dayName] = [];
    }

    $chartData[$dayName][$documentType] = $count;

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
    var chartData = <?php echo $chartDataJson; ?>;
    var totalValues = <?php echo $totalValuesJson; ?>;
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
        scales: {
          y: {
            beginAtZero: true,
            precision: 0
          }
        }
      }
    });


    var description = "Requested Certification: ";
    var documentTypes = Object.keys(totalValues);
    documentTypes.forEach(function(documentType) {
      var value = totalValues[documentType];
      description += " " + documentType + ": " + value + ",";
    });

    var descriptionElement = document.getElementById('description');
    descriptionElement.textContent = description;
  }


  window.addEventListener('load', displayChart);


  var applyFilterBtn = document.getElementById('applyFilterBtn');
  applyFilterBtn.addEventListener('click', function(event) {
    event.preventDefault(); 

    var form = document.querySelector('form');
    form.submit();

    displayChart();
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

  var title = "Overview Reports";
  doc.setFontSize(18);
  doc.text(title, 10, 10);

  var currentDate = new Date().toLocaleDateString();
  doc.setFontSize(12);
  doc.text("Date: " + currentDate, 10, 20);

  html2canvas(chartRow).then(function (canvas) {
    var imgData = canvas.toDataURL("image/png");
    doc.addImage(imgData, "PNG", 10, 50, 200, 0);

    doc.save("chart.pdf");
  });
});
</script>