<?php include 'server/server.php' ?>
<?php
    $query = "SELECT * FROM tblpurok";
    $result = $conn->query($query);

    $puroklist = array();
	while($row = $result->fetch_assoc()){
		$puroklist[] = $row; 
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
		<div class="main-panel mt-3">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-black fw-bold" style = "font-size: 300%;">Purok Management</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt-1">
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
										<div class="card-title">Barangay Purok</div>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-light btn-border btn-sm">
												<i class="fa fa-plus"> </i>   
												Add Purok
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
                                                    <th scope="col">Purok</th>
                                                    <th scope="col">Purok Leader</th>
                                                    <th scope="col">Contact</th>
                                                    <th scope="col">No. of Residents</th>
                                                    <th scope="col">No. of Households</th>
                                                    <th  class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($puroklist)): ?>
                                                    <?php $no=1; foreach($puroklist as $row): ?>
                                                    <tr class="text-center">
                                                        <td><?= $no ?></td>
                                                        <td><?= $row['purok'] ?></td>
                                                        <td><?= $row['purok_leader'] ?></td>
                                                        <td><?= $row['contact_number'] ?></td>
                                                        <td><?= $row['total_residents'] ?></td>
                                                        <td><?= $row['total_households'] ?></td>
                                                        <td  class="text-center">
                                                            <div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="Edit Purok" onclick="editPurok(this)" 
                                                                    data-name="<?= $row['purok'] ?>" data-purok_leader="<?= $row['purok_leader'] ?>" data-contact_number="<?= $row['contact_number'] ?>" data-total_residents="<?= $row['total_residents'] ?>" data-total_households="<?= $row['total_households'] ?>" data-id="<?= $row['id'] ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <!--<a type="button" data-toggle="tooltip" href="model/remove_purok.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this purok?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>-->
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
                            <h5 class="modal-title" id="exampleModalLabel">Create New Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_purok.php" >
                                <div class="form-group">
                                    <label>Purok</label>
                                    <input type="text" class="form-control" placeholder="Enter Purok Name" name="purok" required>
                                </div>
                                <div class="form-group">
                                    <label>Purok Leader</label>
                                    <input type="text" class="form-control" placeholder="Enter Purok Name" name="purok_leader" required>
                                </div>
                                <div class="form-group">
                                    <label>Contact Number (Optional)</label>
                                    <input type="text" class="form-control" placeholder="+63 000 000 0000" name="contact_number" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Residents</label>
                                    <input type="text" class="form-control" placeholder="Enter No. of Residents" name="total_residents" required>
                                </div>
                                <div class="form-group">
                                    <label>No. of Households</label>
                                    <input type="text" class="form-control" placeholder="Enter No. of Households" name="total_households" required>
                                </div>                           
                                <div class="mt-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change Information</h5>
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
                                        <label>Purok Leader</label>
                                        <input type="text" class="form-control" placeholder="Enter Purok Name" name="purok_leader" id="purok_leader" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number (Optional)</label>
                                        <input type="text" class="form-control" placeholder="+63 000 000 0000" name="contact_number" id="contact_number" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. of Residents</label>
                                        <input type="text" class="form-control" id="total_residents" placeholder="Enter No. of Residents" name="total_residents" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. of Households</label>
                                        <input type="text" class="form-control" id="total_households" placeholder="Enter No. of Households" name="total_households" required>
                                    </div>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <input type="hidden" id="purok_id" name="id">
                                        <button type="submit" class="btn btn-danger">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			<?php include 'templates/main-footer.php' ?>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
        function editPurok(that){
            purok = $(that).attr('data-name');
            purok_leader = $(that).attr('data-purok_leader');
            contact_number = $(that).attr('data-contact_number');
            total_residents = $(that).attr('data-total_residents');
            total_households = $(that).attr('data-total_households');
            id = $(that).attr('data-id');

            $('#purok').val(purok);
            $('#purok_leader').val(purok_leader);
            $('#contact_number').val(contact_number);
            $('#total_residents').val(total_residents);
            $('#total_households').val(total_households);
            $('#purok_id').val(id);
        }
    </script>
</body>
</html>