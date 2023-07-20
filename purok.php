<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tblpurok";
    $result = $conn->query($query);

    $purok = array();
	while($row = $result->fetch_assoc()){
		$purok[] = $row; 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Purok</title>
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
										<div class="card-title">Barangay Purok</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-danger btn-border btn-round btn-sm">
												<i class="fa fa-plus"> </i>   
												Add Purok
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Purok</th>
                                                    <th scope="col">Purok Leader</th>
                                                    <th scope="col">No. of Residents</th>
                                                    <th scope="col">No. of Households</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($purok)): ?>
                                                    <?php $no=1; foreach($purok as $row): ?>
                                                    <tr class="text-center">
                                                        <td><?= $no ?></td>
                                                        <td><?= $row['purok'] ?></td>
                                                        <td><?= $row['purok_leader'] ?></td>
                                                        <td><?= $row['total_residents'] ?></td>
                                                        <td><?= $row['total_households'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Purok" onclick="editPurok(this)" 
                                                                    data-name="<?= $row['purok'] ?>" data-res="<?= $row['total_residents'] ?>" data-hh="<?= $row['total_households'] ?>" data-id="<?= $row['id'] ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_purok.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this purok?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fas fa-trash"></i>
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

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Purok</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_purok.php" >
                                <div class="form-group">
                                    <label>Purok Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Purok Name" name="purok" required>
                                </div>
                                <div class="form-group">
                                    <label>Purok Leader</label>
                                    <input type="text" class="form-control" placeholder="Enter Purok Name" name="purok_leader" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Residents</label>
                                    <input type="text" class="form-control" placeholder="Enter No. of Residents" name="total_residents" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Households</label>
                                    <input type="text" class="form-control" placeholder="Enter No. of Households" name="total_households" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Purok</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_purok.php" >
                                <div class="form-group">
                                    <label>Purok Name</label>
                                    <input type="text" class="form-control" id="purok" placeholder="Enter Purok Name" name="purok" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Residents</label>
                                    <input type="text" class="form-control" id="residents" placeholder="Enter No. of Residents" name="residents" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Households</label>
                                    <input type="text" class="form-control" id="households" placeholder="Enter No. of Households" name="households" required>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="purok_id" name="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>