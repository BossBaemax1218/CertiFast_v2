<?php include 'server/server.php' ?>
<?php 
    $query = "SELECT COUNT(certificate_name) as de FROM tblresident_requested WHERE status='claimed'"; 
    $revenue1 = $conn->query($query)->fetch_assoc();

    $sql1 = "SELECT COUNT(DISTINCT email) as receipt FROM tblpayments";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $receiptCount = $row1['receipt'];

	$query2 = "SELECT SUM(amounts) as am FROM tblpayments ORDER BY `date` DESC";
	$revenue3 = $conn->query($query2)->fetch_assoc();

    $sql = "SELECT * FROM tblpayments WHERE status='paid'";
    $result = $conn->query($sql);

    $revenue = array();
	while($row = $result->fetch_assoc()){
		$status = $row['status'];
        $statusBadge = '';
    
        if ($status == 'paid') {
            $statusBadge = '<span class="badge badge-pill badge-success">Paid</span>';
        }
    
        $row['trans_badge'] = $statusBadge;
    
        if ($status == 'paid') {
            $revenue[] = $row;
        }
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>                 
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/header.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
					<div class="page-inner mt-2">
                        <div class="panel-header">
                            <div class="page-inner">
                                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                    <div>
                                        <h1 class="text-center fw-bold" style="font-size: 300%;">Transaction Reports</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-stats card card-round">
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
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Recipient</h2>
                                                    <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($receiptCount) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=all" class="card-link text" style="color: gray;"></a>
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
                                                    <i class="fa-solid fa-peso-sign fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Payments</h2>
                                                    <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($revenue3['am'],2)?></h3>
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
                                                    <i class="fa fa-check fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Claimed</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($revenue1['de']) ?></h3>
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
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
					</div>
                    <div class="page-inner">
                    <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title"></div>
                                            <?php if(isset($_SESSION['username'])):?>
                                            <div class="card-tools">
                                                <a id="pdf" class="btn btn-danger btn-border btn-round btn-sm">
                                                    <i class="fas fa-download"></i>
                                                     Export PDF
                                                </a>
                                                <a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Filter Options
                                                </a>
                                                <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
                                                    <div class="dropdown-item">
                                                        <label>Select types of Certificates:</label>
                                                        <select class="form-control" id="filterCert" name="cert_name" onclick="event.stopPropagation();">
                                                            <option value="">Show All</option>
                                                            <option value="Barangay Clearance">Barangay Clearance</option>
                                                            <option value="Business Permit">Business Permit</option>
                                                            <option value="Barangay Identification">Barangay Identification (ID)</option>
                                                            <option value="Certificate of Residency">Certificate of Residency</option>
                                                            <option value="Certificate of Indigency">Certificate of Indigency</option>
                                                            <option value="First Time Jobseekers">First Time Jobseekers</option>
                                                            <option value="Certificate of Oath Taking">Certificate of Oath Taking</option>
                                                            <option value="Certificate of Death">Certificate of Death</option>
                                                            <option value="Certificate of Birth">Certificate of Birth</option>
                                                            <option value="Certificate of Good Moral">Certificate of Good Moral</option>
                                                            <option value="Certificate of Live In">Certificate of Live In</option>
                                                            <option value="Family Home Estate">Family Home Estate</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>From Date:</label>
                                                        <input type="date" class="form-control datepicker" id="fromDate" placeholder="Select date range">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>To Date:</label>
                                                        <input type="date" class="form-control datepicker" id="toDate" placeholder="Select date range">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <button type="button" id="clearFilters" class="form-control btn btn-outline-primary">Clear Filters</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive mt-3">
                                                <table id="residenttable" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">Transaction ID</th>
                                                            <th class="text-center" scope="col">Date</th>
                                                            <th scope="col">Recipient</th>
                                                            <th scope="col">Details</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Cashier</th>
                                                            <th scope="col">Status</th>
                                                            <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'administrator')):?>
                                                            <th scope="col">Action</th>
                                                            <?php endif ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($revenue)) : ?>
                                                            <?php $no = 1;
                                                            foreach ($revenue as $row) : ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $row['trans_id'] ?></td>
                                                                    <td class="text-center"><?= $row['date'] ?></td>
                                                                    <td><?= $row['name'] ?></td>
                                                                    <td><?= $row['details'] ?></td>
                                                                    <td> <i class="fa-solid fa-peso-sign"></i> <?= number_format($row['amounts'], 2) ?></td>
                                                                    <td><?= $row['user'] ?></td>
                                                                    <td><?= $row['trans_badge'] ?></td>
                                                                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'administrator')):?>
                                                                    <td class="text-center">
                                                                        <div class="input-group">
                                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                                <i class="fa-solid fa-trash"></i>   Remove
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                <?php endif ?>
                                                                </tr>
                                                            <?php $no++;
                                                            endforeach ?>
                                                        <?php endif ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<?php include 'templates/main-footer.php' ?>
	        </div>
	    </div>
	<?php include 'templates/footer.php' ?>
	<?php foreach ($revenue as $row) { ?>
        <div class="modal fade" id="confirmDeleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="font-size: 16px;">
                        Are you certain you want to removed transaction no. <strong><?= $row['trans_id'] ?></strong>?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/trash_trans_records.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const filterCert = document.getElementById("filterCert");
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const certValue = filterCert.value.toLowerCase();
    const rowCert = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
    const rowDate = new Date(row.querySelector("td:nth-child(2)").textContent);
    const from = new Date(fromDate.value);
    const to = new Date(toDate.value);

    return (certValue === "" || rowCert.includes(certValue)) &&
           (isNaN(from) || rowDate >= from) &&
           (isNaN(to) || rowDate <= to);
  }
  
  function applyFilter() {
    tableRows.forEach(row => {
      const shouldDisplay = rowMatchesFilter(row);
      row.style.display = shouldDisplay ? "table-row" : "none";
    });
  }

  function clearFilters() {
    filterCert.value = "";
    fromDate.value = "";
    toDate.value = "";
    applyFilter();
  }

  filterCert.addEventListener("change", applyFilter);
  fromDate.addEventListener("change", applyFilter);
  toDate.addEventListener("change", applyFilter);
  clearFiltersBtn.addEventListener("click", clearFilters);
});
</script>
    <script>
        $(document).on("click", "#pdf", function () {
        console.log("Exporting revenue table as PDF...");

        const currentDate = new Date().toISOString().slice(0, 10);

        const title = "Transaction Reports - " + currentDate;
        const filename = "Transaction_" + currentDate + ".pdf";

        const doc = new jsPDF();

        doc.setFontSize(20);
        doc.text(title, 15, 15);

        const options = { startY: 25 };
        doc.autoTable({ html: "#residenttable", startY: 30 });

        doc.save(filename);
        });
    </script>
</body>
</html>