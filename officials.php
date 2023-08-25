<?php include 'server/server.php' ?>
<?php 
	if(isset($_SESSION['role'])){
		if($_SESSION['role'] =='staff'){
			$off_q = "SELECT *,tblofficials.id as id, tblposition.id as pos_id FROM tblofficials JOIN tblposition ON tblposition.id=tblofficials.position WHERE `status`='Active' ";
		}else{
			$off_q = "SELECT *,tblofficials.id as id, tblposition.id as pos_id FROM tblofficials JOIN tblposition ON tblposition.id=tblofficials.position ORDER BY 'id' DESC ";
		}
	}else{
		$off_q = "SELECT *,tblofficials.id as id, tblposition.id as pos_id FROM tblofficials JOIN tblposition ON tblposition.id=tblofficials.position WHERE `status`='Active'";
	}
	
	$res_o = $conn->query($off_q);

	$official = array();
	while($row = $res_o->fetch_assoc()){
		$official[] = $row; 
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
							<h2 class="text-black fw-bold" style = "font-size: 300%;">Barangay Officials & SK Members</h2>
						</div>
					</div>
				</div>
				<div class="page-inner">
				<?php if(isset($_SESSION['message'])): ?>
						<div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?php echo $_SESSION['message']; ?>
						</div>
					<?php unset($_SESSION['message']); ?>
					<?php endif ?>
					<div class="row">						
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="text-center">
											<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/bg-abstract.png' ?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">Current Barangay Officials</div>
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
													<i class="fa fa-plus"></i>
													Add Official
												</a>
												<a href="model/export_officials_staff_csv.php" class="btn btn-danger btn-border btn-round btn-sm">
													<i class="fa fa-file"></i>
													Export CSV
												</a>
												<a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Filter Options
                                                </a>
                                                <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
													<div class="dropdown-item">
                                                        <label>Status:</label>
                                                        <select class="form-control" id="filterStatus" name="status" onclick="event.stopPropagation();">
                                                            <option value="">All</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="dropdown-item">
                                                        <label>Select types of Position:</label>
                                                        <select class="form-control" id="filterCert" name="cert_name" onclick="event.stopPropagation();">
                                                            <option value="">All</option>
                                                            <option value="Punong Barangay">Punong Barangay</option>
                                                            <option value="Secretary">Secretary</option>
                                                            <option value="Treasurer">Treasurer</option>
                                                            <option value="Kagawad">Kagawad</option>
                                                            <option value="SK Chairman">SK Chairman</option>
                                                            <option value="SK Kagawad">SK Kagawad</option>
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
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr>
													<th scope="col">Fullname</th>
													<th scope="col">Position</th>
													<th scope="col">Address</th>
													<th scope="col">Term-Start</th>
													<th scope="col">Term-End</th>
													<?php if(isset($_SESSION['username'])):?>
														<?php if($_SESSION['role']=='administrator'):?>
														<th>Status</th>
														<?php endif ?>
														<th class="text-center">Action</th>
													<?php endif?>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($official)): ?>
													<?php foreach ($official as $row): ?>
														<tr>
															<td>
																<div class="avatar avatar-xs mr-2">
																	<img src="<?= (preg_match('/data:image/i', $row['picture'])) ? $row['picture'] : ('assets/uploads/officials_profile/' . $row['picture']) ?>" alt="Officials-Profile" class="avatar-img rounded-circle">
																</div>
																<?= ucwords($row['fullname']) ?>
															</td>
															<td><?= $row['position'] ?></td>
															<td><?= $row['address'] ?></td>
															<td><?= $row['termstart'] ?></td>
															<td><?= $row['termend'] ?></td>
															<?php if (isset($_SESSION['username'])): ?>
																<?php if ($_SESSION['role'] == 'administrator'): ?>
																	<td><?= $row['status'] == 'Active' ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
																<?php endif ?>
																<td class="text-center">
																	<div class="form-button-action">
																		<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary"
																			title="Edit Officials" onclick="editOfficial(this)" data-id="<?= $row['id'] ?>" data-img="<?= $row['picture'] ?>" data-name="<?= $row['fullname'] ?>"
																			data-pos="<?= $row['pos_id'] ?>" data-add="<?= $row['address'] ?>" data-start="<?= $row['termstart'] ?>"
																			data-end="<?= $row['termend'] ?>" data-status="<?= $row['status'] ?>">
																			<i class="fas fa-edit"></i>
																		</a>
                                                                    <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'administrator')):?>
                                                                        <a type="button" class="btn btn-link btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </a>
                                                                    <?php endif ?>
																	</div>
																</td>
															<?php endif ?>
														</tr>
													<?php endforeach ?>
												<?php else: ?>
													<tr>
														<td colspan="10" class="text-center">No Available Data</td>
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
			<?php foreach ($official as $row) { ?>
        <div class="modal fade" id="confirmDeleteModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="mt-3 modal-body text-center" style="font-size: 16px;">
                        Are you certain you want to remove <?= $row['position'] ?> <strong><?= $row['fullname'] ?></strong>?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/remove_official.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center">No</button>
                            <button type="submit" class="btn btn-primary text-center">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
			<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Official</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_official.php" enctype="multipart/form-data">
								<div class="text-center">
									<div style="height: 250px;" class="text-center" id="my_camera">
										<img src="assets/img/person.png" alt="..." class="img img-fluid" width="250">
									</div>
									<?php if(isset($_SESSION['username'])):?>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                    </div>
                                    <div id="profileImage">
                                        <input type="hidden" name="picture">
                                    </div>
                                    <div class="form-group">
										<input type="file" class="form-control" name="image" accept=".jpeg, .jpg, .png" required>
                                    </div>
									<?php endif ?>
								</div>
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" placeholder="Enter Fullname" name="fullname" required>
                                </div>
								<div class="form-group">
                                    <label>Position</label>
                                    <select class="form-control" id="pillSelect" required name="position">
                                        <option disabled selected>Select Official Position</option>
										<?php foreach($position as $row): ?>
											<option value="<?= $row['id'] ?>">Barangay <?= $row['position'] ?></option>
										<?php endforeach ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address" required>
                                </div>
								<div class="form-group">
                                    <label>Term Start</label>
                                    <input type="date" class="form-control" name="start" required>
                                </div>
								<div class="form-group">
                                    <label>Term End</label>
                                    <input type="date" class="form-control" name="end" required>
                                </div>
								<div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="pillSelect" required name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
								<div class="mt-2 d-flex justify-content-center">
									<input type="hidden" id="pos_id" name="id">
									<button type="submit" class="btn btn-danger">Submit</button>
								</div>
                        	</div>
                        </form>
                    </div>
                </div>
            </div>
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Official</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_official.php" enctype="multipart/form-data">
								<div class="text-center">
                                    <div id="my_camera1" style="height: 250;" class="text-center">
                                        <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                    </div>
									<?php if(isset($_SESSION['username'])):?>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                    </div>
                                    <div id="profileImage">
                                        <input type="hidden" name="picture">
                                    </div>
                                    <div class="form-group">
										<input type="file" class="form-control" name="image" accept=".jpeg, .jpg, .png" required>
                                    </div>
									<?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" placeholder="Enter Fullname" name="fullname"  id="name" required>
                                </div>
								<div class="form-group">
                                    <label>Position</label>
                                    <select class="form-control" id="position" required name="position">
                                        <option disabled selected>Select Official Position</option>
										<?php foreach($position as $row): ?>
											<option value="<?= $row['id'] ?>">Barangay <?= $row['position'] ?></option>
										<?php endforeach ?>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address" id="address" required>
                                </div>
								<div class="form-group">
                                    <label>Term Start</label>
                                    <input type="date" class="form-control" id="start" name="start" required>
                                </div>
								<div class="form-group">
                                    <label>Term End</label>
                                    <input type="date" class="form-control" id="end" name="end" required>
                                </div>
								<div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" required name="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
								<div class="mt-4 d-flex justify-content-center">
									<input type="hidden" id="off_id" name="id">
									<button type="submit" class="btn btn-primary">Change</button>
								</div>
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
  const filterStatus = document.getElementById("filterStatus");
  const filterCert = document.getElementById("filterCert");
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const statusValue = filterStatus.value.toLowerCase();
    const certValue = filterCert.value.toLowerCase();
    const rowStatus = row.querySelector("td:nth-child(6)").textContent.toLowerCase();
    const rowCert = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
    const rowDate = new Date(row.querySelector("td:nth-child(4)").textContent);
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
	function editOfficial(that){
			brgyid = $(that).attr('data-brgyid');
			pic    = $(that).attr('data-img');
			id = $(that).attr('data-id');
			name = $(that).attr('data-name');
			pos = $(that).attr('data-pos');
			address = $(that).attr('data-add');
			start = $(that).attr('data-start');
			end = $(that).attr('data-end');
			status = $(that).attr('data-status');
			
			$('#barangay_id').val(brgyid);
			$('#off_id').val(id);
			$('#name').val(name);
			$('#position').val(pos);
			$('#address').val(address);
			$('#start').val(start);
			$('#end').val(end);
			$('#status').val(status);

			var str = pic;
			var n = str.includes("data:image");
			if(!n){
				pic = 'assets/uploads/resident_profile/'+pic;
			}
			$('#image').attr('src', pic);
		}
	</script>
</body>
</html>