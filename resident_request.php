<?php
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["fullname"];

$sql = "SELECT * FROM tblresident JOIN tbl_user_resident ON tblresident.email = tbl_user_resident.user_email WHERE tbl_user_resident.fullname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();

$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

$query1 = "SELECT * FROM tblpurok ORDER BY `purok`";
$result1 = $conn->query($query1);

$purok = array();
while($row2 = $result1->fetch_assoc()){
    $purok[] = $row2; 
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Submit Request</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
                <div>
                    <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                    <h3 class="text-center fw-bold"> Here are the steps in setting an registration request with CertiFast Portal. </h3>
                    <br>
                </div>
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
                            <?php if(isset($_SESSION['message'])): ?>
                                    <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                        <?php echo $_SESSION['message']; ?>
                                    </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                            <div class="card">
                            <h5 class="text-center fw-bold mt-5"><a href="#add" data-toggle="modal" class="btn-request-now" style="text-decoration: none; color:white;">CREATE</a></h5>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Purok</th>
                                                    <?php if (isset($_SESSION['fullname'])): ?>
                                                        <?php if ($_SESSION['role'] == 'resident'): ?>
                                                            
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resident)): ?>
                                                    <?php $no = 1; foreach ($resident as $row): ?>
                                                        <tr>
                                                            <td>
                                                                <div class="avatar avatar-xs ml-3">
                                                                    <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/'.$row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                                </div>
                                                                <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                            </td>
                                                            <td><?= $row['address'] ?></td>
                                                            <td><?= $row['birthdate'] ?></td>
                                                            <td><?= $row['age'] ?></td>
                                                            <td><?= $row['gender'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['purok'] ?></td>
                                                            <?php if (isset($_SESSION['fullname'])): ?>
                                                                <?php if ($_SESSION['role'] == 'resident'): ?>
                                                                    
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                            <td class="text-center">
                                                            <div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" 
                                                                    data-id="<?= $row['id'] ?>" 
                                                                    data-national="<?= $row['national_id'] ?>" 
                                                                    data-fname="<?= $row['firstname'] ?>" 
                                                                    data-mname="<?= $row['middlename'] ?>" 
                                                                    data-lname="<?= $row['lastname'] ?>" 
                                                                    data-address="<?= $row['address'] ?>" 
                                                                    data-bplace="<?= $row['birthplace'] ?>" 
                                                                    data-bdate="<?= $row['birthdate'] ?>" 
                                                                    data-age="<?= $row['age'] ?>"
                                                                    data-cstatus="<?= $row['civilstatus'] ?>" 
                                                                    data-gender="<?= $row['gender'] ?>"
                                                                    data-purok="<?= $row['purok'] ?>" 
                                                                    data-vstatus="<?= $row['voterstatus'] ?>" 
                                                                    data-taxno="<?= $row['taxno'] ?>" 
                                                                    data-number="<?= $row['phone'] ?>" 
                                                                    data-email="<?= $row['email'] ?>" 
                                                                    data-occu="<?= $row['occupation'] ?>" 
                                                                    data-remarks="<?= $row['remarks'] ?>" 
                                                                    data-img="<?= $row['picture'] ?>" 
                                                                    data-citi="<?= $row['citizenship'];?>" 
                                                                    data-dead="<?= $row['resident_type'];?>" 
                                                                    data-purpose="<?= $row['purpose'] ?>">
                                                                    <?php if (isset($_SESSION['fullname'])): ?>
                                                                    <i class="fas fa-edit"></i>
                                                                    <?php else: ?>
                                                                    <i class="fa fa-eye"></i>
                                                                    <?php endif ?>
                                                                </a>
                                                            </div>
                                                        </td>
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
        </div>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_resident_user.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                                <div class="col-md-4">
                                    <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                        <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250" >
                                    </div>
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
                                    <div class="form-group">
                                        <label>National ID No.</label>
                                        <input type="text" class="form-control" name="national" placeholder="Enter National ID No." required>
                                    </div>
                                    <div class="form-group">
                                        <label>Citizenship</label>
                                        <input type="text" class="form-control" name="citizenship" placeholder="Enter citizenship" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Enter Address" name="address" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Place of Birth</label>
                                                <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Birthdate</label>
                                                <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                <label>Civil Status</label>
                                                <select class="form-control" name="cstatus">
                                                    <option disabled selected>Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow">Widow</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" required name="gender">
                                                    <option disabled selected value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Purok</label>
                                                <select class="form-control" required name="purok">
                                                    <option disabled selected>Select Purok Name</option>
                                                    <?php foreach($purok as $row):?>
                                                        <option value="<?= ucwords($row['purok']) ?>"><?= $row['purok'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Voters Status</label>
                                                <select class="form-control vstatus" required name="vstatus">
                                                    <option disabled selected>Select Voters Status</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tax no</label>
                                                <input type="number" class="form-control" placeholder="Enter Tax number" min="6" name="taxno" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Enter Email Address" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" required placeholder="Enter Remarks"></textarea>
                                    </div>
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

            <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Resident Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_resident_user.php" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
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
                                    <div class="form-group">
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
                                        <label>National ID</label>
                                        <input type="text" class="form-control" name="national" id="nat_id" placeholder="Enter National ID" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Citizenship</label>
                                        <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Enter citizenship" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control" placeholder="Enter Firstname" name="fname" id="fname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Middlename</label>
                                                <input type="text" class="form-control" placeholder="Enter Middlename" name="mname" id="mname" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Lastname</label>
                                                <input type="text" class="form-control" placeholder="Enter Lastname" name="lname" id="lname" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Enter Address" id="address" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Place of Birth</label>
                                                <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" id="bplace" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Birthdate</label>
                                                <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age" id="age" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                <label>Civil Status</label>
                                                <select class="form-control" required name="cstatus" id="cstatus">
                                                    <option disabled selected>Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow">Widow</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Sex</label>
                                                <select class="form-control" required name="gender" id="gender">
                                                    <option disabled selected value="">Select Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Purok</label>
                                                <select class="form-control" required name="purok" id="purok">
                                                    <option disabled selected>Select Purok Name</option>
                                                    <?php foreach($purok as $row):?>
                                                        <option value="<?= ucwords($row['purok']) ?>"><?= $row['purok'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Voters Status</label>
                                                <select class="form-control vstatus" required name="vstatus" id="vstatus">
                                                    <option disabled selected>Select Voters Status</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Tax no</label>
                                                <input type="text" class="form-control" placeholder="Enter Tax No." name="taxno" id="taxno" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Enter Email Address" name="email" id="email" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" name="number" id="number" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks" placeholder="Enter Remarks" id="remarks" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Puporse</label>
                                        <textarea class="form-control" name="purpose" placeholder="Enter Purpose" id="purpose" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="res_id">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <?php if(isset($_SESSION['fullname'])): ?>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif ?>
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
        function editResident(that) {
    var id = $(that).attr('data-id');
    var pic = $(that).attr('data-img');
    var nat_id = $(that).attr('data-national');
    var fname = $(that).attr('data-fname');
    var mname = $(that).attr('data-mname');
    var lname = $(that).attr('data-lname');
    var address = $(that).attr('data-address');
    var bplace = $(that).attr('data-bplace');
    var bdate = $(that).attr('data-bdate');
    var age = $(that).attr('data-age');
    var cstatus = $(that).attr('data-cstatus');
    var gender = $(that).attr('data-gender');
    var purok = $(that).attr('data-purok');
    var vstatus = $(that).attr('data-vstatus');
    var email = $(that).attr('data-email');
    var number = $(that).attr('data-number');
    var taxno = $(that).attr('data-taxno');
    var citi = $(that).attr('data-citi');
    var occu = $(that).attr('data-occu');
    var dead = $(that).attr('data-dead');
    var remarks = $(that).attr('data-remarks');
    var purpose = $(that).attr('data-purpose');

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

    if (dead == 1) {
        $("#alive").prop("checked", true);
    } else {
        $("#dead").prop("checked", true);
    }

    var str = pic;
    var n = str.includes("data:image");
    if (!n) {
        pic = 'assets/uploads/resident_profile/' + pic;
    }
    $('#image').attr('src', pic);
}

    </script>
</body>
</html>