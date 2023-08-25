<?php include 'server/server.php' ?>
<?php 
    
	$query = "SELECT * FROM `tblresident` WHERE residency_status='approved' ORDER BY `id` DESC";
    $result = $conn->query($query);

    $resident = array();
    while ($row = $result->fetch_assoc()) {
        $status = $row['residency_status'];
        $statusBadge = '';
        if ($status == 'on hold') {
            $statusBadge = '<span class="badge badge-warning">On Hold</span>';
        } elseif ($status == 'approved') {
            $statusBadge = '<span class="badge badge-primary">Approved</span>';
        }

    
        $row['residency_badge'] = $statusBadge;
        $resident[] = $row;
    }

    $query1 = "SELECT * FROM tblpurok";
    $result1 = $conn->query($query1);

    $purok = array();
	while($row2 = $result1->fetch_assoc()){
		$purok[] = $row2; 
	}

    $query1 = "SELECT COUNT(*) AS total_resident FROM tblresident";
    $result1 = $conn->query($query1);
    
    if ($result1 && $result1->num_rows > 0) {
        $row3 = $result1->fetch_assoc();
        $totalresident = $row3['total_resident'];
    } else {
        $totalresident = 0;
    }

	$query2 = "SELECT * FROM tblresident WHERE voterstatus='Yes'";
    $result2 = $conn->query($query2);
	$votersyes= $result2->num_rows;

	$query3 = "SELECT * FROM tblresident WHERE voterstatus='No'";
    $result3 = $conn->query($query3);
	$votersno= $result3->num_rows;
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
								<h1 class="text-center fw-bold" style="font-size: 300%;">Resident Reports</h1>
							</div>
						</div>
					</div>
				</div>
                <div class="page-inner mt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-stats card card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-user fa-2x" style="color: gray;"></i>
                                            </div>
                                        </div>
                                        <div class="col-2 col-stats">
                                        </div>
                                        <div class="col-2 col-stats">
                                            <div class="numbers mt-2">
                                                <h2 class="text-uppercase" style="font-size: 16px;">Residents</h2>
                                                <h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($totalresident) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-user-check fa-2x" style="color: gray;"></i>
                                            </div>
                                        </div>
                                        <div class="col-2 col-stats">
                                        </div>
                                        <div class="col-2 col-stats">
                                            <div class="numbers mt-2">
                                                <h2 class="text-uppercase" style="font-size: 16px;">Voters</h2>
                                                <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($votersyes) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-user-times fa-2x" style="color: gray;"></i>
                                            </div>
                                        </div>
                                        <div class="col-2 col-stats">
                                        </div>
                                        <div class="col-2 col-stats">
                                            <div class="numbers mt-2">
                                                <h2 class="text-uppercase" style="font-size: 16px;">NonVoters</h2>
                                                <h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($votersno) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">                                    
                                    </div>
                                </div>
                            </div>
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
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title"></div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
											<a href="#add" data-toggle="modal" class="btn btn-info btn-border btn-round btn-sm">
												<i class="fa fa-plus"></i>
												Resident
											</a>
                                            <a href="model/export_resident_csv.php" class="btn btn-danger btn-border btn-round btn-sm">
												<i class="fa fa-file"></i>
												Export CSV
											</a>
                                            <a class="btn btn-info btn-border btn-round btn-sm dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filter Options
                                            </a>
                                            <div class="dropdown-menu mt-3 mr-3" aria-labelledby="filterDropdown">
                                                <div class="dropdown-item">
                                                    <label>From Date:</label>
                                                    <input type="date" class="form-control" id="fromDate" placeholder="Select date range">
                                                </div>
                                                <div class="dropdown-item">
                                                    <label>To Date:</label>
                                                    <input type="date" class="form-control" id="toDate" placeholder="Select date range">
                                                </div>
                                                <div class="dropdown-item">
                                                    <button type="button" class="form-control btn btn-outline-primary" id="clearFilters">Clear Filter</button>
                                                </div>
                                            </div>
										</div>
                                        <?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr>
												    <th scope="col">Barangay ID</th>
													<th class="text-center" scope="col">Fullname</th>												
													<th scope="col">Birthdate</th>
                                                    <th scope="col">Email</th>
													<th scope="col">Purok</th>
                                                    <th scope="col">Voters</th>
                                                    <th class="text-center" scope="col"> Purok Leader Status</th>
                                                    <?php if(isset($_SESSION['username'])):?>
                                                        <?php if($_SESSION['role']=='administrator'):?>
													
                                                    <?php endif ?>
													<th class="text-center" scope="col">Action</th>
                                                    <?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
													    <td><?= $row['national_id'] ?></td>
														<td>
                                                            <div class="avatar avatar-xs ml-3">
                                                                <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/'.$row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                            </div>
                                                            <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                        </td>														
														<td><?= $row['birthdate'] ?></td>
                                                        <td><?= $row['email'] ?></td>
                                                        <td><?= $row['purok'] ?></td>
                                                        <td><?= $row['voterstatus'] ?></td>
                                                        <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                        <?php if(isset($_SESSION['username'])):?>
                                                            
                                                            <?php if($_SESSION['role']=='administrator'):?>
                                                        
                                                        <?php endif ?>
														<td class="text-center">
															<div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" 
                                                                    data-id="<?= $row['id'] ?>" data-national="<?= $row['national_id'] ?>" data-fname="<?= $row['firstname'] ?>" data-mname="<?= $row['middlename'] ?>" data-lname="<?= $row['lastname'] ?>" data-address="<?= $row['address'] ?>" data-bplace="<?= $row['birthplace'] ?>" data-bdate="<?= $row['birthdate'] ?>" data-age="<?= $row['age'] ?>"
                                                                    data-cstatus="<?= $row['civilstatus'] ?>" data-gender="<?= $row['gender'] ?>"data-purok="<?= $row['purok'] ?>" data-vstatus="<?= $row['voterstatus'] ?>" data-taxno="<?= $row['taxno'] ?>" data-number="<?= $row['phone'] ?>" data-email="<?= $row['email'] ?>" data-occu="<?= $row['occupation'] ?>" data-remarks="<?= $row['remarks'] ?>" 
                                                                    data-img="<?= $row['picture'] ?>" data-citi="<?= $row['citizenship'];?>" data-dead="<?= $row['resident_type'];?>">
                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                        <i class="fas fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
                                                                <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
																<a type="button" data-toggle="tooltip" href="generate_resident.php?id=<?= $row['id'] ?>" class="btn btn-link btn-info" data-original-title="Generate">
                                                                    <i class="fas fa-print"></i>
																</a>
                                                                <?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'administrator')):?>
                                                                    <a type="button" class="btn btn-link btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $row['id'] ?>" data-original-title="Remove">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </a>
                                                                <?php endif ?>
                                                                <?php endif ?>
															</div>
														</td>
                                                        <?php endif ?>														
													</tr>
													<?php $no++; endforeach ?>
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
		<?php foreach ($resident as $row) { ?>
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
                        Are you certain you want to remove ID no. <strong><?= $row['national_id'] ?></strong> named <strong><?= ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname']) ?></strong>?
                    </div>
                    <div class="modal-footer mt-2 d-flex justify-content-center">
                        <form method="post" action="model/remove_resident.php">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="button" class="btn btn-danger text-center mr-2" data-dismiss="modal">No</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <form method="POST" action="model/save_resident.php" enctype="multipart/form-data">
                                    <input type="hidden" name="size" value="1000000">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="height: 250;" class="text-center" id="my_camera">
                                                    <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                                </div>
                                                <?php if(isset($_SESSION['username'])):?>
                                                <div class="form-group d-flex justify-content-center">
                                                    <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open Camera</button>
                                                    <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo()">Capture</button>   
                                                </div>
                                                <div id="profileImage">
                                                    <input type="hidden" name="profileimg">
                                                </div>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="img" accept="image/*">
                                                </div>
                                                <?php endif ?>
                                                <div class="form-group text-center">
                                                    <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="deceased" value="1" class="selectgroup-input" checked="">
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
                                                        </label><p class="mt-1 mr-3"><b>Alive</b></p>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="deceased" value="0" class="selectgroup-input">
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
                                                        </label><p  class="mt-1 mr-3"><b>Deceased</b></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Barangay ID No.</label>
                                                    <input type="text" class="form-control" name="national" placeholder="Barangay ID No." required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Citizenship</label>
                                                    <input type="text" class="form-control" name="citizenship" placeholder="Citizenship" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>First name</label>
                                                    <input type="text" class="form-control" placeholder="First name" name="fname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Middle name</label>
                                                    <input type="text" class="form-control" placeholder="Middle name" name="mname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Last name</label>
                                                    <input type="text" class="form-control" placeholder="Last name" name="lname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" placeholder="Address" name="address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control" placeholder="Birthplace" name="bplace" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="date" class="form-control" placeholder="Birthdate" name="bdate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Age" min="1" name="age" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Civil Status</label>
                                                    <select class="form-control" name="cstatus">
                                                        <option disabled selected>Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widow">Widow</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" required name="gender">
                                                        <option disabled selected value="">Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Purok</label>
                                                    <select class="form-control" required name="purok">
                                                        <option disabled selected>Select Purok Name</option>
                                                        <?php foreach($purok as $row):?>
                                                            <option value="<?= ucwords($row['purok']) ?>"><?= $row['purok'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus">
                                                        <option disabled selected>Select Voters Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tax no</label>
                                                    <input type="number" class="form-control" placeholder="0000-000-000" min="6" name="taxno" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="no-email@sample.com" value="" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="+63 000-000-000-00" value="" name="number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Occupation" name="occupation" required>
                                                </div>
                                                <!--<div class="form-group">
                                                    <label>Requirements</label>
                                                    <textarea class="form-control" name="remarks" required placeholder="Ex: (4ps Requirements)"></textarea>
                                                </div>-->
                                            </div>
                                        </div>
                                        <div class="modal-footer mt-2 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Save</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Update Resident Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="model/edit_resident.php" enctype="multipart/form-data">
                                        <input type="hidden" name="size" value="1000000">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="my_camera1" style="height: 250;" class="text-center">
                                                    <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" id="image">
                                                </div>
                                                <?php if(isset($_SESSION['username'])):?>
                                                    <div class="form-group d-flex justify-content-center">
                                                        <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam1">Open Camera</button>
                                                        <button type="button" class="btn btn-secondary btn-sm ml-2" onclick="save_photo1()">Capture</button>   
                                                    </div>
                                                    <div id="profileImage1">
                                                        <input type="hidden" name="profileimg">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="file" class="form-control" name="img" accept="image/*">
                                                    </div>
                                                <?php endif ?>
                                                <div class="form-group text-center">
                                                    <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="deceased" value="1" class="selectgroup-input" checked="" id="alive">
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-walking"></i></span>
                                                        </label><p class="mt-1 mr-3"><b>Alive</b></p>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="deceased" value="0" class="selectgroup-input" id="dead">
                                                            <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-people-carry"></i></span>
                                                        </label><p  class="mt-1 mr-3"><b>Deceased</b></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Barangay ID</label>
                                                    <input type="text" class="form-control" name="national" id="nat_id" placeholder="Enter Barangay ID" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Citizenship</label>
                                                    <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Enter citizenship" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>First name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" id="fname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Middle name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" id="mname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Last name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" id="lname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" placeholder="Enter Address" id="address" name="address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" id="bplace" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age" id="age" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Civil Status</label>
                                                    <select class="form-control" required name="cstatus" id="cstatus">
                                                        <option disabled selected>Select Civil Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widow">Widow</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sex</label>
                                                    <select class="form-control" required name="gender" id="gender">
                                                        <option disabled selected value="">Select Sex</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Purok</label>
                                                    <select class="form-control" required name="purok" id="purok">
                                                        <option disabled selected>Select Purok Name</option>
                                                        <?php foreach($purok as $row):?>
                                                            <option value="<?= ucwords($row['purok']) ?>"><?= $row['purok'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus" id="vstatus">
                                                        <option disabled selected>Select Voters Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tax no</label>
                                                    <input type="text" class="form-control" placeholder="Enter Tax No." name="taxno" id="taxno">
                                                </div>                        
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="Enter Email Address" name="email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" id="number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation" required>
                                                </div>
                                                <!--<div class="form-group">
                                                    <label>Requirements</label>
                                                    <textarea class="form-control" name="remarks" placeholder="Enter Remarks" id="remarks"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Purpose</label>
                                                    <textarea class="form-control" name="purpose" placeholder="Enter Purpose" id="purpose"></textarea>
                                                </div>-->
                                            </div>
                                        </div>
                                        <div class="modal-footer mt-2 d-flex justify-content-center">
                                            <input type="hidden" name="id" id="res_id">
                                            <?php if(isset($_SESSION['username'])): ?>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <?php endif ?>
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
document.addEventListener("DOMContentLoaded", function () {
  const fromDate = document.getElementById("fromDate");
  const toDate = document.getElementById("toDate");
  const clearFiltersBtn = document.getElementById("clearFilters");
  
  const tableRows = document.querySelectorAll("#residenttable tbody tr");
  
  function rowMatchesFilter(row) {
    const rowDate = new Date(row.querySelector("td:nth-child(2)").textContent);
    const from = new Date(fromDate.value);
    const to = new Date(toDate.value);

    return (isNaN(from) || rowDate >= from) &&
           (isNaN(to) || rowDate <= to);
  }
  
  function applyFilter() {
    tableRows.forEach(row => {
      const shouldDisplay = rowMatchesFilter(row);
      row.style.display = shouldDisplay ? "table-row" : "none";
    });
  }

  function clearFilters() {
    fromDate.value = "";
    toDate.value = "";
    applyFilter();
  }

  fromDate.addEventListener("change", applyFilter);
  toDate.addEventListener("change", applyFilter);
  clearFiltersBtn.addEventListener("click", clearFilters);
});
</script>
    <script>
function editResident(that){
    id          = $(that).attr('data-id');
    pic         = $(that).attr('data-img');
    nat_id 		= $(that).attr('data-national');
    fname 		= $(that).attr('data-fname');
	mname 		= $(that).attr('data-mname');
    lname 		= $(that).attr('data-lname');
	address 	= $(that).attr('data-address');
    bplace 	    = $(that).attr('data-bplace');
	bdate 		= $(that).attr('data-bdate');
    age 		= $(that).attr('data-age');
    cstatus 	= $(that).attr('data-cstatus');
	gender 	    = $(that).attr('data-gender');
    purok 		= $(that).attr('data-purok');
	vstatus 	= $(that).attr('data-vstatus');
    email 	    = $(that).attr('data-email');
	number 	    = $(that).attr('data-number');
    taxno 	    = $(that).attr('data-taxno');
    citi 	    = $(that).attr('data-citi');
    occu 	    = $(that).attr('data-occu');
    dead 	    = $(that).attr('data-dead');
    remarks 	= $(that).attr('data-remarks');
    purpose 	= $(that).attr('data-purpose');

    $('#res_id').val(id);
    $('#nat_id').val(nat_id);
    $('#fname').val(fname);
    $('#mname').val(mname);
    $('#lname').val(lname);
    $('#address').val(address);
    $('#bplace').val(bplace);
    $('#bdate').val(bdate);
    $('#age').val(age);
    $('#cstatus').val(cstatus);
    $('#gender').val(gender);
    $('#purok').val(purok);
    $('#vstatus').val(vstatus);
    $('#taxno').val(taxno);
    $('#email').val(email);
    $('#number').val(number);
    $('#occupation').val(occu);
    $('#citizenship').val(citi);
    $('#remarks').val(remarks);
    $('#purpose').val(purpose);

    if(dead==1){
        $("#alive").prop("checked", true);
    }else{
        $("#dead").prop("checked", true);
    }

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