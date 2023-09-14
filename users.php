<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT * FROM tbl_user_admin WHERE user_type IN ('staff','purok leader')";
    $result = $conn->query($query);

    $users = array();
	while($row = $result->fetch_assoc()){
		$row['active_badge'] = $row['is_active'] == 'active' ? '<span class="badge badge-primary">active</span>' : '<span class="badge badge-danger">inactive</span>';
		$users[] = $row; 
	}

	$sql = "SELECT * FROM tblpurok";
    $res = $conn->query($sql);

    $purok = array();
	while($row = $res->fetch_assoc()){
		$purok[] = $row; 
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
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-black fw-bold" style = "font-size: 300%;">Staff & Purok Leader's Account</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
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
										<div class="card-title"></div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-light btn-border btn-sm">
												<i class="fa fa-plus"></i>
												User
											</a>
											<a class="btn btn-light btn-border btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filter
											</a>
											<div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
												<div class="dropdown-item">
													<label>User Type:</label>
													<select class="form-control" id="filterCert" name="cert_name" onclick="event.stopPropagation();">
														<option value="">Show All</option>
														<option value="staff">Staff</option>
														<option value="administrator">Administrator</option>
														<option value="purok leader">Purok Leader</option>
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
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr class="text-center">
													<th scope="col">No.</th>
													<th scope="col">Fullname</th>
													<th scope="col">Username</th>
													<th scope="col">User Type</th>
													<th scope="col">Purok</th>
													<th scope="col">Status</th>
													<th scope="col">Created At</th>
													<th class="text-center" scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($users)): ?>
													<?php $no=1; foreach($users as $row): ?>
													<tr class="text-center">
														<td><?= $no ?></td>
														<td>
															<div class="avatar avatar-xs">
                                                                <img src="<?= preg_match('/data:image/i', $row['avatar']) ? $row['avatar'] : 'assets/uploads/avatar/'.$row['avatar'] ?>" alt="User Profile" class="avatar-img rounded-circle">
                                                            </div>
                                                            <?= ucwords($row['fullname']) ?>
														</td>														
														<td>
                                                            <?= ucwords($row['username']) ?>
														</td>
														<td><?= $row['user_type'] ?></td>
														<td><?= $row['purok'] ?></td>
														<td class="text-center"><?= $row['active_badge'] ?></td>
														<td><?= $row['created_at'] ?></td>
														<td class="text-center">
															<div class="form-button-action">
																<a type="button" class="btn btn-link btn-primary" data-toggle="modal" href="" data-target="#DeactivateDeleteModal<?= $row['id'] ?>" data-original-title="Edit">
																	<i class="fa-solid fa-edit"></i>
																</a>
                                                                <a type="button" class="btn btn-link btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </a>
															</div>
														</td>
													</tr>
													<?php $no++; endforeach ?>
												<?php else: ?>
													<tr>
														<td colspan="5" class="text-center">No Available Data</td>
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
			<?php foreach ($users as $row) { ?>
        <div class="modal fade" id="confirmDeleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" style="font-size: 16px;">
                        Are you certain you want to remove name <strong><?= ucwords($row['fullname']) ?></strong> ?
                    </div>
                    <div class="modal-footer mt-3 d-flex justify-content-center">
                        <form method="post" action="model/remove_user.php">
                            <input type="text" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
		<?php foreach ($users as $row) { ?>
			<div id="DeactivateDeleteModal<?= $row['id'] ?>" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title fw-bold">Deactivating user's account.</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
							<div class="modal-body">
							<form method="POST" action="model/deactivate_admin_account.php">
									<div class="col-md-12">
										<div class="form-group">
											<span>Select a reason to deactivate this user account.</span>
										</div>
										<div class="form-group">
											<label>Reason's</label>
											<select class="form-control" name="reason" id="reason" required>
												<option value="" disabled selected>Select a reason</option>
												<option value="problem solved">Problem Solved</option>
												<option value="take a break">Take a break</option>
												<option value="personal reasons">Personal reasons</option>
												<option value="transfer residency">Transfer Residency</option>
												<option value="someone has a case">This user has a file case</option>
												<option value="none officials">This user are no longer officials</option>
											</select>
										</div>
										<div class="form-group">
											<textarea class="form-control" rows="5" placeholder="Additional comments" name="message" required></textarea>
										</div>
										<div class="form-group">
											<label>Account Status</label>
											<select class="form-control" name="is_active" id="is_active" required>
												<option value="" disabled selected>Select status account</option>
												<option value="active">Active</option>
												<option value="inactive">Inactive</option>
											</select>
										</div>
									</div>
								</div>
								<div class="modal-footer d-flex justify-content-center">
									<input type="hidden" name="username" value="<?= $row["username"] ?>">
									<button class="btn btn-outline-secondary" type="button" data-dismiss="modal">
										<span class="link-collapse">Cancel</span>
									</button>
									<button class="btn btn-primary mr-2" type="submit" name="submit">
										<span class="link-collapse">Submit</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php } ?>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create System User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_user.php" enctype="multipart/form-data">
							<input type="hidden" name="size" value="1000000">
								<div class="text-center">
                                    <div id="my_camera" style="height: 250;" class="text-center">
                                        <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                    </div>
                                    <div id="profileImage">
                                        <input type="hidden" name="profileimg" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="img" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Enter Username" name="username" required>
                                </div>
								<div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="fullname" required>
                                </div>
								<div class="form-group">
                                    <label>Purok</label>
									<select class="form-control input" required name="purok" id="purok">
										<option disabled selected>Select Purok</option>
										<?php foreach($purok as $row):?>
											<option value="<?= ucwords($row['purok']) ?>"><?= $row['purok'] ?></option>
										<?php endforeach ?>
									</select>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Password" name="pass" required>
                                </div>
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" id="pillSelect" required name="user_type">
                                        <option disabled selected>Select User Type</option>
                                        <option value="staff">Staff</option>
                                        <option value="administrator">Administrator</option>
										<option value="purok leader">Purok Leader</option>
                                    </select>
                                </div>
                            
                        </div>
                        <div class="modal-footer mt-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
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
  const filterCert = document.getElementById("filterCert");
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const certValue = filterCert.value.toLowerCase();
    const rowCert = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
    const rowDate = new Date(row.querySelector("td:nth-child(6)").textContent);
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