<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT *, id FROM tblresident";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}
    $query1 = "SELECT * FROM tblpurok ORDER BY `purok`";
    $result1 = $conn->query($query1);

    $purok = array();
	while($row2 = $result1->fetch_assoc()){
		$purok[] = $row2; 
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
				<div class="page-inner">
					<div class="row">
                        <div class="panel-header">
                            <div class="page-inner mt-2">
                                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row mb-2">
                                    <h2 class="text-black fw-bold" style = "font-size: 300%;">Generate Certificates</h2>
                                </div>
                            </div>
                        </div>
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
                                        <div class="card-title">Certificate Management</div>
                                    </div>
                                    <div class="d-flex align-items-right align-items-md-right justify-content-end flex-column flex-md-row mt-5">
                                        <div class="col-sm-12 col-md-4 text-center">
                                            <select class="form-control" id="certType" name="certType">
                                                <option value="Default" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Default') echo 'selected'; ?>>Select Types of Certificates</option>
                                                <option value="Barangay Clearance" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                                                <option value="Certificate of Residency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                                                <option value="Certificate of Indigency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                                                <option value="Certificate of Firt Time Jobseekers" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Firt Time Jobseekers') echo 'selected'; ?>>Certificate of Firt Time Jobseekers</option>
                                                <option value="Certificate of OATH Taking" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of OATH Taking') echo 'selected'; ?>>Certificate of OATH Taking</option>
                                                <option value="Certificate of Tree Planting" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Tree Planting') echo 'selected'; ?>>Certificate of Tree Planting</option>
                                                <option value="Certificate of Resident Information" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Resident Information') echo 'selected'; ?>>Certificate of Resident Information</option>
                                                <option value="Certificate of Residency Abroad" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency Abroad') echo 'selected'; ?>>Certificate of Residency Abroad</option>
                                                <option value="Certificate of Residency DSWD" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency DSWD') echo 'selected'; ?>>Certificate of Residency DSWD</option>
                                                <option value="Certificate of PUM-PUI" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of PUM-PUI') echo 'selected'; ?>>Certificate of PUM-PUI</option>
                                                <option value="Certificate of Lost Immunization Card" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Lost Immunization Card') echo 'selected'; ?>>Certificate of Lost Immunization Card</option>
                                                <option value="Certificate of Good Moral" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Good Moral') echo 'selected'; ?>>Certificate of Good Moral</option>
                                                <option value="Certificate of DLPC" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of DLPC') echo 'selected'; ?>>Certificate of DLPC</option>
                                                <option value="Certificate of Live In" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Live In') echo 'selected'; ?>>Certificate of Live In</option>
                                                <option value="Certificate of Oneness" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Oneness') echo 'selected'; ?>>Certificate of Oneness</option>
                                                <option value="Certificate of Low Income" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Low Income') echo 'selected'; ?>>Certificate of Low Income</option>
                                                <option value="Certificate of New-Appearance" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of New-Appearance') echo 'selected'; ?>>Certificate of New-Appearance</option>
                                                <option value="Certificate of Philheath POS Application" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Philheath POS Application') echo 'selected'; ?>>Certificate of Philheath POS Application</option>
                                                <option value="Certificate of Family Home Estate Tax" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Family Home Estate Tax') echo 'selected'; ?>>Certificate of Family Home Estate Tax</option>
                                                <option value="Certificate of Family Home Estate Tax-Celestial" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Family Home Estate Tax-Celestial') echo 'selected'; ?>>Certificate of Family Home Estate Tax-Celestial</option>
                                                <option value="Certificate of Death" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Death') echo 'selected'; ?>>Certificate of Death</option>
                                                <option value="Certificate of Residency-Deped" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency-Deped') echo 'selected'; ?>>Certificate of Residency-Deped</option>
                                                <option value="Certificate of Barangay" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Barangay') echo 'selected'; ?>>Certificate of Barangay</option>
                                                <option value="Certificate of Travel Derby" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Travel Derby') echo 'selected'; ?>>Certificate of Travel Derby</option>
                                                <option value="Certificate of Sold Pigs" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Sold Pigs') echo 'selected'; ?>>Certificate of Sold Pigs</option>
                                                <option value="Certificate of Birth" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Birth') echo 'selected'; ?>>Certificate of Birth</option>
                                            </select>                             
                                        </div>
                                        <div class="col-sm-12 col-md-4 text-center mr-3">
                                            <select class="form-control" id="authorize_status" name="authorize_status">
                                                <option value="Default" <?php if (isset($_POST['authorize_status']) && $_POST['authorize_status'] === 'Default') echo 'selected'; ?>>Select Types of Authorization</option>
                                                <option value="Yes" <?php if (isset($_POST['authorize_status']) && $_POST['authorize_status'] === 'Yes') echo 'selected'; ?>>Yes</option>
                                                <option value="No" <?php if (isset($_POST['authorize_status']) && $_POST['authorize_status'] === 'No') echo 'selected'; ?>>No</option>
                                            </select>                               
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="residenttable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fullname</th>
                                                        <th scope="col">Birthdate</th>
                                                        <th scope="col">Age</th>
                                                        <th scope="col">Civil Status</th>
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Purok</th>
                                                        <?php if (isset($_SESSION['username'])) : ?>
                                                            <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                        <?php endif ?>
                                                        <th class="text-center" scope="col">Action</th>
                                                        <?php endif ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($resident)) : ?>
                                                        <?php $no = 1;
                                                        foreach ($resident as $row) : ?>
                                                            <tr data-id="<?= $row['id'] ?>">
                                                                <td>
                                                                    <div class="avatar avatar-xs">
                                                                        <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                                    </div>
                                                                    <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                                                </td>
                                                                <td><?= $row['birthdate'] ?></td>
                                                                <td><?= $row['age'] ?></td>
                                                                <td><?= $row['civilstatus'] ?></td>
                                                                <td><?= $row['gender'] ?></td>
                                                                <td><?= $row['purok'] ?></td>
                                                                <?php if (isset($_SESSION['username'])) : ?>
                                                                    <?php if ($_SESSION['role'] == 'administrator') : ?>
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
                                                                        <a type="button" data-toggle="tooltip" href="#" class="btn btn-link btn-danger generate-certificate-btn" data-original-title="Generate Certificate">
                                                                            <i class="fas fa-print"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <?php endif ?>
                                                            </tr>
                                                        <?php $no++;
                                                        endforeach ?>
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
                                                    <input type="text" class="form-control" placeholder="Enter Tax No." name="taxno" id="taxno" required>
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
                                                <div class="form-group">
                                                    <label>Requirements</label>
                                                    <textarea class="form-control" required name="remarks" placeholder="Enter Remarks" id="remarks" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Purpose</label>
                                                    <textarea class="form-control" name="purpose" placeholder="Enter Purpose" id="purpose" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" id="res_id">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
    document.getElementById("certType").addEventListener("change", function () {
    var certType = this.value;
    var rows = document.querySelectorAll("#residenttable tbody tr");
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var residentId = row.getAttribute("data-id");
        var generateBtn = row.querySelector(".generate-certificate-btn");
        switch (certType) {
            case 'Barangay Clearance':
                generateBtn.href = 'generate_brgy_cert.php?id=' + residentId;
                break;
            case 'Certificate of Residency':
                generateBtn.href = 'generate_residency_cert.php?id=' + residentId;
                break;
            case 'Certificate of Indigency':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Firt Time Jobseekers':
                generateBtn.href = 'generate_jobseekers.php?id=' + residentId;
                break;
            case 'Certificate of OATH Taking':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Tree Planting':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Resident Information':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Residency Abroad':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Residency DSWD':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of PUM-PUI':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Lost Immunization Card':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Good Moral':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of DLPC':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Live In':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Oneness':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Low Income':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of New-Appearance':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Philheath POS Application':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Family Home Estate Tax':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Family Home Estate Tax-Celestial':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Death':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Residency-Deped':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Barangay':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Travel Derby':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Sold Pigs':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
            case 'Certificate of Birth':
                generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                break;
                
            default:
                generateBtn.href = 'list_certificates.php';
                break;
            }
        }
    });
});
</script>
</body>
</html>