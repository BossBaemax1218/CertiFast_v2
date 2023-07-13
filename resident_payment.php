<?php
include 'server/db_connection.php';


if (!isset($_SESSION["fullname"])) {
    header("Location: login.php");
    exit;
}

$fullname = $_SESSION["fullname"];

$sql = "SELECT * FROM tblpayments JOIN tbl_user_resident ON tblpayments.name = tbl_user_resident.fullname WHERE tbl_user_resident.fullname = ? ORDER BY tblpayments.date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $fullname);
$stmt->execute();
$result = $stmt->get_result();

$revenue = array();
while ($row = $result->fetch_assoc()) {
    $revenue[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>                  
	<title>History</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
    <?php include 'templates/main-header-resident.php' ?>
		<?php include 'templates/sidebar-resident.php' ?>
		<div class="main-panel">
			<div class="content">
                    <div>
                        <h1 class="text-center fw-bold mt-5" style="font-size: 300%;">Payments History</h1>
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Alert Message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        <div class="form-group form-floating-label">
					                        <div class="page-inner">
                                                <?php if(isset($_SESSION['message'])): ?>
                                                        <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                                            <?php echo $_SESSION['message']; ?>
                                                        </div>
                                                    <?php unset($_SESSION['message']); ?>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-body">
                                            <div class="table-responsive mt-3">
                                                <table id="revenuetable" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Recipient</th>
                                                            <th scope="col">Details</th>
                                                            <th scope="col">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($revenue)): ?>
                                                            <?php $no = 1; foreach ($revenue as $row): ?>
                                                                <tr>
                                                                    <td><?= $row['date'] ?></td>
                                                                    <td><?= $row['fullname'] ?></td>
                                                                    <td><?= $row['details'] ?></td>
                                                                    <td><i class="fa-solid fa-peso-sign"></i> <?= number_format($row['amounts'], 2) ?></td>
                                                                </tr>
                                                            <?php $no++; endforeach ?>
                                                        <?php else: ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center">No Available Data</td>
                                                            </tr>
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