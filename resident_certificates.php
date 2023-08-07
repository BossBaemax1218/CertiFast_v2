<?php 
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["user_email"];

$sql = "SELECT *,s.cert_id, s.certificate_name, s.status, s.date_applied 
        FROM tblresident_requested AS s JOIN tbl_user_resident AS u ON u.user_email = s.email JOIN
		tblresident AS r ON r.email=s.email WHERE u.user_email = ? AND s.status IN ('on hold','approved','rejected')
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
    }

    $row['residency_badge'] = $statusBadge;
	if ($status == 'on hold') {
        $resident[] = $row;
		
    } elseif ($status == 'approved') {
        $resident[] = $row;
    }elseif ($status == 'rejected') {
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
		<div class="main-panel mt-5">
			<div class="content">
				<div class="panel-header">
                    <div class="text-center mb-3">
                        <h1 class="text-center fw-bold mt-3" style="font-size: 400%;">Certification Requested</h1>
                        <h3 class="text-center mt-2"> This is the list of the requested certifications transaction with CertiFast Portal. </h3>
                    </div>
				</div>
				<div class="page-inner">
					<div class="row mt-2">
						<div class="col-md-12">
                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
							<div class="p-2 mb-2 bg-danger text-white">
								<h5 class="text-left mt-2"><i class="fas fa-exclamation-circle"></i>  If you've ever questioned why a certificate you requested did not appear, it's likely your personal data status is <strong>On Hold</strong>, and you are unable to request any Barangay Los Amigos certifications without getting prior permission from your <b>Purok Leader</b>.</h5>
							</div>
                            <div class="card">
								<div class="card-body">
									<div class="table-responsive">
                                    <table id="residenttable" class="table">
											<thead>
												<tr class="text-center">
													<th scope="col">Date Applied</th>
													<th scope="col">Name</th>
													<th scope="col">Certificates</th>
													<th scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php foreach($resident as $row): ?>
													<tr class="text-center">
														<td><?= ucwords($row['date_applied']) ?></td>
														<td><?= ucwords($row['resident_name']) ?></td>
														<td><?= ucwords($row['certificate_name']) ?></td>
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
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
</body>
</html>