<?php include 'server/server.php' ?>
<?php 
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit;
    }

$fullname = $_SESSION["username"];

$sql = "SELECT *, r.id, r.purok,r.residency_date,r.email FROM tblresident AS r JOIN tbl_user_admin AS a ON r.purok = a.purok WHERE a.username = ? AND r.residency_status IN ('approved','rejected')";
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
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
				<div class="panel-header">
                    <div class="d-flex align-items-center align-items-md-center flex-column">
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Resident Profiling History</h1>
                        <h4 class="text-center">This is the complete list of the requested resident's personal data from Barangay Los Amigos.</h4>
                    </div>
				</div>
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
                        <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>
                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title"></div>
										<div class="card-tools">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="table">
											<thead>
												<tr>
                                                    <th scope="col">Date</th>
													<th class="text-center" scope="col">Fullname</th>												
													<th scope="col">Birthdate</th>
                                                    <th scope="col">Email</th>
													<th scope="col">Purok</th>
                                                    <th class="text-center" scope="col">Status</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
                                                        <tr>
                                                            <td><?= $row['residency_date'] ?></td>
                                                            <td>
                                                                <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                            </td>														
                                                            <td><?= $row['birthdate'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['purok'] ?></td>
                                                            <td class="text-center"><?= $row['residency_badge'] ?></td>													
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
                <?php include 'templates/main-footer.php' ?>
            </div>	
        </div>
    <?php include 'templates/footer.php' ?>
</body>
</html>