<?php include 'server/server.php' ?>
<?php 
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'staff') {
        $off_q = "SELECT * FROM tblcertificates WHERE `authorize_status`='yes'";
    } else {
        $off_q = "SELECT * FROM tblcertificates ORDER BY `id` DESC";
    }
} else {
    $off_q = "SELECT * FROM tblcertificates WHERE `authorize_status`='no'";
}

$result = $conn->query($off_q);

$users = array();
while ($row = $result->fetch_assoc()) {
    $row['authorize_badge'] = $row['authorize_status'] == 'yes' ? '<span class="badge badge-success">yes</span>' : '<span class="badge badge-primary">no</span>';
    $users[] = $row;
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
                <div class="panel-header">
					<div class="page-inner mt-2">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row mb-2">
							<h2 class="text-black fw-bold" style = "font-size: 300%;">List of Certifications</h2>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Certificates Management</div>
									</div>
                                    <div class="d-flex align-items-right align-items-md-right justify-content-end flex-column flex-md-row mb-2">
                                        <div class="col-sm-12 col-md-3 text-left">
                                            <label for="certType">Certificate Type:</label>
                                            <select class="form-control" id="certType" name="certType">
                                                <option value="Certificate of Clearance" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Clearance') echo 'selected'; ?>>Certificate of Clearance</option>
                                                <option value="Certificate of Residency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                                                <option value="Certificate of Indigency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                                                <option value="Certificate of Business Permit" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Business Permit') echo 'selected'; ?>>Certificate of Business Permit</option>
                                                <option value="Certificate of Tree Planting" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Tree Planting') echo 'selected'; ?>>Certificate of Tree Planting</option>
                                                <option value="Certificate of Residency Abroad" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency Abroad') echo 'selected'; ?>>Certificate of Residency Abroad</option>
                                                <!-- Add other certificate names here -->
                                                <!-- ... -->
                                            </select>                               
                                        </div>
                                        <div class="col-sm-12 col-md-2 text-left">
                                            <label for="authorize_status">Authorize Status:</label>
                                            <select class="form-control" id="authorize_status" name="authorize_status">
                                                <option value="Yes" <?php if (isset($_POST['authorize_status']) && $_POST['authorize_status'] === 'Yes') echo 'selected'; ?>>Yes</option>
                                                <option value="No" <?php if (isset($_POST['authorize_status']) && $_POST['authorize_status'] === 'No') echo 'selected'; ?>>No</option>
                                            </select>                               
                                        </div>
                                        <div class="col-sm-6 col-md-1 mr-3">
                                            <button type="submit" class="btn btn-primary mt-3 mt-md-4" id="applyFilterBtn">Apply Filter</button>
                                        </div>
                                    </div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr>
													<th scope="col">Certificate Names</th>

                                                    <th  class="text-center" scope="col">Authorize Status</th>
													<th class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($users)): ?>
													<?php $no=1; foreach($users as $row): ?>
														<tr>
															<td><?= $row['list_certificates'] ?></td>
                                                            <td class="text-center"><?= $row['authorize_badge'] ?></td>	
															<td class="text-center">
																<div class="form-button-action">
																	<a type="button" data-toggle="tooltip" href="model/remove_user_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-link btn-danger" data-original-title="Remove">
																		<i class="fas fa-trash"></i>
																	</a>
																</div>
															</td>													
														</tr>
													<?php $no++; endforeach ?>
												<?php else: ?>
													<tr>
														<td colspan="8" class="text-center">No Available Data</td>
													</tr>
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
</body>
</html>