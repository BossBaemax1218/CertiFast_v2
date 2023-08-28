<?php include 'server/server.php' ?>
<?php 
$sql = "SELECT s.*, s.req_cert_id as req_cert_id, s.certificate_name as certificate_name, s.resident_name as resident_name, s.purok as purok, s.date_applied as date_applied,
(SELECT GROUP_CONCAT(c_id) FROM tblclearance c1 WHERE c1.email = s.email AND c1.requirement = s.requirement) AS c_id,
(SELECT GROUP_CONCAT(brgy_id) FROM tblbrgy_id c2 WHERE c2.email = s.email AND c2.requirement = s.requirement) AS brgy_id,
(SELECT GROUP_CONCAT(res_id) FROM tblresidency c3 WHERE c3.email = s.email AND c3.requirement = s.requirement) AS res_id,
(SELECT GROUP_CONCAT(death_id) FROM tbldeath c4 WHERE c4.email = s.email AND c4.requirement = s.requirement) AS death_id,
(SELECT GROUP_CONCAT(birth_id) FROM tblbirthcert c5 WHERE c5.email = s.email AND c5.requirement = s.requirement) AS birth_id,
(SELECT GROUP_CONCAT(live_id) FROM tbllive_in c6 WHERE c6.email = s.email AND c6.requirements = s.requirement) AS live_id,
(SELECT GROUP_CONCAT(job_id) FROM tblfirstjob c7 WHERE c7.email = s.email AND c7.requirement = s.requirement) AS job_id,
(SELECT GROUP_CONCAT(fam_id) FROM tblfamily_tax c8 WHERE c8.email = s.email AND c8.requirements = s.requirement) AS fam_id,
(SELECT GROUP_CONCAT(good_id) FROM tblgood_moral c9 WHERE c9.email = s.email AND c9.requirement = s.requirement) AS good_id,
(SELECT GROUP_CONCAT(indi_id) FROM tblindigency c10 WHERE c10.email = s.email AND c10.requirements = s.requirement) AS indi_id,
(SELECT GROUP_CONCAT(oath_id) FROM tbloath c12 WHERE c12.email = s.email AND c12.requirement = s.requirement) AS oath_id 
FROM tblresident_requested AS s WHERE s.status IN ('on hold', 'approved') AND s.certificate_name != 'business permit' GROUP BY req_cert_id ORDER BY s.cert_id DESC";

$result = $conn->query($sql);

