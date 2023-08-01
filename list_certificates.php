<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT *, r.id FROM tblresident AS r JOIN tblresident_requested AS s ON r.purok=s.purok";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}

    $query1 = "SELECT * FROM tblpurok";
    $result1 = $conn->query($query1);

    $purok = array();
	while($row2 = $result1->fetch_assoc()){
		$purok[] = $row2; 
	}
    
    $sql = "SELECT *, list_certificates FROM tblcertificates";
    $result2 = $conn->query($sql);

    $cert = array();
	while($row3 = $result2->fetch_assoc()){
		$cert[] = $row3; 
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
                                    <h1 class="text-black fw-bold" style = "font-size: 400%;">Generate Certificates</h1>
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
                                    <h1 class="card-title">Certificate Management</h1>
                                    <div class="d-flex align-items-right align-items-md-right justify-content-end flex-column flex-md-row mt-5 mr-2">
                                        <div class="col-sm-12 col-md-4 text-center">
                                            <select class="form-control" id="certType" name="certType">
                                                <option value="Default" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Default') echo 'selected'; ?>>Select Types of Certificates</option>
                                                <option value="Barangay Clearance" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Clearance') echo 'selected'; ?>>Barangay Clearance</option>
                                                <option value="Barangay Identification" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Barangay Identification') echo 'selected'; ?>>Barangay Identification</option>
                                                <option value="Certificate of Residency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Residency') echo 'selected'; ?>>Certificate of Residency</option>
                                                <option value="Certificate of Indigency" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Indigency') echo 'selected'; ?>>Certificate of Indigency</option>
                                                <option value="Firt Time Jobseekers" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Firt Time Jobseekers') echo 'selected'; ?>>Firt Time Jobseekers</option>
                                                <option value="Certificate of OATH Taking" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of OATH Taking') echo 'selected'; ?>>Certificate of OATH Taking</option>
                                                <option value="Certificate of Good Moral" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Good Moral') echo 'selected'; ?>>Certificate of Good Moral</option>
                                                <option value="Certificate of Live In" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Live In') echo 'selected'; ?>>Certificate of Live In</option>
                                                <option value="Family Home Estate Tax" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Family Home Estate Tax') echo 'selected'; ?>>Family Home Estate Tax</option>
                                                <option value="Certificate of Death" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Death') echo 'selected'; ?>>Certificate of Death</option>
                                                <option value="Certificate of Birth" <?php if (isset($_POST['certType']) && $_POST['certType'] === 'Certificate of Birth') echo 'selected'; ?>>Certificate of Birth</option>
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
                                                                        <a type="button" href="#" data-toggle="modal" class="btn btn-link btn-primary generate-certificate-btn-link" data-original-title="Edit Credentials" data-id="<?= $row['id'] ?>">
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
                <div class="modal fade" id="editclearance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="model/edit_resident_purok.php" enctype="multipart/form-data">
                                    <input type="hidden" name="size" value="1000000">
                                    <div class="col">
                                        <div class="form-group">
                                            <select class="form-control primary rstatus" required name="rstatus">
                                                <option disabled selected>Select Status</option>
                                                <option value="on hold">On Hold</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
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
                </dvi>
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
            var editBtn = row.querySelector(".generate-certificate-btn-link");
            switch (certType) {
                case 'Barangay Clearance':
                    generateBtn.href = 'generate_brgy_cert.php?id=' + residentId;
                    editBtn.href = '#editclearance?id=' + residentId;
                    break;
                case 'Barangay Identification':
                    generateBtn.href = 'generate_brgy_id.php?id=' + residentId;
                    editBtn.href = '#editbrgy_id?id=' + residentId;
                    break;
                case 'Certificate of Residency':
                    generateBtn.href = 'generate_residency_cert.php?id=' + residentId;
                    editBtn.href = '#editresidency?id=' + residentId;
                    break;
                case 'Certificate of Indigency':
                    generateBtn.href = 'generate_indi_cert.php?id=' + residentId;
                    editBtn.href = '#editindigency?id=' + residentId;
                    break;
                case 'Firt Time Jobseekers':
                    generateBtn.href = 'generate_jobseekers.php?id=' + residentId;
                    editBtn.href = '#editjobseekers?id=' + residentId;
                    break;
                case 'Certificate of OATH Taking':
                    generateBtn.href = 'generate_oath.php?id=' + residentId;
                    editBtn.href = '#editoath?id=' + residentId;
                    break;
                case 'Certificate of Good Moral':
                    generateBtn.href = 'generate_good_moral.php?id=' + residentId;
                    editBtn.href = '#editgood_moral?id=' + residentId;
                    break;
                case 'Certificate of Live In':
                    generateBtn.href = 'generate_live_in.php?id=' + residentId;
                    editBtn.href = '#editlive_in?id=' + residentId;
                    break;
                case 'Family Home Estate Tax':
                    generateBtn.href = 'generate_family_tax.php?id=' + residentId;
                    editBtn.href = '#editfamily_tax?id=' + residentId;
                    break;
                case 'Certificate of Death':
                    generateBtn.href = 'generate_death.php?id=' + residentId;
                    editBtn.href = '#editdeath?id=' + residentId;
                    break;
                case 'Certificate of Birth':
                    generateBtn.href = 'generate_birth.php?id=' + residentId;
                    editBtn.href = '#editbirth?id=' + residentId;
                    break;
                default:
                    generateBtn.href = 'list_certificates.php';
                    editBtn.href = 'list_certificates.php';
                    break;
                }
            }
        });
    });
</script>
</body>
</html>