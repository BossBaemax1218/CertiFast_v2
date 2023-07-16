<?php
include 'server/server.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION["username"];

$sql = "SELECT * FROM tblresident JOIN tbl_user_admin ON tblresident.purok = tbl_user_admin.purok WHERE tbl_user_admin.username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

if (!empty($resident)) {
    $_SESSION['purok'] = $resident[0]['purok'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
</head>
<body>

	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
                <div>
                    <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                    <h2 class="text-center fw-bold" style="font-size: 200%;">Here are the Purok <?php echo isset($_SESSION['purok']) ? ucwords($_SESSION['purok']) : ''; ?> records with CertiFast Portal:</h2>
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
                                <div class="card-header md-2">                                    
                                </div>
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
			<?php include 'templates/main-footer.php' ?>		
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>