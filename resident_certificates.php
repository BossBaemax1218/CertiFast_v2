<?php 
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["user_email"];

$sql = "SELECT *,s.cert_id, s.certificate_name, s.status, s.date_applied 
        FROM tblresident_requested AS s JOIN tbl_user_resident AS u ON u.user_email = s.email JOIN
		tblresident AS r ON r.email=s.email WHERE u.user_email = ? AND s.status IN ('on hold','approved','rejected','claimed')
		AND r.residency_status='approved'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();

$resident = array();
$approvedResidents = array();

while ($row = $result->fetch_assoc()) {
    $status = $row['status'];

    $statusBadge = '';
    if ($status == 'on hold') {
        $statusBadge = '<span class="badge badge-warning">On Hold</span>';
    } elseif ($status == 'approved') {
        $statusBadge = '<span class="badge badge-success">Approved</span>';
    } elseif ($status == 'rejected') {
        $statusBadge = '<span class="badge badge-danger">Rejected</span>';
    }elseif ($status == 'claimed') {
        $statusBadge = '<span class="badge badge-info">Claimed</span>';
    }

    $row['residency_badge'] = $statusBadge;
	if ($status == 'on hold') {
        $resident[] = $row;
		
    } elseif ($status == 'approved') {
        $resident[] = $row;
    }elseif ($status == 'rejected') {
        $resident[] = $row;
    }elseif ($status == 'claimed') {
        $resident[] = $row;
    }
}

$stmt->close();

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
		<div class="main-panel mt-4">
			<div class="content">
				<div class="panel-header">
                    <div class="text-center mb-3">
                        <h1 class="text-center fw-bold mt-3" style="font-size: 300%;">Certification Requested</h1>
                        <h3 class="text-center mt-2"> This is the list of the requested certifications transaction with CertiFast Portal. </h3>
                    </div>
				</div>
				<div class="page-inner">
					<div class="row mt-2">
						<div class="col-md-12">
						<?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
							<div class="p-2 mb-2 bg-info text-white">
								<h5 class="text-left mt-2"><i class="fas fa-exclamation-circle"></i>  If you've ever wondered why a certain certificate you requested did not appear, it's probably because you haven't registered your personal data and haven't received your <strong>Purok Leader's</strong> prior approval. </h5>
							</div>
                            <div class="card">
									<div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title"></div>
                                            <div class="card-tools">
											<a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Filter Options
                                                </a>
                                                <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
                                                    <div class="dropdown-item">
                                                        <label>Request Status:</label>
                                                        <select class="form-control" id="filterStatus" name="status" onclick="event.stopPropagation();">
                                                            <option value="">All</option>
                                                            <option value="on hold">On Hold</option>
                                                            <option value="approved">Approved</option>
                                                            <option value="claimed">Claimed</option>
															<option value="rejected">Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>Select types of Certificates:</label>
                                                        <select class="form-control" id="filterCert" name="cert_name" onclick="event.stopPropagation();">
                                                            <option value="">Show All</option>
                                                            <option value="Barangay Clearance">Barangay Clearance</option>
                                                            <option value="Barangay identification">Barangay Identification (ID)</option>
                                                            <option value="Certificate Of Residency">Certificate of Residency</option>
                                                            <option value="Certificate Of Indigency">Certificate of Indigency</option>
                                                            <option value="First Time Jobseekers">First Time Jobseekers</option>
                                                            <option value="Certificate Of Oath Taking">Certificate of Oath Taking</option>
                                                            <option value="Certificate Of Death">Certificate of Death</option>
                                                            <option value="Certificate Of Birth">Certificate of Birth</option>
                                                            <option value="Certificate Of Good Moral">Certificate of Good Moral</option>
                                                            <option value="Certificate Of Live In">Certificate of Live In</option>
                                                            <option value="Family Home Estate">Family Home Estate</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>From Date:</label>
                                                        <input type="date" class="form-control" id="fromDate" name="fromDate" placeholder="Select date range">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>To Date:</label>
                                                        <input type="date" class="form-control" id="toDate" name="toDate" placeholder="Select date range">
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <button type="button" id="clearFilters" class="form-control btn btn-outline-primary">Clear Filters</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<div class="card-body">
									<div class="table-responsive">
                                    <table id="" class="residenttable table">
											<thead>
												<tr class="text-center">
												    <th scope="col">Certificate ID</th>
													<th scope="col">Date Applied</th>
													<th scope="col">Name</th>
													<th scope="col">Certificates</th>
													<th scope="col">Purpose</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php foreach($resident as $row): ?>
													<tr class="text-center">
													    <td><?= ucwords($row['req_cert_id']) ?></td>
														<td><?= ucwords($row['date_applied']) ?></td>
														<td><?= ucwords($row['resident_name']) ?></td>
														<td><?= ucwords($row['certificate_name']) ?></td>
														<td><?= ucwords($row['requirement']) ?></td>
														<td class="text-center"><?= $row['residency_badge'] ?></td>	
													</tr>
													<?php endforeach ?>
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
	<script>
document.addEventListener("DOMContentLoaded", function () {
  const filterStatus = document.getElementById("filterStatus");
  const filterCert = document.getElementById("filterCert");
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll(".residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const statusValue = filterStatus.value.toLowerCase();
    const certValue = filterCert.value.toLowerCase();
    const rowStatus = row.querySelector("td:nth-child(6)").textContent.toLowerCase();
    const rowCert = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
    const rowDate = new Date(row.querySelector("td:nth-child(2)").textContent);
    const from = new Date(fromDate.value);
    const to = new Date(toDate.value);

    return (statusValue === "" || rowStatus.includes(statusValue)) &&
           (certValue === "" || rowCert.includes(certValue)) &&
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
    filterStatus.value = "";
    filterCert.value = "";
    fromDate.value = "";
    toDate.value = "";
    applyFilter();
  }

  filterStatus.addEventListener("change", applyFilter);
  filterCert.addEventListener("change", applyFilter);
  fromDate.addEventListener("change", applyFilter);
  toDate.addEventListener("change", applyFilter);
  clearFiltersBtn.addEventListener("click", clearFilters);
});
</script>
</body>
</html>