<?php include 'server/server.php' ?>
<?php 
    $query = "SELECT COUNT(DISTINCT certificate_name) as de FROM tblresident_requested WHERE status='approved'"; 
    $revenue1 = $conn->query($query)->fetch_assoc();

    $sql1 = "SELECT COUNT(DISTINCT email) as receipt FROM tblpayments";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $receiptCount = $row1['receipt'];

	$query2 = "SELECT SUM(amounts) as am FROM tblpayments ORDER BY `date` DESC";
	$revenue3 = $conn->query($query2)->fetch_assoc();

    $sql = "SELECT * FROM tblpayments ORDER BY `date` DESC";
    $result = $conn->query($sql);

    $revenue = array();
	while($row = $result->fetch_assoc()){
		$revenue[] = $row; 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>                 
	<title>CertiFast Portal</title>
</head>
<body>
<?php include 'templates/header.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
					<div class="page-inner mt-2">
                        <div class="panel-header">
                            <div class="page-inner">
                                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                    <div>
                                        <h1 class="text-center fw-bold" style="font-size: 300%;">Transaction Reports</h1>
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
                                                    <i class="fas fa-user-check fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Recipient</h2>
                                                    <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($receiptCount) ?></h3>
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
                                                    <i class="fa-solid fa-peso-sign fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Payments</h2>
                                                    <h3 class="fw-bold" style="font-size: 30px; color: #C77C8D;"><?= number_format($revenue3['am'],2)?></h3>
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
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Approved</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 30px; color: #C77C8D;"><?= number_format($revenue1['de']) ?></h3>
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
                    <?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Transaction History</div>
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
                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="min">Minimum Date</label>
                                                        <input type="text" class="form-control datepicker" placeholder="Enter Date" id="min">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="max">Maximum Date</label>
                                                        <input type="text" class="form-control datepicker" placeholder="Enter Date" id="max">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive mt-3">
                                                <table id="residenttable" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">Date</th>
                                                            <th scope="col">Recipient</th>
                                                            <th scope="col">Details</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Cashier</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($revenue)) : ?>
                                                            <?php $no = 1;
                                                            foreach ($revenue as $row) : ?>
                                                                <tr>
                                                                    <td class="text-center"><?= $row['date'] ?></td>
                                                                    <td><?= $row['name'] ?></td>
                                                                    <td><?= $row['details'] ?></td>
                                                                    <td> <i class="fa-solid fa-peso-sign"></i> <?= number_format($row['amounts'], 2) ?></td>
                                                                    <td><?= $row['user'] ?></td>
                                                                    <td class="text-center">
                                                                        <div class="form-button-action">
                                                                            <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                                                                                <a type="button" data-toggle="tooltip" href="model/remove_payment.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this data?');" class="btn btn-link btn-danger" data-original-title="Remove">
                                                                                    <i class="fas fa-trash"></i>
                                                                                </a>
                                                                            <?php endif ?>
                                                                        </div>
                                                                    </td>
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
    <script src="assets/js/min-max-date.js"></script>
    <script>
        $(document).on("click", "#pdf", function () {
        console.log("Exporting revenue table as PDF...");

        const currentDate = new Date().toISOString().slice(0, 10);

        const title = "Transaction Reports - " + currentDate;
        const filename = "Transaction_" + currentDate + ".pdf";

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