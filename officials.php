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
	<title>Barangay Official's & Staff's</title>
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
								<h2 class="text-black fw-bold" style = "font-size: 300%;">Barangay Officials & SK Members</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row mt-2">						
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
											<div class="text-center">
												<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/bg-abstract.png' ?>" />
											</div>
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
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<!--<th scope="col">Barangay ID</th>-->
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
															<!--<td><?= $row['barangay_id'] ?></td>-->
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
																	<a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary"
																		title="Edit Position" onclick="editOfficial(this)" data-id="<?= $row['id'] ?>" data-img="<?= $row['picture'] ?>" data-name="<?= $row['fullname'] ?>"
																		data-pos="<?= $row['pos_id'] ?>" data-add="<?= $row['address'] ?>" data-start="<?= $row['termstart'] ?>"
																		data-end="<?= $row['termend'] ?>" data-status="<?= $row['status'] ?>">
																		<i class="fas fa-edit"></i>
																	</a>
																	<?php if ($_SESSION['role'] == 'administrator'): ?>
																		<a type="button" data-toggle="tooltip" href="model/remove_official.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this official?');" class="btn btn-link btn-danger" data-original-title="Remove">
																			<i class="fas fa-trash"></i>
																		</a>
																	<?php endif ?>
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
			 <!-- Modal -->
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
									<div id="my_camera" style="height: 250px;" class="text-center">
										<img src="assets/img/person.png" alt="..." class="img img-fluid" width="250">
									</div>
									<div class="form-group d-flex justify-content-center">
										<button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
										<button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
									</div>
									<div id="profileImage">
										<input type="hidden" name="picture" value="">
									</div>
									<div class="form-group">
										<input type="file" class="form-control" name="image" accept=".jpeg, .jpg, .png" required>
									</div>
								</div>
								<!--<div class="form-group">
									<label>Barangay ID</label>
									<input type="text" class="form-control" name="barangay_id" placeholder="Enter Barangay ID No." required>
								</div>-->
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
                        	</div>
							<div class="modal-footer">
								<input type="hidden" id="pos_id" name="id">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-danger">Create</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Modal -->
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
                                    <div id="my_camera" style="height: 250;" class="text-center">
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
								<!--<div class="form-group">
									<label>Barangay ID</label>
									<input type="text" class="form-control" name="barangay_id" id="barangay_id" placeholder="Enter Barangay ID No.">
								</div>-->
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
                            </div>
							<div class="modal-footer">
								<input type="hidden" id="off_id" name="id">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'templates/main-footer.php' ?>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>