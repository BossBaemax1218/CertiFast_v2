<?php
include 'server/server.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION["username"])) {
    if ($_SESSION['role'] == 'purok leader') {
        $off_q = "SELECT * FROM tblresident JOIN tbl_user_admin ON tblresident.purok = tbl_user_admin.purok WHERE tbl_user_admin.username = ? AND tblresident.residency_status = 'on hold'";
        $stmt = $conn->prepare($off_q);
        $stmt->bind_param("s", $_SESSION["username"]);
    } else {
        $off_q = "SELECT * FROM tblresident ON tblresident.purok = tbl_user_admin.purok WHERE tbl_user_admin.username = ? AND tblresident.residency_status = 'on hold'";
        $stmt = $conn->prepare($off_q);
    }
} else {
    $off_q = "SELECT * FROM tblresident JOIN tbl_user_admin ON tblresident.purok = tbl_user_admin.purok WHERE tbl_user_admin.username = ? AND tblresident.residency_status = 'on hold'";
    $stmt = $conn->prepare($off_q);
    $stmt->bind_param("s", $_SESSION["username"]);
}

$stmt->execute();
$result = $stmt->get_result();

$resident = array();
while ($row = $result->fetch_assoc()) {
    $status = $row['residency_status'];
    $statusBadge = '';
    if ($status == 'on hold') {
        $statusBadge = '<span class="badge badge-warning">On Hold</span>';
    } elseif ($status == 'approved') {
        $statusBadge = '<span class="badge badge-success">Approved</span>';
    }

    $row['residency_badge'] = $statusBadge;
    $resident[] = $row;
}

$stmt->close();

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
                    <div class="panel-header">
                    <div>
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                        <h2 class="text-center fw-bold" style="font-size: 200%;">Here are the Purok <?php echo isset($_SESSION['purok']) ? ucwords($_SESSION['purok']) : ''; ?> records requester with CertiFast Portal:</h2>
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
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
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
                                                                <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                                <td class="text-center">
                                                                <div class="form-button-action">
                                                                <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" 
                                                                    data-id="<?= $row['id'] ?>" 
                                                                    data-rstatus="<?= $row['residency_status'] ?>">
                                                                    <?php if(isset($_SESSION['username'])): ?>
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
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
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
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control primary rstatus" required name="rstatus" id="rstatus">
                                        <option disabled selected>Select Status</option>
                                        <option value="on hold">On Hold</option>
                                        <option value="approved">Approved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="text" name="id" id="res_id" readonly>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <?php if (isset($_SESSION['username'])): ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'templates/main-footer.php' ?>		
	    </div>
	<?php include 'templates/footer.php' ?>
    <script>
function editResident(that) {
    var id = $(that).attr('data-id');
    var rstatus = $(that).attr('data-rstatus');

    $('#res_id').val(id);
    $('#rstatus').val(rstatus);
}
    </script>
</body>
</html>