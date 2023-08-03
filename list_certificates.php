<?php include 'server/server.php' ?>
<?php 
$sql = "SELECT *, r.id, s.cert_id, s.certificate_name, s.status, s.date_applied 
FROM tblresident AS r 
JOIN tblresident_requested AS s 
ON r.email=s.email
WHERE s.status IN ('on hold', 'approved')
AND s.certificate_name != 'business permit'";

$result = $conn->query($sql);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
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
        }

        $row['residency_badge'] = $statusBadge;

        if ($status == 'on hold') {
            $resident[] = $row;
        } elseif ($status == 'approved') {
            $resident[] = $row;
        }
    }
}
    $query1 = "SELECT * FROM tblpurok";
    $result1 = $conn->query($query1);

    $purok = array();
	while($row2 = $result1->fetch_assoc()){
		$purok[] = $row2; 
	}
    
    $sql = "SELECT *, list_certificates FROM tblcertificates";
    $result2 = $conn->query($sql);

    $cert = array();
	while($row3 = $result2->fetch_assoc()){
		$cert[] = $row3; 
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
                        <div class="panel-header">
                            <div class="page-inner mt-2">
                                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row mb-2">
                                    <h1 class="text-black fw-bold" style = "font-size: 400%;">Generate Certificates</h1>
                                </div>
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
                                                        <th scope="col">Purok</th>
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
                                                            <tr data-id="<?= $row['id'] ?>">
                                                            <?php
                                                                    $status = $row['status'];
                                                                    $btnDisabled = ($status === 'on hold') ? 'disabled' : '';
                                                                ?>
                                                                <td><?= $row['date_applied'] ?></td>
                                                                <td>
                                                                    <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                                                </td>
                                                                <td><?= ucwords($row['certificate_name']) ?></td>
                                                                <td><?= $row['purok'] ?></td>
                                                                <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                                        <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                                    <?php endif ?>
                                                                    <td class="text-center">
                                                                        <div class="form-button-action">
                                                                            <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Status" onclick="editStatus(this)" 
                                                                                data-cert_id="<?= $row['cert_id'] ?>" data-status="<?= $row['status'] ?>">
                                                                                <?php if(isset($_SESSION['username'])): ?>
                                                                                    <i class="fas fa-edit"></i>
                                                                                <?php else: ?>
                                                                                    <i class="fa fa-eye"></i>
                                                                                <?php endif ?>
                                                                            </a>
                                                                            <a type="button" data-toggle="tooltip" href="#" class="btn btn-link btn-danger generate-certificate-btn" data-original-title="Generate Certificate" data-certificate_name="<?= $row['certificate_name'] ?>" data-status="<?= $status ?>" <?= $btnDisabled ?>>
                                                                                <i class="fas fa-print"></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <?php endif ?>
                                                                </tr>
                                                            <?php
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
            var residentId = row.getAttribute("data-id");
            var generateBtn = row.querySelector(".generate-certificate-btn");
            generateBtn.addEventListener("click", function () {
                var certificateName = this.getAttribute("data-certificate_name");
                var status = this.getAttribute("data-status");
                if (status === "approved") {
            switch (certificateName.toLowerCase()) {
                case 'barangay clearance':
                     window.location.href = 'generate_brgy_cert.php?id=' + residentId;
                    break;
                case 'barangay identification':
                     window.location.href = 'generate_brgy_id.php?id=' + residentId;
                    break;
                case 'certificate of residency':
                     window.location.href = 'generate_residency_cert.php?id=' + residentId;
                    break;
                case 'certificate of indigency':
                     window.location.href = 'generate_indi_cert.php?id=' + residentId;
                    break;
                case 'firt time jobseekers':
                     window.location.href = 'generate_jobseekers.php?id=' + residentId;
                    break;
                case 'certificate of oath taking':
                     window.location.href = 'generate_oath.php?id=' + residentId;
                    break;
                case 'certificate of good moral':
                     window.location.href = 'generate_good_moral.php?id=' + residentId;
                    break;
                case 'certificate of live in':
                     window.location.href = 'generate_live_in.php?id=' + residentId;
                    break;
                case 'family home estate tax':
                     window.location.href = 'generate_family_tax.php?id=' + residentId;
                    break;
                case 'certificate of death':
                     window.location.href = 'generate_death.php?id=' + residentId;
                    break;
                case 'certificate of birth':
                     window.location.href = 'generate_birth.php?id=' + residentId;
                    break;
                default:
                     window.location.href = 'list_certificates.php';
                    break;
                }
            }
        });
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