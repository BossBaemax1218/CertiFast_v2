<?php include 'server/db_connection.php' ?>
<?php 
    if (!isset($_SESSION["fullname"])) {
        header("Location: login.php");
        exit;
    }

$fullname = $_SESSION["fullname"];

$sql = "SELECT *, tblresident.id, tblresident.purok FROM tblresident JOIN tbl_user_resident ON tblresident.email = tbl_user_resident.user_email WHERE tbl_user_resident.fullname = ? AND tblresident.residency_status IN ('on hold', 'approved','rejected')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();

$resident = array();
$approvedResidents = array();

while ($row = $result->fetch_assoc()) {
    $status = $row['residency_status'];
    $statusBadge = '';

    if ($status == 'on hold') {
        $statusBadge = '<span class="badge badge-warning">On Hold</span>';
    }elseif ($status == 'approved') {
            $statusBadge = '<span class="badge badge-success">Approved</span>';
    } elseif ($status == 'rejected') {
        $statusBadge = '<span class="badge badge-danger">Rejected</span>';
    }

    $row['residency_badge'] = $statusBadge;

    if ($status == 'on hold') {
        $resident[] = $row;
    } elseif ($status == 'approved') {
        $resident[] = $row;
    } elseif ($status == 'rejected') {
        $resident[] = $row;
    }
}

$query1 = "SELECT * FROM tblpurok";
$result1 = $conn->query($query1);

$purok = array();
while($row = $result1->fetch_assoc()){
    $purok[] = $row; 
}

