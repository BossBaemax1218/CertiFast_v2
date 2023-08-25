<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tblposition ORDER BY id ASC";
    $result = $conn->query($query);

    $position = array();
	while($row = $result->fetch_assoc()){
		$position[] = $row; 
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
								<h2 class="text-black fw-bold" style="font-size: 300%">Position Management</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt-2">
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
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>   
												Add Position
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($position)): ?>
                                                    <?php $no=1; foreach($position as $row): ?>
                                                    <tr class="text-center">
                                                        <td><?= $no ?></td>
                                                        <td><?= $row['position'] ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" 
                                                                    title="Edit Position" onclick="editPos(this)" data-pos="<?= $row['position'] ?>" data-id="<?= $row['id'] ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <!--<a type="button" data-toggle="tooltip" href="model/remove_position.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this position?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>-->
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $no++; endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Available Data</td>
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
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Position</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_position.php" >
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" placeholder="Enter Position" name="position" required>
                            </div>
                        </div>
                        <div class="modal-footer mt-2 d-flex justify-content-center">
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_position.php" >
                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" id="position" placeholder="Position" name="position" required>
                            </div>                          
                        </div>
                        <div class="modal-footer mt-2 d-flex justify-content-center">
                            <input type="hidden" id="pos_id" name="id">
                            <button type="submit" class="btn btn-primary">Change</button>
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