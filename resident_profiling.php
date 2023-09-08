<?php include 'server/db_connection.php' ?>
<?php 
if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["fullname"];

$sql = "SELECT *, tblresident.id, tblresident.purok FROM tblresident JOIN tbl_user_resident ON tblresident.requester = tbl_user_resident.fullname WHERE tbl_user_resident.fullname = ? AND tblresident.residency_status IN ('on hold', 'approved','rejected')";
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

$user = $_SESSION["user_email"];

$query1 = "SELECT * FROM tbl_user_resident WHERE tbl_user_resident.user_email=?";
$stmt = $conn->prepare($query1);
$stmt->bind_param("s", $user);
$stmt->execute();
$result1 = $stmt->get_result();

$res = array();
while($row2 = $result1->fetch_assoc()){
	$res[] = $row2; 
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
    <title>CertiFast Portal</title>
    <link rel="stylesheet" href="assets/css/profiling-style.css">
</head>
<body>
    <?php include 'templates/loading_screen.php' ?>
<div class="wrapper">
        <?php include 'templates/main-header-resident.php' ?>
        <?php include 'templates/sidebar-resident.php' ?>
        <div class="main-panel">
            <div class="container">
                <div class="panel-header">
                    <div class="page-inner mt-5">
                        <div class="text-center align-items-center align-items-md-center flex-column">
                            <h1 class="fw-bold mt-5" style="font-size: 2.5rem;">Resident Profiling</h1>
                            <h3 class="text-center">Please register your personal information first before requesting any certifications in Barangay Los Amigos.</h3>
                            <h5 class="text-center">(Mangyaring irehistro muna ang iyong personal na impormasyon bago humiling ng anumang sertipikasyon sa Barangay Los Amigos.)</h5>
                        </div>
                        <?php if(isset($_SESSION['fullname'])):?>
                            <div class="text-center fw-bold mt-5">
                                <a href="#add" data-toggle="modal" class="btn-request-now btn btn-danger" <?php echo isset($_SESSION['success']) || $nat > 0 ? 'disabled' : ''; ?>>
                                    CLICK HERE
                                </a>
                            </div>
                        <?php endif ?>
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
                    <div class="p-1 mb-4 bg-danger text-white">
                        <h5 class="text-left"> <i class="fas fa-exclamation-circle"></i> Upang maiwasan ang pagkalito sa panahon ng pagpaparehistro, mangyaring suriing muli kung ang lahat ng iyong impormasyon ay tumpak.</h5>
                    </div>
                    <div class="row justify-content-center">
                        <?php if(!empty($resident)): ?>
                            <?php foreach($resident as $row): ?>
                                <div class="col-md-6">
                                    <div class="card card-profile">                                       
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/'.$row['picture'] ?>" alt="Resident Profile" class="img-fluid rounded-circle mb-3">
                                            </div>
                                            <div class="text-center">
                                                <h3 class="fw-bold card-title mt-2"><?= ucwords($row['firstname'].' '.$row['middlename'].' '. $row['lastname']) ?></h3>
                                            </div>
                                            <div class="info-label mt-3"><strong>Barangay ID: </strong> <?= $row['national_id'] ?></div>
                                            <div class="info-label"><strong>Birthdate: </strong> <?= $row['birthdate'] ?></div>
                                            <div class="info-label"><strong>Birthplace: </strong> <?= $row['birthplace'] ?></div>
                                            <div class="info-label"><strong>Age: </strong> <?= $row['age'] ?></div>
                                            <div class="info-label"><strong>Civil Status: </strong> <?= $row['civilstatus'] ?></div>
                                            <div class="info-label"><strong>Gender: </strong> <?= $row['gender'] ?></div>
                                            <div class="info-label"><strong>Email: </strong> <?= $row['email'] ?></div>
                                            <div class="info-label"><strong>Contact: </strong> <?= $row['phone'] ?></div>
                                            <div class="info-label"><strong>Purok: </strong> <?= $row['purok'] ?></div>
                                            <div class="info-label mb-3"><strong>Status: </strong> <?= $row['residency_badge'] ?></div>
                                            <div class="info-label mt-4">
                                                <a href="#edit" data-toggle="modal" class="btn btn-primary btn-sm" onclick="editResident(this)" data-id="<?= $row['id'] ?>"
                                                data-id="<?= $row['id'] ?>" data-national="<?= $row['national_id'] ?>" data-fname="<?= $row['firstname'] ?>" data-mname="<?= $row['middlename'] ?>" data-lname="<?= $row['lastname'] ?>" data-address="<?= $row['address'] ?>" data-bplace="<?= $row['birthplace'] ?>" data-bdate="<?= $row['birthdate'] ?>" data-age="<?= $row['age'] ?>"
                                                data-cstatus="<?= $row['civilstatus'] ?>" data-gender="<?= $row['gender'] ?>"data-purok="<?= $row['purok'] ?>" data-vstatus="<?= $row['voterstatus'] ?>" data-taxno="<?= $row['taxno'] ?>" data-number="<?= $row['phone'] ?>" data-email="<?= $row['email'] ?>" data-occu="<?= $row['occupation'] ?>"
                                                data-img="<?= $row['picture'] ?>" data-citi="<?= $row['citizenship'];?>" data-dead="<?= $row['resident_type'];?>"data-status="<?= $row['residency_status'];?>">Details</a>
                                                <?php if(isset($_SESSION['fullname']) && $_SESSION['role']=='resident'):?>
                                                    <a href="model/remove_resident_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-danger btn-sm">Remove</a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?php include 'templates/main-footer.php' ?>
</div>
<?php include 'templates/footer.php' ?>

<?php include 'templates/footer.php' ?>
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
                                    <?php foreach($res as $row2):?>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="text-black form-control btn btn-light btn-info disabled" value="<?= $row2["user_email"] ?>" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label>Purok</label>
                                        <input type="text" class="form-control btn btn-light btn-info disabled" name="purok" value="<?= $row2["purok"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>What is your current address?</label>
                                        <input type="text" class="form-control btn btn-light btn-info disabled" placeholder="Ex: Tugbok, Los Amigos" name="address" value="<?= $row2["address"] ?>">
                                    </div>
                                    <?php endforeach ?>
                                    <div class="form-group">
                                        <label>Barangay ID No.</label>
                                        <input type="text" class="form-control btn btn-light btn-info" name="national" placeholder="Ex: BLA - 0000-000" value="">
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
                                        <label>What is your last name?</label>
                                        <input type="text" class="form-control" placeholder="Ex: Aldoe" name="lname" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Are you a Filipino or Half Filipino?</label>
                                        <input type="text" class="form-control" name="citizenship" placeholder="Ex: Filipino" required>
                                    </div>
                                    <div class="form-group">
                                        <label>What is your birthdate?</label>
                                        <input type="date" class="form-control" placeholder="Enter your birthdate" name="bdate" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Where did you born?</label>
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
                                        <label>Are you already a voters?</label>
                                        <select class="form-control" required name="vstatus">
                                            <option disabled selected>Select Voters Status</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
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
                            <div class="modal-footer mt-2 d-flex justify-content-center">
                                <input type="hidden" name="requester" value="<?= $_SESSION["fullname"]; ?>" required>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
                    <h5 class="modal-title" id="exampleModalLabel">View Profiling</h5>
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
                                <div class="form-group text-center mt-3">
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
                                    <label>Purok Leader Verification</label>
                                    <input type="text" class="text-uppercase form-control btn btn-primary disabled" name="status" id="status" required>
                                </div>
                                <div class="form-group">
                                    <label>Barangay ID</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" name="national" id="nat_id" placeholder="Ex: BLA - 0000-000">
                                </div>
                                <div class="form-group">
                                    <label>Citizenship</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" name="citizenship" id="citizenship" placeholder="Ex: Filipino" required>
                                </div>
                                <div class="form-group">
                                    <label>Complete Name (Last name, First name, Middle initial)</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" placeholder="Ex: Juan" name="fname" value="<?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" placeholder="Ex: Tugbok, Los Amigos" id="address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label>Place of Birth</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" placeholder="Ex: Tugbok, Los Amigos" name="bplace" id="bplace" required>
                                </div>
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input type="date" class="form-control btn btn-light btn-dark disabled text-black" placeholder="Enter Birthdate" name="bdate" id="bdate" required>
                                </div>
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="number" class="form-control btn btn-light btn-dark disabled text-black" placeholder="Age" min="1" name="age" id="age" required>
                                </div>
                                <div class="form-group">
                                    <label>Civil Status</label>
                                    <input class="form-control btn btn-light btn-dark disabled text-black" required name="cstatus" id="cstatus">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <input class="form-control btn btn-light btn-dark disabled text-black" required name="gender" id="gender">
                                </div>
                                <div class="form-group">
                                    <label>Purok</label>
                                    <input class="form-control btn btn-light btn-dark disabled text-black" required name="purok" id="purok">
                                </div>
                                <div class="form-group">
                                    <label>Voters Status</label>
                                    <input class="form-control btn btn-light btn-dark disabled text-black" required name="vstatus" id="vstatus">
                                </div>                      
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" value="<?= $row["user_email"] ?>" name="email" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" placeholder="+63 000-000-0000" name="number" id="number" required>
                                </div>
                                <div class="form-group">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control btn btn-light btn-dark disabled text-black" placeholder="Ex: Teacher" name="occupation" id="occupation" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const addressInput = document.getElementById('addressInput');

    addressInput.addEventListener('keydown', (event) => {
        event.preventDefault();
    });

    addressInput.addEventListener('paste', (event) => {
        event.preventDefault();
    });

    addressInput.addEventListener('contextmenu', (event) => {
        event.preventDefault();
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
    status 	= $(that).attr('data-status');

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
    $('#status').val(status);

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