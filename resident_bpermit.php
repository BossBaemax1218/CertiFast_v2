<?php 
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["user_email"];

$sql = "SELECT * FROM tblpermit JOIN tbl_user_resident ON tblpermit.email = tbl_user_resident.user_email WHERE tbl_user_resident.user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();

$permit = array();
while ($row = $result->fetch_assoc()) { 
    $permit[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Resident Reports</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
                    <div>
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                        <h3 class="text-center fw-bold"> Apply business permit with CertiFast Portal. </h3>
                        <br>
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
                                <h5 class="text-center fw-bold mt-5"><a href="#add" data-toggle="modal" class="btn-request-now" style="text-decoration: none; color:white;">APPLY</a></h5>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr class="text-center">
													<th scope="col">Name of Business</th>
													<th scope="col">Business Owner</th>
                                                    <th scope="col">Business Email</th>
													<th scope="col">Description</th>
													<th scope="col">Date Applied</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($permit)): ?>
													<?php foreach($permit as $row): ?>
													<tr class="text-center">
														<td><?= ucwords($row['name']) ?></td>
														<td><?= !empty($row['owner1']) ? ucwords($row['owner1']) : $row['owner1'] ?></td>
                                                        <td><?= ucwords($row['email']) ?></td>
														<td><?= $row['nature'] ?></td>
														<td><?= $row['applied'] ?></td>													
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
			<!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_permit_user.php" >
                                <div class="form-group">
                                    <label>Business Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Business Name" name="name"  required>
                                </div>
                                <div class="form-group">
                                    <label>Business Owner</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter Owner Name" name="owner1" value="<?= $_SESSION['fullname'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Business Email</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter Owner Name" name="email" value="<?= $_SESSION['user_email'] ?>" readonly>
                                </div>
								<div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" placeholder="Description" name="nature" required>
                                </div>
								<div class="form-group">
                                    <label>Date Applied Nature</label>
                                    <input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                       		</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-danger">Create</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#residenttable').DataTable();
        });
    </script>
</body>
</html>