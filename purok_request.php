<?php
include 'server/server.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["username"];

$query = "SELECT *, tblresident.id AS id FROM tblresident JOIN tbl_user_admin ON tblresident.purok = tbl_user_admin.purok WHERE tbl_user_admin.username = ? AND tblresident.residency_status IN ('on hold', 'rejected')";
$stmt = $conn->prepare($query);
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
?>
<?php
$fullname = $_SESSION["username"];
$query1 = "SELECT * FROM tblpurok JOIN tbl_user_admin ON tblpurok.purok = tbl_user_admin.purok WHERE tbl_user_admin.username = ?";
$stmt = $conn->prepare($query1);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result1 = $stmt->get_result();

$purok = array();
while ($row2 = $result1->fetch_assoc()) {
    $purok[] = $row2;
}
$purokValue = isset($_SESSION['purok']) && !empty($_SESSION['purok']) ? ucwords($_SESSION['purok']) : '';

$purokNumber = !empty($purok) ? $purok[0]['purok'] : '';
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
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Barangay Los Amigos - CertiFast Portal</h1>
                        <h3 class="text-center mt-2" style="font-size: 150%;">The following is a list of records for Purok <?php echo ($purokNumber); ?> residents who are using the CertiFast Portal to request certifications.</h3>
                    <div class="page-inner mt-4">
                        <div class="content">
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
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Purok</th>
                                                        <th scope="col">Status</th>
                                                        <?php if(isset($_SESSION['username'])):?>
                                                        <?php if($_SESSION['role']=='administrator'):?>
													
                                                        <?php endif ?>
                                                        <th class="text-center" scope="col">Action</th>
                                                        <?php endif ?>
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
                                                            <td><?= $row['gender'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['purok'] ?></td>
                                                            <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                            <td class="text-center">
                                                                <div class="form-button-action">
                                                                    <a type="button" href="#edit" data-toggle="modal" class="btn btn-link btn-primary" title="View Resident" onclick="editResident(this)" 
                                                                        data-id="<?= $row['id'] ?>" data-rstatus="<?= $row['residency_status'] ?>">
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
                                        <select class="form-control primary rstatus" required name="rstatus" id="rstatus">
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
            </div>	
			<?php include 'templates/main-footer.php' ?>
        </div>	
	<?php include 'templates/footer.php' ?>
    <script>
    function editResident(that){
        id          = $(that).attr('data-id');
        rstatus     = $(that).data('rstatus');

        $('#res_id').val(id);
        $('#rstatus').val(rstatus);
    }
    </script>
</body>
</html>