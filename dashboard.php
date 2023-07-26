<?php include 'server/server.php';
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Overview - Dashboard</title>
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
</head>
<body>

<div class="wrapper">
    <?php include 'templates/main-header.php' ?>
    <?php include 'templates/sidebar.php' ?>
            <div class="main-panel">
                <div class="content d-flex flex-column">
                    <div class="panel-header d-flex flex-column mt-1">
                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif ?>
                        <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                        <div class="container mt-3">
                            <h3 class="fw-bold mb-4" style="font-size: 400%;">Overview</h3>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row mb-3 ml-2">
                                    <div class="col-sm-12 col-md-2 mb-2">
                                        <label for="fromDate">From:</label>
                                        <input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo isset($_POST['fromDate']) ? htmlspecialchars($_POST['fromDate']) : date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-sm-12 col-md-2 mb-2">
                                        <label for="toDate">To:</label>
                                        <input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo isset($_POST['toDate']) ? htmlspecialchars($_POST['toDate']) : date('Y-m-d'); ?>">
                                    </div>
                                    <div class="col-sm-12 col-md-2 mb-2">
                                        <label for="dateType">Date Type:</label>
                                        <select class="form-control" id="dateType" name="dateType">
                                            <option value="weekly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'weekly') echo 'selected'; ?>>By Week</option>
                                            <option value="monthly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'monthly') echo 'selected'; ?>>By Month</option>
                                            <option value="yearly" <?php if (isset($_POST['dateType']) && $_POST['dateType'] === 'yearly') echo 'selected'; ?>>By Year</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mb-2">
                                        <label for="documentType">Document Type:</label>
                                        <select class="form-control" id="documentType" name="documentType">
                                            <option value="All" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'All') echo 'selected'; ?>>All</option>
                                            <option value="Barangay Clearance Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Barangay Clearance Payment') echo 'selected'; ?>>Barangay Clearance</option>
                                            <option value="Certificate of Residency Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Residency Payment') echo 'selected'; ?>>Certificate of Residency</option>
                                            <option value="Certificate of Indigency Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Certificate of Indigency Payment') echo 'selected'; ?>>Certificate of Indigency</option>
                                            <option value="Business Permit Payment" <?php if (isset($_POST['documentType']) && $_POST['documentType'] === 'Business Permit Payment') echo 'selected'; ?>>Business Permit</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mt-3">
                                        <button type="submit" class="btn btn-primary" id="applyFilterBtn">Apply Filter</button>
                                        <button type="button" class="btn btn-danger ml-3" id="pdfExportBtn">Export</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row md-5">
                                <div class="col-md-12">
                                    <div class="chart-wrapper">
                                        <?php include 'model/chart.php' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                    <?php if(isset($_SESSION['username']) && $_SESSION['role']=='purok leader'):?>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="card card-stats card card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user-clock fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Pending</h2>
                                                    <h3 class="fw-bold" style="font-size: 35px; color: #C77C8D;"><?= number_format($pendingCount) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card card-round" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user-check fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Approved</h2>
                                                    <h3 class="fw-bold" style="font-size: 35px; color: #C77C8D;"><?= number_format($approvedCount)?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=revenue" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user-alt-slash fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Rejected</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 35px; color: #C77C8D;"><?= number_format($rejectedCount) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                              <div class="table-responsive">
                                  <table id="residenttable" class="table">
                                      <thead>
                                          <tr>
                                              <th scope="col">Fullname</th>
                                              <th scope="col">Address</th>
                                              <th scope="col">Birthdate</th>
                                              <th scope="col">Age</th>
                                              <th scope="col">Gender</th>
                                              <th scope="col">Email</th>
                                              <th scope="col">Purok</th>
                                              <th scope="col">Status</th>
                                          </tr>
                                      </thead>
                                      <tbody>                                           
                                      <?php if (!empty($resident)): ?>
                                          <?php $no = 1; foreach ($resident as $row): ?>
                                              <tr>
                                                  <td>
                                                      <div class="avatar avatar-xs ml-3">
                                                          <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/'.$row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                      </div>
                                                      <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                  </td>
                                                  <td><?= $row['address'] ?></td>
                                                  <td><?= $row['birthdate'] ?></td>
                                                  <td><?= $row['age'] ?></td>
                                                  <td><?= $row['gender'] ?></td>
                                                  <td><?= $row['email'] ?></td>
                                                  <td><?= $row['purok'] ?></td>
                                                  <td class="text-center"><?= $row['residency_badge'] ?></td>
                                              </tr>
                                          <?php $no++; endforeach ?>
                                      <?php endif ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <?php endif ?>
            </div>
        <?php include 'templates/main-footer.php' ?>
    </div>
<?php include 'templates/footer.php' ?>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
	<script>
    document.getElementById("pdfExportBtn").addEventListener("click", function () {
      var doc = new jsPDF();
      var chartRow = document.getElementById("chartRow");
      var fromDate = document.getElementById("fromDate").value;
      var toDate = document.getElementById("toDate").value;
      var documentType = document.getElementById("documentType").value;

      var title = "Overview Chart Visualization Reports";
      doc.setFontSize(18);
      doc.text(title, 10, 10);

      var currentDate = new Date().toLocaleDateString();
      doc.setFontSize(12);
      doc.text("Latest Date: " + currentDate, 10, 20);
      doc.text("Date: " + fromDate + " to " + toDate, 10, 30);
      doc.text("Document Type: " + documentType, 10, 40);

      var width = 180;
      var height = 120;

      html2canvas(chartRow, { scale: 2 }).then(function (canvas) {
        var imgData = canvas.toDataURL("image/png");
        doc.addImage(imgData, "PNG", 10, 50, width, height);

        doc.save("dashboard-chart.pdf");
      });
    });
</script>
</body>
</html>