<?php
include 'server/db_connection.php';

if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["fullname"];

$sql = "SELECT *, tblresident.id, tblresident.purok FROM tblresident JOIN tbl_user_resident ON tblresident.email = tbl_user_resident.user_email WHERE tbl_user_resident.fullname = ? AND tblresident.residency_status IN ('on hold', 'operating','rejected')";
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
    }elseif ($status == 'operating') {
            $statusBadge = '<span class="badge badge-success">Operating</span>';
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

	<div class="wrapper">
		<?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel mt-2">
			    <div class="content">
                    <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Certificates</h1>
                    <div class="page-inner">
                        <div class="container col-sm-12 col-md-12">
                            <form method="GET" class="col-sm-12 col-md-12">
                                <div class="input-group">
                                    <select class="form-control" id="certType" name="search">
                                        <option value="Default" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Default') echo 'selected'; ?>>Select Types of Certificates</option>
                                        <option value="Show All" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Show All') echo 'selected'; ?>><b>Show All</b></option>
                                        <option value="Barangay Clearance" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                                        <option value="Business Permit" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Business Permit') echo 'selected'; ?>>Business Permit</option>
                                        <option value="Barangay Identification" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Identification') echo 'selected'; ?>>Barangay Identification (ID)</option>
                                        <option value="Certificate of Residency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                                        <option value="Certificate of Indigency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                                        <option value="First Time Jobseekers" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'First Time Jobseekers') echo 'selected'; ?>>First Time Jobseekers</option>
                                        <option value="Certificate of OATH Taking" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of OATH Taking') echo 'selected'; ?>>Certificate of OATH Taking</option>
                                        <option value="Certificate of Death" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Death') echo 'selected'; ?>>Certificate of Death</option>
                                        <option value="Certificate of Birth" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Birth') echo 'selected'; ?>>Certificate of Birth</option>
                                        <option value="Certificate of Good Moral" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Good Moral') echo 'selected'; ?>>Certificate of Good Moral</option>
                                        <option value="Certificate of Live In" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Live In') echo 'selected'; ?>>Certificate of Live In</option>
                                        <option value="Family Home Estate" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Family Home Estate') echo 'selected'; ?>>Family Home Estate</option>
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
                                    include 'server/db_connection.php';
                                    $sql = "SELECT * FROM tblcertificates";
                                    $result = mysqli_query($conn, $sql);
                                    $boxes = array();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $boxes[] = array(
                                            'image' => 'assets/img/brgyLA.png',
                                            'name' => $row['list_certificates'],
                                            'description' => $row['description'],
                                            'link' => $row['link'],
                                        );
                                    }

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
                                        <div class="name_job"><?php echo ucwords($box['name']); ?></div>
                                        <p><?php echo $box['description']; ?></p>
                                        <div class="btns">
                                            <a href="<?php echo $box['link']; ?>" data-toggle="modal"><button>Request</button></a>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="modal fade" id="addpermit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Business Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_permit_user.php" >
                                <div class="form-group">
                                    <label>Nature of Business Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Business Name" name="business_name"  required>
                                </div>
                                <div class="form-group">
                                    <label>Business Owner Name</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter Owner Name" name="owner1" value="<?= $_SESSION['fullname'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Business Email Address</label>
                                    <input type="text" class="form-control mb-2" placeholder="Enter Owner Name" name="email" value="<?= $_SESSION['user_email'] ?>" readonly>
                                </div>
								<div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Enter your business address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label>Business Location</label>
                                    <input type="text" class="form-control" placeholder="Enter your exact business location" name="location" required>
                                </div>
								<div class="form-group">
                                    <label>Date Applied</label>
                                    <input type="date" class="form-control" name="applied" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                       		</div>
							<div class="modal-footer">
                                <input type="text" name="certificate_name" value="business permit" required>
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-danger">Create</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        <div class="modal fade" id="addclearance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_clearance.php" enctype="multipart/form-data">
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
        <div class="modal fade" id="addresidency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_residency.php" enctype="multipart/form-data">
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
                <div class="modal fade" id="addindigency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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