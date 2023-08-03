<?php 
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["fullname"];

$sql = "SELECT *,r.id, s.certificate_name, s.status, s.date_applied 
        FROM tblresident AS r 
        JOIN tblresident_requested AS s ON r.certificate_name = s.certificate_name 
        JOIN tbl_user_resident AS u ON u.fullname = s.resident_name
        WHERE u.fullname = ? AND s.status IN ('on hold','approved','rejected')";

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
                        <h3 class="text-center fw-bold mt-2"> This is the list of the requested certifications transaction with CertiFast Portal. </h3>
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
												<?php if(!empty($permit)): ?>
													<?php foreach($permit as $row): ?>
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