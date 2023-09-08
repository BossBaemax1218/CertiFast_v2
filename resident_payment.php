<?php
include 'server/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>                  
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
        <?php include 'templates/main-header-resident.php' ?>
            <?php include 'templates/sidebar-resident.php' ?>
		    <div class="main-panel">
			    <div class="content">
                    <div>
                        <h1 class="text-center fw-bold mt-4" style="font-size: 300%;">Payments History</h1>
                        <h4 class="text-center">This is the list of all of your payments in Barangay Los Amigos CertiFast Portal.</h4>
                    </div>
                    <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                    <div class="page-inner">
                        <div class="content">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title"></div>
                                            <div class="card-tools">
                                                <a class="btn btn-light btn-border btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Filter
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
                                        </div>
                                    </div>
                                        <div class="card-body">
                                            <div class="table-responsive mt-3">
                                                <?php
                                                $user_name = $_SESSION['fullname'];
                                                $paymentHistoryQuery = "SELECT * FROM tblpayments AS p
                                                                        JOIN tbl_user_resident AS u ON p.email = u.user_email
                                                                        WHERE u.fullname = ?
                                                                        ORDER BY p.date DESC";
                                                $stmt = $conn->prepare($paymentHistoryQuery);
                                                $stmt->bind_param("s", $user_name);
                                                $stmt->execute();
                                                $paymentHistoryResult = $stmt->get_result();
                                                
                                                function getStatusBadge($status) {
                                                    if ($status == 'paid') {
                                                        return '<span class="badge badge-success">Paid</span>';
                                                    }
                                                    return '';
                                                }
                                                ?>
                                                
                                                <?php if ($paymentHistoryResult->num_rows > 0): ?>
                                                    <table id="" class="residenttable table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Transaction ID</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Recipient</th>
                                                                <th scope="col">Details</th>
                                                                <th scope="col">Amount</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while ($row = $paymentHistoryResult->fetch_assoc()): ?>
                                                                <tr>
                                                                    <td><?= $row['trans_id'] ?></td>
                                                                    <td><?= $row['date'] ?></td>
                                                                    <td><?= $row['name'] ?></td>
                                                                    <td><?= $row['details'] ?></td>
                                                                    <td><i class="fas fa-peso-sign"></i> <?= number_format($row['amounts'], 2) ?></td>
                                                                    <td><?= getStatusBadge($row['status']) ?></td>
                                                                </tr>
                                                            <?php endwhile; ?>
                                                        </tbody>
                                                    </table>
                                                <?php else: ?>
                                                    <p class="text-center">No payment history available</p>
                                                <?php endif; ?>
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
</body>
</html>