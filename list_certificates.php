<?php include 'server/server.php' ?>
<?php 
$sql = "SELECT s.*, s.certificate_name as certificate_name, s.resident_name as resident_name, s.purok as purok, s.date_applied as date_applied,
(SELECT GROUP_CONCAT(DISTINCT c_id) FROM tblclearance c1 WHERE c1.email = s.email) AS c_id,
(SELECT GROUP_CONCAT(DISTINCT brgy_id) FROM tblbrgy_id c2 WHERE c2.email = s.email) AS brgy_id,
(SELECT GROUP_CONCAT(DISTINCT res_id) FROM tblresidency c3 WHERE c3.email = s.email) AS res_id,
(SELECT GROUP_CONCAT(DISTINCT death_id) FROM tbldeath c4 WHERE c4.email = s.email) AS death_id,
(SELECT GROUP_CONCAT(DISTINCT birth_id) FROM tblbirthcert c5 WHERE c5.email = s.email) AS birth_id,
(SELECT GROUP_CONCAT(DISTINCT live_id) FROM tbllive_in c6 WHERE c6.email = s.email) AS live_id,
(SELECT GROUP_CONCAT(DISTINCT job_id) FROM tblfirstjob c7 WHERE c7.email = s.email) AS job_id,
(SELECT GROUP_CONCAT(DISTINCT fam_id) FROM tblfamily_tax c8 WHERE c8.email = s.email) AS fam_id,
(SELECT GROUP_CONCAT(DISTINCT good_id) FROM tblgood_moral c9 WHERE c9.email = s.email) AS good_id,
(SELECT GROUP_CONCAT(DISTINCT indi_id) FROM tblindigency c10 WHERE c10.email = s.email) AS indi_id,
(SELECT GROUP_CONCAT(DISTINCT oath_id) FROM tbloath c12 WHERE c12.email = s.email) AS oath_id 
FROM tblresident_requested AS s WHERE s.status IN ('on hold', 'approved') AND s.certificate_name != 'business permit' GROUP BY s.certificate_name, s.resident_name ORDER BY s.cert_id ASC";

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
                                <h1 class="text-black fw-bold" style = "font-size: 400%;">Generate Certificates</h1>
                            </div>
                        </div>
						<div class="col-md-12">
                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title">Certificate Management</h1>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="residenttable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th class="text-center" scope="col">Fullname</th>
                                                        <th scope="col">Certificates Name</th>
                                                        <th scope="col">Email</th>
                                                        <th class="text-center" scope="col">Status</th>
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
                                                            <tr data-res_id="<?= $row['res_id'] ?>" data-c_id="<?= $row['c_id'] ?>" data-indi_id="<?= $row['indi_id'] ?>" data-fam_id="<?= $row['fam_id'] ?>" 
                                                            data-death_id="<?= $row['death_id'] ?>" data-birth_id="<?= $row['birth_id'] ?>" data-oath_id="<?= $row['oath_id'] ?>" 
                                                            data-brgy_id="<?= $row['brgy_id'] ?>" data-live_id="<?= $row['live_id'] ?>" data-first_id="<?= $row['job_id'] ?>" data-good_id="<?= $row['good_id'] ?>">
                                                                <td><?= $row['date_applied'] ?></td>
                                                                <td>
                                                                    <?= ucwords($row['resident_name']) ?>
                                                                </td>
                                                                <td><?= ucwords($row['certificate_name']) ?></td>
                                                                <td><?= $row['email'] ?></td>
                                                                <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                                <?php if (isset($_SESSION['username'])) : ?>
                                                                    <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                                <?php endif ?>
                                                                <td class="text-center">
                                                                    <div class="form-button-action">
                                                                        <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Status" onclick="editStatus(this)" data-cert_id="<?= $row['cert_id'] ?>" data-status="<?= $row['status'] ?>">
                                                                            <?php if (isset($_SESSION['username'])): ?>
                                                                                <i class="fas fa-edit"></i>
                                                                            <?php else: ?>
                                                                                <i class="fa fa-eye"></i>
                                                                            <?php endif ?>
                                                                        </a>
                                                                        <?php
                                                                            $status = $row['status'];
                                                                            $btnDisabled = ($status === 'on hold') ? 'disabled' : '';
                                                                        ?>
                                                                        <a type="button" data-toggle="tooltip" class="btn btn-link btn-danger generate-certificate-btn" data-original-title="Generate Certificate" data-certificate_name="<?= $row['certificate_name'] ?>" data-status="<?= $status ?>" <?= $btnDisabled ?>>
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
                </div>
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="model/edit_cert_status.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control primary" required name="status">
                                            <option disabled selected>Select Status</option>
                                            <option value="on hold">On Hold</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="claimed">Claimed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="cert_id" id="cert_id">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <?php if(isset($_SESSION['username'])): ?>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'templates/main-footer.php' ?>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
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
        var generateBtn = row.querySelector(".generate-certificate-btn");

        (function (residencyId, clearanceId, indigencyId, famId) {
            generateBtn.addEventListener("click", function () {
                var certificateName = this.getAttribute("data-certificate_name");
                var status = this.getAttribute("data-status");
                if (status === "approved") {
                    switch (certificateName.toLowerCase()) {
                        case 'barangay clearance':
                            window.location.href = 'generate_brgy_cert.php?id=' + clearanceId;
                            break;
                        case 'barangay identification':
                            window.location.href = 'generate_brgy_id.php?id=' + brgyId;
                            break;
                        case 'certificate of residency':
                            window.location.href = 'generate_residency_cert.php?id=' + residencyId;
                            break;
                        case 'certificate of indigency':
                            window.location.href = 'generate_indi_cert.php?id=' + indigencyId;
                            break;
                        case 'first time jobseekers':
                            window.location.href = 'generate_jobseekers.php?id=' + firstId;
                            break;
                        case 'certificate of oath taking':
                            window.location.href = 'generate_oath.php?id=' + oathId;
                            break;
                        case 'certificate of good moral':
                            window.location.href = 'generate_good_moral.php?id=' + goodId;
                            break;
                        case 'certificate of live in':
                            window.location.href = 'generate_live_in.php?id=' + liveId;
                            break;
                        case 'family home estate':
                            window.location.href = 'generate_family_tax.php?id=' + famId;
                            break;
                        case 'certificate of death':
                            window.location.href = 'generate_death.php?id=' + deathId;
                            break;
                        case 'certificate of birth':
                            window.location.href = 'generate_birth.php?id=' +  birthId;
                            break;
                        default:
                            window.location.href = 'list_certificates.php';
                            break;
                    }
                }
            });
        })(residencyId, clearanceId, indigencyId, famId);
    }
});

</script>
<script>
    function editStatus(that){
        cert_id          = $(that).attr('data-cert_id');
        status     = $(that).data('data-status');

        $('#cert_id').val(cert_id);
        $('#status').val(status);
    }
    </script>
</body>
</html>