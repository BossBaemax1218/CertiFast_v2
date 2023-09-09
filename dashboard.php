<?php include 'server/server.php';
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
$fullname = $_SESSION["username"];
$query = "SELECT *, r.id AS id, r.residency_date
          FROM tblresident AS r 
          JOIN tbl_user_admin AS a ON r.purok = a.purok 
          WHERE a.username = ? AND r.residency_status IN ('on hold') 
          ORDER BY r.id DESC"; 

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
    }

    $row['residency_badge'] = $statusBadge;

    if ($status == 'on hold') {
        $resident[] = $row;
    }
}
$stmt->close();

?>
<?php
include 'model/status.php';
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
            <div class="main-panel mt-5">
                <div class="container mt-5">
                    <div class="panel-header mt-2">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if (isset($_SESSION['username']) && ($_SESSION['role'] == 'staff' || $_SESSION['role'] == 'administrator')): ?>
                                            <div class="d-flex align-items-center align-items-md-center flex-column flex-md-row mb-2">
                                                <h5 class="fw-bold ml-2" style="font-size: 350%;">Dashboard</h5>
                                            </div>
                                            <?php if (isset($_SESSION['message'])): ?>
                                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <?php echo $_SESSION['message']; ?>
                                                </div>
                                                <?php unset($_SESSION['message']); ?>
                                            <?php endif ?>
                                            <div class="row mb-2">
                                                <div class="col-md-12">
                                                    <div class="chart-wrapper">
                                                        <?php include 'model/chart.php'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_SESSION['username']) && $_SESSION['role']=='purok leader'):?>
                        <div class="container">
                            <div class="form">
                                <h1 class="text-left fw-bold ml-1 mb-2 mt-2" style="font-size: 400%;">Purok Dashboard</h1>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-stats card card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fa-user-clock fa-2x" style="color: gray;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-2 col-stats">
                                                </div>
                                                <div class="col-2 col-stats">
                                                    <div class="numbers mt-2">
                                                        <h2 class="text-uppercase" style="font-size: 16px;">Pending</h2>
                                                        <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($pendingCount) ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-stats card card-round" >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fa-user-check fa-2x" style="color: gray;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-2 col-stats">
                                                </div>
                                                <div class="col-2 col-stats">
                                                    <div class="numbers mt-2">
                                                        <h2 class="text-uppercase" style="font-size: 16px;">Approved</h2>
                                                        <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($approvedCount)?></h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card card-stats card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="icon-big text-center">
                                                        <i class="fas fa-user-alt-slash fa-2x" style="color: gray;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-2 col-stats">
                                                </div>
                                                <div class="col-2 col-stats">
                                                    <div class="numbers mt-2">
                                                        <h2 class="text-uppercase" style="font-size: 16px;">Rejected</h2>
                                                        <h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($rejectedCount) ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="container">
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
                                            <div class="card-title fw-bold"></div>
                                            <?php if(isset($_SESSION['username'])):?>
                                                <div class="card-tools">
                                                    <a href="purok_request.php" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                        View All
                                                    </a>
                                                </div>
                                            <?php endif?>
                                        </div>                                    
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="" class="residenttable table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Fullname</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Purok</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                           
                                                    <?php if (!empty($resident)): ?>
                                                        <?php $no = 1; foreach ($resident as $row): ?>
                                                            <tr>
                                                                <td><?= $row['residency_date'] ?></td>
                                                                <td>
                                                                    <div class="avatar avatar-xs ml-3">
                                                                        <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/'.$row['picture'] ?>" alt="Resident Profile" class="avatar-img rounded-circle">
                                                                    </div>
                                                                    <?= ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?>
                                                                </td>
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
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php include 'templates/main-footer.php' ?>
        </div>
    </div>
<?php include 'templates/footer.php' ?>
</body>
</html>