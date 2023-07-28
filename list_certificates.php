<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT *, id FROM tblresident";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
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
					<div class="container">
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
                                    <div class="d-flex align-items-right align-items-md-right justify-content-end flex-column flex-md-row">
                                        <div class="col-sm-12 col-md-4 mr-3 text-center">
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
                                                                        <a type="button" data-toggle="tooltip" href="#" class="btn btn-link btn-primary generate-certificate-btn" data-original-title="Generate Certificate">
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
                    // Add more cases for other certificate types if needed
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