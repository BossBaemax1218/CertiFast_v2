<?php include 'server/server.php' ?>
<?php 
    $query = "SELECT COUNT(certificate_name) as pending FROM tblresident_requested WHERE status = 'on hold'"; 
    $revenue1 = $conn->query($query)->fetch_assoc();

    $sql1 = "SELECT COUNT(certificate_name) as approved FROM tblresident_requested WHERE status = 'approved'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $residencyCount = $row1['approved'];

	$query2 = "SELECT COUNT(certificate_name) as rejected FROM tblresident_requested WHERE status = 'rejected'";
	$revenue3 = $conn->query($query2)->fetch_assoc();

    $sql = "SELECT *, r.id, r.email, s.cert_id, s.certificate_name, s.status, s.date_applied 
    FROM tblresident AS r 
    JOIN tblresident_requested AS s ON r.certificate_name = s.certificate_name 
    WHERE s.status IN('approved','rejected')";
    $result = $conn->query($sql);

    $resident = array();
    $approvedResidents = array();

    while ($row = $result->fetch_assoc()) {
    $status = $row['status'];
    $statusBadge = '';

    if ($status == 'on hold') {
        $statusBadge = '<span class="badge badge-warning">On Hold</span>';
    } elseif ($status == 'approved') {
        $statusBadge = '<span class="badge badge-success">Approved</span>';
    } elseif ($status == 'rejected') {
        $statusBadge = '<span class="badge badge-danger">Rejected</span>';
    }

    $row['residency_badge'] = $statusBadge;

    if ($status == 'on hold' || $status == 'rejected') {
        $resident[] = $row;
    } elseif ($status == 'approved') {
        $resident[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>     
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <script src="https://cdn.jsdelivr.net/npm/table-html-export"></script>              
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
					<div class="page-inner mt-2">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
                        <div class="panel-header">
                                <div class="page-inner">
                                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                        <div>
                                            <h1 class="text-center fw-bold" style="font-size: 300%;">Certificate Reports</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-stats card card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-file-alt fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Pending</h2>
                                                    <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($revenue1['pending']) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=all" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card card-round" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-file-alt fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Approved</h2>
                                                    <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($residencyCount)?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="revenue.php?state=revenue" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-file-alt fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h3 class="text-uppercase" style="font-size: 16px;">Rejected</h3>
                                                    <h5 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($revenue3['rejected'])?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
					    </div>
						<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
						<?php endif ?>
					</div>
                    <div class="page-inner">
                        <div class="row mt--2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Certificate Reports</div>
                                            <?php if(isset($_SESSION['username'])):?>
                                            <div class="card-tools">
                                                <a id="pdf" class="btn btn-danger btn-border btn-round btn-sm">
                                                    <i class="fas fa-download"></i>
                                                    Export PDF
                                                </a>
                                            </div>
                                            <?php endif ?>
                                            </div>
                                        </div>
                                    <div class="card-body">
                                        <div class="table-responsive mt-3">
                                            <table id="residenttable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">Date</th>
                                                        <th scope="col">Recipient</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Certificate</th>
                                                        <th class="text-center" scope="col">Status</th>
                                                        <th class="text-center" scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($resident)): ?>
                                                        <?php $no=1; foreach($resident as $row): ?>
                                                        <tr>
                                                            <td class="text-center"><?= $row['date_applied'] ?></td>
                                                            <td><?= $row['resident_name'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['certificate_name'] ?></td>
                                                            <td class="text-center"><?= $row['residency_badge'] ?></td>
                                                            <td class="text-center">
                                                                <div class="form-button-action">
                                                                    <?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
                                                                    <a type="button" data-toggle="tooltip" href="model/remove_resident_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this data?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                    <?php endif ?>
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
				<?php include 'templates/main-footer.php' ?>
	        </div>
	    </div>
	<?php include 'templates/footer.php' ?>
<script src="assets/js/min-max-date.js"></script>
<script>
        $(document).on("click", "#pdf", function () {
        console.log("Exporting revenue table as PDF...");

        const currentDate = new Date().toISOString().slice(0, 10);

        const title = "Certification Reports - " + currentDate;
        const filename = "Certificates_" + currentDate + ".pdf";

        const doc = new jsPDF();

        doc.setFontSize(20);
        doc.text(title, 15, 15);

        const options = { startY: 25 };
        doc.autoTable({ html: "#residenttable", startY: 30 });

        doc.save(filename);
        });
    </script>
</body>
</html>