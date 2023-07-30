<?php
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["fullname"];

$sql = "SELECT *, tblresident.id, tblresident.purok FROM tblresident JOIN tbl_user_resident ON tblresident.email = tbl_user_resident.user_email WHERE tbl_user_resident.fullname = ? AND tblresident.residency_status IN ('on hold', 'rejected')";
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
    } elseif ($status == 'rejected') {
        $statusBadge = '<span class="badge badge-danger">Rejected</span>';
    }

    $row['residency_badge'] = $statusBadge;

    if ($status == 'on hold') {
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
    <link rel="stylesheet" href="assets/css/menu-style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel mt-2">
			    <div class="content">
                    <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                    <h3 class="text-center fw-bold"> Here are the online registration request with CertiFast Portal. </h3>
                    <div class="page-inner">
                        <div class="container col-sm-12 col-md-12">
                            <form method="GET" class="col-sm-12 col-md-12">
                                <div class="input-group">
                                    <select class="form-control" id="certType" name="search">
                                        <option value="Default" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Default') echo 'selected'; ?>>Select Types of Certificates</option>
                                        <option value="Show All" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Show All') echo 'selected'; ?>><b>Show All</b></option>
                                        <option value="Barangay Clearance" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                                        <option value="Barangay Identification (ID)" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Identification (ID)') echo 'selected'; ?>>Barangay Identification (ID)</option>
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
                                    <button type="submit" class="btn btn-danger">Apply Filter</button>                           
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(isset($_SESSION['message'])): ?>
                                    <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                        <?php echo $_SESSION['message']; ?>
                                    </div>
                                    <?php unset($_SESSION['message']); ?>
                                <?php endif ?>

                                <div class="container">
                                    <?php
                                    // Array of box data
                                    $boxes = array(
                                        array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => 'Barangay Clearance',
                                            'description' => 'Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.',
                                            'link' => '#add',
                                        ),
                                        array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => 'Certificate of Indigency',
                                            'description' => 'Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.',
                                            'link' => 'generate_indi_cert.php',
                                        ),
                                        array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => 'Certificate of Residency',
                                            'description' => 'Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.',
                                            'link' => 'generate_residency_cert.php',
                                        ),
                                        array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => 'Business Permit',
                                            'description' => 'Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.',
                                            'link' => 'business_permit.php',
                                        ),
                                        array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => 'Barangay Identification (ID)',
                                            'description' => 'Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.',
                                            'link' => 'generate_brgy_id.php',
                                        ),
                                        array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => 'Certificate of OATH Taking',
                                            'description' => 'Lorem ipsum dolor sitamet, stphen hawkin so adipisicing elit. Ratione disuja doloremque reiciendi nemo.',
                                            'link' => 'generate_oath.php',
                                        ),
                                        // Add more box data as needed
                                    );

                                    function filterBoxes($boxes, $searchTerm) {
                                        if ($searchTerm === 'Show All') {
                                            return $boxes;
                                        }

                                        $filteredBoxes = array();
                                        foreach ($boxes as $box) {
                                            if (stripos($box['name'], $searchTerm) !== false) {
                                                $filteredBoxes[] = $box;
                                            }
                                        }
                                        return $filteredBoxes;
                                    }
                                    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                                    if (!empty($searchTerm)) {
                                        $filteredBoxes = filterBoxes($boxes, $searchTerm);
                                    } else {
                                        $filteredBoxes = $boxes;
                                    }

                                    foreach ($filteredBoxes as $box):
                                    ?>
                                    <div class="d-flex flex-column align-items-center box mb-3">
                                        <div class="image">
                                            <img src="<?php echo $box['image']; ?>">
                                        </div>
                                        <div class="name_job"><?php echo $box['name']; ?></div>
                                        <p><?php echo $box['description']; ?></p>
                                        <div class="btns">
                                            <button class="btn btn-danger"><a href="<?php echo $box['link']; ?>" data-toggle="modal" style="text-decoration:none; color:white;">Request</a></button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <form method="POST" action="model/save_resident_user.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="height: 250;" class="text-center" id="my_camera">
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
                                                <label>Barangay ID No.</label>
                                                <input type="text" class="form-control" name="national" placeholder="Enter Barangay ID No." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Citizenship</label>
                                                <input type="text" class="form-control" name="citizenship" placeholder="Enter citizenship" required>
                                            </div>
                                            <div class="form-group">
                                                <label>First name</label>
                                                <input type="text" class="form-control" placeholder="Enter First name" name="fname" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Middle name</label>
                                                <input type="text" class="form-control" placeholder="Enter Middle name" name="mname" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" class="form-control" placeholder="Enter Last name" name="lname" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Enter Address" name="address" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Place of Birth</label>
                                                <input type="text" class="form-control" placeholder="Enter Birthplace" name="bplace" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Birthdate</label>
                                                <input type="date" class="form-control" placeholder="Enter Birthdate" name="bdate" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="number" class="form-control" placeholder="Enter Age" min="1" name="age" required>
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
                                                <input type="number" class="form-control" placeholder="Enter Tax number" min="6" name="taxno" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Enter Email Address" value="no-email@sample.com" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Enter Contact Number" value="+63 000-000-000-00" name="number" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Requirements</label>
                                                <textarea class="form-control" name="remarks" required placeholder="Sample Requirements (4ps Requirements)"></textarea>
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