<?php include 'server/server.php' ?>
<?php 
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'staff') {
        $off_q = "SELECT * FROM tbl_user_resident WHERE `account_status`='verified' AND `residency_status`='verified'";
    } else {
        $off_q = "SELECT * FROM tbl_user_resident ORDER BY `created_at` DESC";
    }
} else {
    $off_q = "SELECT * FROM tbl_user_resident WHERE `account_status`='verified' AND `residency_status`='verified'";
}

$result = $conn->query($off_q);

$users = array();
while ($row = $result->fetch_assoc()) {
    $row['account_badge'] = $row['account_status'] == 'verified' ? '<span class="badge badge-primary">verified</span>' : '<span class="badge badge-danger">unverified</span>';
    $row['residency_badge'] = $row['residency_status'] == 'verified' ? '<span class="badge badge-success">verified</span>' : '<span class="badge badge-danger">unverified</span>';
    $users[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Resident Management</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-black fw-bold" style = "font-size: 300%;">Settings</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
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
										<div class="card-title">User Management</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th scope="col">No.</th>
													<th scope="col">Name</th>
													<th scope="col">Email</th>
													<?php if(isset($_SESSION['username'])):?>
														<?php if($_SESSION['role']=='administrator'):?>
														<th class="text-center" scope="col">Account Status</th>
														<?php endif ?>
													<?php endif?>
													<th class="text-center" scope="col">Residency Status</th>
													<th scope="col">Created</th>
													<?php if(isset($_SESSION['username'])):?>
														<?php if($_SESSION['role']=='administrator'):?>
														<?php endif ?>
														<th class="text-center">Action</th>
													<?php endif?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($users)): ?>
													<?php $no=1; foreach($users as $row): ?>
														<tr>
															<td><?= $no ?></td>
															<td><?= $row['fullname'] ?></td>
															<td><?= $row['user_email'] ?></td>
															<td class="text-center"><?= $row['account_badge'] ?></td>
															<td class="text-center"><?= $row['residency_badge'] ?></td>
															<td><?= $row['created_at'] ?></td>
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