$resident = array();
while ($row = $result->fetch_assoc()) {
    $status = $row['status'];
    $statusBadge = '';

    if ($status === 'on hold') {
        $statusBadge = '<span class="badge badge-warning">On Hold</span>';
    } elseif ($status === 'approved') {
        $statusBadge = '<span class="badge badge-success">Approved</span>';
    } else {
        $statusBadge = '<span class="badge badge-secondary">Unknown</span>';
    }

    $row['residency_badge'] = $statusBadge;

    if ($status == 'on hold' || $status == 'approved') {
        $row['c_id'] = $row['c_id'];
        $row['brgy_id'] = $row['brgy_id'];
        $row['res_id'] = $row['res_id'];
        $row['death_id'] = $row['death_id'];
        $row['birth_id'] = $row['birth_id'];
        $row['live_id'] = $row['live_id'];
        $row['job_id'] = $row['job_id'];
        $row['fam_id'] = $row['fam_id'];
        $row['good_id'] = $row['good_id'];
        $row['indi_id'] = $row['indi_id'];
        $row['oath_id'] = $row['oath_id'];

        $resident[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
    <style>
        .checkbox-label {
            display: flex;
            align-items: center;
            color: black;
        }

        .form-check-input {
            margin-right: 8px; 
            margin-bottom: 5px;
    }
    </style>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
                        <div class="page-inner">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row mb-2">
                                <h1 class="text fw-bold" style = "font-size: 300%;">List of Requested Certificates</h1>
                            </div>
                        </div>
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
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">
                                        </div>  
                                            <div class="card-tools">
                                                <!--<a class="btn btn-info btn-border btn-round btn-sm" type="button" data-toggle="modal" data-target="#changeStatus">
                                                    Change Status
                                                </a>-->
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
                                                <a id="pdf" class="btn btn-light btn-border btn-sm">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>                                                                             
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">                                          
                                            <table id="residenttable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Certificate ID</th>
                                                        <th scope="col">Date</th>
                                                        <th class="text-center" scope="col">Fullname</th>
                                                        <th scope="col">Certificates Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Purpose</th>
                                                        <th scope="col">Status</th>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                        <?php endif ?>
                                                        <th class="text-center" scope="col">Action</th>
                                                        <?php endif ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (!empty($resident)) : ?>
                                                    <?php foreach ($resident as $row) : ?>
                                                        <tr data-res_id="<?= $row['res_id'] ?>"
                                                            data-c_id="<?= $row['c_id'] ?>"
                                                            data-indi_id="<?= $row['indi_id'] ?>"
                                                            data-fam_id="<?= $row['fam_id'] ?>"
                                                            data-death_id="<?= $row['death_id'] ?>"
                                                            data-birth_id="<?= $row['birth_id'] ?>"
                                                            data-oath_id="<?= $row['oath_id'] ?>"
                                                            data-brgy_id="<?= $row['brgy_id'] ?>"
                                                            data-live_id="<?= $row['live_id'] ?>"
                                                            data-first_id="<?= $row['job_id'] ?>"
                                                            data-good_id="<?= $row['good_id'] ?>">
                                                            <td><?= $row['req_cert_id'] ?></td>
                                                            <td><?= $row['date_applied'] ?></td>
                                                            <td><?= ucwords($row['resident_name']) ?></td>
                                                            <td><?= ucwords($row['certificate_name']) ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['requirement'] ?></td>
                                                            <td><?= $row['residency_badge'] ?></td>
                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                                <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                                <?php endif ?>
                                                                <td class="text-center">
                                                                    <div class="form-button-action">
                                                                        <a type="button" data-toggle="tooltip" class="btn btn-link btn-secondary view-certificate-btn"
                                                                            data-original-title="View Certificate"
                                                                            data-certificate-name="<?= $row['certificate_name'] ?>">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                        <?php
                                                                            $status = $row['status'];
                                                                            $btnDisabled = ($status === 'on hold') ? 'disabled' : '';
                                                                        ?>
                                                                        <a type="button" data-toggle="tooltip" class="btn btn-link btn-danger generate-certificate-btn"
                                                                            data-original-title="Generate Certificate"
                                                                            data-certificate_name="<?= $row['certificate_name'] ?>"
                                                                            data-status="<?= $status ?>" <?= $btnDisabled ?>>
                                                                            <i class="fas fa-print"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            <?php endif ?>
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
    <div class="modal fade" id="filterStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="filterStatus" name="status">
                            <option value="on hold">On Hold</option>
                            <option value="approved">Approved</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button id="saveStatusBtn" class="btn btn-danger">Change</button>
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
  const filterStatus = document.getElementById("filterStatus");
  const filterCert = document.getElementById("filterCert");
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const statusValue = filterStatus.value.toLowerCase();
    const certValue = filterCert.value.toLowerCase();
    const rowStatus = row.querySelector("td:nth-child(7)").textContent.toLowerCase();
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
<script>
   document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll("#residenttable tbody tr");
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var residencyId = row.getAttribute("data-res_id");
        var clearanceId = row.getAttribute("data-c_id");
        var indigencyId = row.getAttribute("data-indi_id");
        var famId = row.getAttribute("data-fam_id");
        var brgyId = row.getAttribute("data-brgy_id");
        var firstId = row.getAttribute("data-first_id");
        var oathId = row.getAttribute("data-oath_id");
        var goodId = row.getAttribute("data-good_id");
        var liveId = row.getAttribute("data-live_id");
        var deathId = row.getAttribute("data-death_id");
        var birthId = row.getAttribute("data-birth_id");
        var generateBtn = row.querySelector(".generate-certificate-btn ");

        (function (residencyId, clearanceId, indigencyId, famId, birthId, deathId, liveId, goodId, oathId, firstId, indigencyId, brgyId) {
            generateBtn.addEventListener("click", function () {
                var certificateName = this.getAttribute("data-certificate_name");
                var status = this.getAttribute("data-status");
                if (status === "approved") {
                    var url;

                    switch (certificateName.toLowerCase()) {
                        case 'barangay clearance':
                            url = 'generate_brgy_cert.php?id=' + clearanceId;
                            break;
                        case 'barangay identification':
                            url = 'generate_brgy_id.php?id=' + brgyId;
                            break;
                        case 'certificate of residency':
                            url = 'generate_residency_cert.php?id=' + residencyId;
                            break;
                        case 'certificate of indigency':
                            url = 'generate_indi_cert.php?id=' + indigencyId;
                            break;
                        case 'first time jobseekers':
                            url = 'generate_jobseekers.php?id=' + firstId;
                            break;
                        case 'certificate of oath taking':
                            url = 'generate_oath.php?id=' + oathId;
                            break;
                        case 'certificate of good moral':
                            url = 'generate_good_moral.php?id=' + goodId;
                            break;
                        case 'certificate of live in':
                            url = 'generate_live_in.php?id=' + liveId;
                            break;
                        case 'family home estate':
                            url = 'generate_family_tax.php?id=' + famId;
                            break;
                        case 'certificate of death':
                            url = 'generate_death.php?id=' + deathId;
                            break;
                        case 'certificate of birth':
                            url = 'generate_birth.php?id=' +  birthId;
                            break;
                        default:
                            url = 'list_certificates.php';
                            break;
                    }

                    window.location.href = url;
                }
            });
        })(residencyId, clearanceId, indigencyId, famId, birthId, deathId, liveId, goodId, oathId, firstId, indigencyId, brgyId);
    }
});
</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll("#residenttable tbody tr");
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var resId = row.getAttribute("data-res_id");
        var clrId = row.getAttribute("data-c_id");
        var indId = row.getAttribute("data-indi_id");
        var famId = row.getAttribute("data-fam_id");
        var brgyIdAttr = row.getAttribute("data-brgy_id");
        var firstId = row.getAttribute("data-first_id");
        var oathId = row.getAttribute("data-oath_id");
        var goodId = row.getAttribute("data-good_id");
        var liveId = row.getAttribute("data-live_id");
        var dId = row.getAttribute("data-death_id");
        var birthIdAttr = row.getAttribute("data-birth_id");
        var viewBtn = row.querySelector(".view-certificate-btn ");

        (function (resId, clrId, indId, famId, brgyIdAttr, firstId, oathId, goodId, liveId, dId, birthIdAttr) {
            viewBtn.addEventListener("click", function () {
                var certName = this.getAttribute("data-certificate-name");
                var editModal = document.getElementById("editModal");

                switch (certName.toLowerCase()) {
                    case 'barangay clearance':
                        localStorage.setItem('openCleCertModal', 'true');
                        window.location.href = 'view_brgy_cert.php?id=' + clrId;
                        break;
                    case 'barangay identification':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_brgy_id.php?id=' + brgyIdAttr;
                        break;
                    case 'certificate of residency':
                        localStorage.setItem('openResCertModal', 'true');
                        window.location.href = 'view_residency_cert.php?id=' + resId;
                        break;
                    case 'certificate of indigency':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_indi_cert.php?id=' + indId;
                        break;
                    case 'first time jobseekers':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_jobseekers.php?id=' + firstId;
                        break;
                    case 'certificate of oath taking':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_oath.php?id=' + oathId;
                        break;
                    case 'certificate of good moral':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_good_moral.php?id=' + goodId;
                        break;
                    case 'certificate of live in':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_live_in.php?id=' + liveId;
                        break;
                    case 'family home estate':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_family_tax.php?id=' + famId;
                        break;
                    case 'certificate of death':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_death.php?id=' + dId;
                        break;
                    case 'certificate of birth':
                        localStorage.setItem('openIndiCertModal', 'true');
                        window.location.href = 'view_birth.php?id=' +  birthIdAttr;
                        break;
                    default:
                        url = 'list_certificates.php';
                        break;
                }
            });
        })(resId, clrId, indId, famId, brgyIdAttr, firstId, oathId, goodId, liveId, dId, birthIdAttr);
    }
});
</script>
<script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
        <script>
        $(document).on("click", "#pdf", function () {
        console.log("Exporting certificate table as PDF...");

        const currentDate = new Date().toISOString().slice(0, 10);

        const title = "Certificates Files - " + currentDate;
        const filename = "Certificates_" + currentDate + ".pdf";

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