$conn->close();
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
		<?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner mt-2">
						<div class="d-flex align-items-center align-items-md-center flex-column">
                            <h1 class="text-center fw-bold" style="font-size: 400%;">Resident Profiling</h1>
                            <h3 class="text-center">Please registered your personal information first before you requested any of the certifications in Barangay Los Amigos.</h3>
						</div>
                        <?php if(isset($_SESSION['fullname'])):?>
                        <h4 class="text-center fw-bold mt-5 mb-2">
                            <a href="#add" data-toggle="modal" class="btn-request-now" style="text-decoration: none; color:white;" <?php echo isset($_SESSION['success']) || $nat > 0 ? 'disabled' : ''; ?>>
                                CLICK HERE TO REGISTER YOUR PERSONAL DATA
                            </a>
                        </h4>
                        <?php endif ?>
                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif ?>
					</div>
				</div>
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Registration Status</div>
										<div class="card-tools">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr>
													<th class="text-center" scope="col">Fullname</th>												
													<th scope="col">Birthdate</th>
                                                    <th scope="col">Email</th>
													<th scope="col">Purok</th>
                                                    <th class="text-center" scope="col">Status</th>
                                                    <?php if(isset($_SESSION['fullname'])):?>
                                                        <?php if($_SESSION['role']=='resident'):?>
													
                                                    <?php endif ?>
													<th class="text-center" scope="col">Action</th>
                                                    <?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
														<td>
                                                            <div class="avatar avatar-xs ml-3">
                                                                <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/'.$row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                            </div>
                                                            <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                        </td>														
														<td><?= $row['birthdate'] ?></td>
                                                        <td><?= $row['email'] ?></td>
                                                        <td><?= $row['purok'] ?></td>
                                                        <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                        <?php if(isset($_SESSION['fullname'])):?>
                                                            
                                                            <?php if($_SESSION['role']=='resident'):?>
                                                        
                                                        <?php endif ?>
														<td class="text-center">
															<div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" 
                                                                    data-id="<?= $row['id'] ?>" data-national="<?= $row['national_id'] ?>" data-fname="<?= $row['firstname'] ?>" data-mname="<?= $row['middlename'] ?>" data-lname="<?= $row['lastname'] ?>" data-address="<?= $row['address'] ?>" data-bplace="<?= $row['birthplace'] ?>" data-bdate="<?= $row['birthdate'] ?>" data-age="<?= $row['age'] ?>"
                                                                    data-cstatus="<?= $row['civilstatus'] ?>" data-gender="<?= $row['gender'] ?>"data-purok="<?= $row['purok'] ?>" data-vstatus="<?= $row['voterstatus'] ?>" data-taxno="<?= $row['taxno'] ?>" data-number="<?= $row['phone'] ?>" data-email="<?= $row['email'] ?>" data-occu="<?= $row['occupation'] ?>" data-remarks="<?= $row['remarks'] ?>" 
                                                                    data-img="<?= $row['picture'] ?>" data-citi="<?= $row['citizenship'];?>" data-dead="<?= $row['resident_type'];?>" data-purpose="<?= $row['purpose'] ?>">
                                                                    <?php if(isset($_SESSION['username'])): ?>
                                                                        <i class="fas fa-edit"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
                                                                <?php if(isset($_SESSION['fullname']) && $_SESSION['role']=='resident'):?>
                                                                <a type="button" data-toggle="tooltip" href="model/remove_resident_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fas fa-trash"></i>
																</a>
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
                            <h5 class="text-left mt-2">Note: Please check that all of the information you registered are correct in order to prevent confusion during registering.</h5>
						</div>
					</div>
				</div>
			</div>
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <form method="POST" action="model/save_resident_user.php" enctype="multipart/form-data">
                                    <input type="hidden" name="size" value="1000000">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="height: 250;" class="text-center" id="my_camera">
                                                    <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                                </div>
                                                <?php if(isset($_SESSION['fullname'])):?>
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
                                                    <label>What is your Barangay ID No.</label>
                                                    <input type="text" class="form-control" name="national" placeholder="Ex: BLA - 0000-000" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Are you a Filipino or Half Filipino?</label>
                                                    <input type="text" class="form-control" name="citizenship" placeholder="Ex: Filipino" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>What is your first name?</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Joe Anne" name="fname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>What is your middle initial?</label>
                                                    <input type="text" class="form-control" placeholder="Ex: G." name="mname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>What is your surname?</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Aldoe" name="lname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>What is your current address?</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Tugbok, Los Amigos" name="address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>What is your birthdate?</label>
                                                    <input type="date" class="form-control" placeholder="Enter your birthdate" name="bdate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Where do you born?</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Tugbok, Los Amigos, Davao City" name="bplace" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>What is your current age?</label>
                                                    <input type="number" class="form-control" placeholder="Enter your age" min="1" name="age" required>
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
                                                    <label>Are you already a voters?</label>
                                                    <select class="form-control vstatus" required name="vstatus">
                                                        <option disabled selected>Select Voters Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="no-email@gmail.com" value="" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="+63 000-000-000-00" value="" name="number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Teacher" name="occupation" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Update Profiling Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="model/edit_resident_user.php" enctype="multipart/form-data">
                                        <input type="hidden" name="size" value="1000000">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="my_camera1" style="height: 250;" class="text-center">
                                                    <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" id="image">
                                                </div>
                                                <?php if(isset($_SESSION['fullname'])):?>
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
                                                    <input type="text" class="form-control" name="national" id="nat_id" placeholder="Ex: BLA - 0000-000" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Citizenship</label>
                                                    <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Ex: Filipino" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>First name</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Juan" name="fname" id="fname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Middle name</label>
                                                    <input type="text" class="form-control" placeholder="Ex: G." name="mname" id="mname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Last name</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Luna" name="lname" id="lname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Tugbok, Los Amigos" id="address" name="address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Tugbok, Los Amigos" name="bplace" id="bplace" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Age" min="1" name="age" id="age" required>
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
                                                    <label>Gender</label>
                                                    <select class="form-control" required name="gender" id="gender">
                                                        <option disabled selected value="">Select Gender</option>
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
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="no-sample@gmail.com" name="email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" placeholder="+63 000-000-0000" name="number" id="number" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" placeholder="Ex: Teacher" name="occupation" id="occupation" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="remarks" value="N/A" id="remarks">
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