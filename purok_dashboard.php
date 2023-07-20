<?php 
include 'server/server.php';
$query = "SELECT COUNT(DISTINCT details) as de FROM tblpayments WHERE details IN ('Barangay Clearance Payment', 'Business Permit Payment', 'Certificate of Residency Payment', 'Certificate of Indigency Payment')"; 
$revenue1 = $conn->query($query)->fetch_assoc();

$sql1 = "SELECT COUNT(name) as receipt FROM tblpayments";
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
	<title>Certifast Portal</title>
</head>
  <body>
  <?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="content">
					<div class="form">
                        <h1 class="text-left fw-bold ml-5 mt-5" style="font-size: 400%;">Purok Dashboard</h1>
                    </div>
					<div class="page-inner">
						<?php if(isset($_SESSION['message'])): ?>
								<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
									<?php echo $_SESSION['message']; ?>
								</div>
							<?php unset($_SESSION['message']); ?>
						<?php endif ?>							
                        <div class="row mt-5">
                            <div class="col-md-4">
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
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Hold</h2>
                                                    <h3 class="fw-bold" style="font-size: 35px; color: #C77C8D;"><?= number_format($receiptCount) ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a href="purok_info.php?state=purok" class="card-link text" style="color: gray;"></a>
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
                                                    <i class="fas fa-user-check fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Approved</h2>
                                                    <h3 class="fw-bold" style="font-size: 35px; color: #C77C8D;"><?= number_format($revenue3['am'],2)?></h3>
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
                                                    <i class="fas fa-user-alt-slash fa-2x" style="color: gray;"></i>
                                                </div>
                                            </div>
                                            <div class="col-2 col-stats">
                                            </div>
                                            <div class="col-2 col-stats">
                                                <div class="numbers mt-2">
                                                    <h2 class="text-uppercase" style="font-size: 16px;">Reject</h2>
                                                    <h3 class="fw-bold text-uppercase" style="font-size: 35px; color: #C77C8D;"><?= number_format($revenue1['de']) ?></h3>
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
                        </div>
                    </div>
				<?php include 'templates/main-footer.php' ?>
            </div>
        </div>
    </div>
    <?php include 'templates/footer.php' ?>
    </body>
</html>
