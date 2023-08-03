<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php' 
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
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
                                <h1 class="text fw-bold" style="font-size: 50px;">Generate Certificate</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt-2">
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
										<div class="card-title">Certificate of Residency</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body" id="printThis">
                                    <div class="header d-flex flex-wrap justify-content-around">
                                            <div class="text-center">
                                                <h1 class="fw-bold mb-1">Republic of the Philippines</h1>
                                                <h1 class="fw-bold mb-1">City of <?= ucwords($province) ?></h1>
                                                <h1 class="fw-bold mb-1"  style="font-size: 45px;"><?= ucfirst($brgy) ?></i></h1>
                                                <h2 class="fw-bold mb-2" style="font-size: 24px;"><?= ucwords($town) ?></h2>				
                                                <h2 style="font-size: 20px;"><i class="fas fa-phone" style="color: yellow;"></i> <span class="fw-bold"><?= $number ?></span>  &nbsp  <i class="fw-bold fa fa-envelope" style="color: yellow;"></i> <span class="fw-bold"><?= $b_email ?></span> </h2>
                                            </div>
                                        <div class="text-center mt-3">
                                            <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid mr-4" width="150">
                                            <img src="assets/uploads/<?= $city_logo ?>" class="img-fluid" width="150">
                                        </div>
                                    </div>                                 
                                    <div class="content-letter">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold mb-5" style="font-size:100px;">BARANGAY RESIDENCY</h1>
                                            </div>
                                            <span class="text" style="text-align: justify;">
                                                    To Whom It May Concern:
                                            </span>
                                            <div class="letter">
                                                <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                    This is to certify that 
                                                    <span class="fw-bold" style="font-size:24px"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></span>, 
                                                    of legal age, a bona fide resident of 
                                                    <span class="text"> Purok <?= ucwords($resident['purok']) ?></span>, 
                                                    <span class="text"><?= ucwords($town) ?></span>, Davao City.
                                                </h2>
                                                <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                    This further certifies that the abovementioned is living in this Barangay for (<?= ucwords($resident['purpose']) ?>) years.
                                                </h2>
                                                <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                    This certification is issued upon the request of the aforementioned for 
                                                    <span class="fw-bold"><?= ucwords($resident['remarks']) ?></span> 
                                                    or for whatever legal purpose/s that may serve her/him best.
                                                </h2>
                                                <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                    Done this <span class="fw-bold">
                                                    <?= date('jS \d\a\y \o\f F, Y') ?></span> at <span class="fw-text"><?= ucwords($town) ?></span>, Davao City.
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="signature col-md-12">
                                            <div class="p-3 text-right mt-5">
                                                <h2 class="fw-bold mb-6"><u><?= ucwords($captain['fullname']) ?></u></h2>
                                                <p class="text mr-4">PUNONG BARANGAY</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-content">
                                        <div class="footer-names text-left">                                                       
                                            <ul>
                                                <li><h1 class="fw-bold" style="font-size: 30px; margin-top: 90px; color:white"><?= ucwords($captain['fullname']) ?></h1></li>
                                                <li><h4 class="text" style="color:yellow">PUNONG BARANGAY</h4></li>
                                            </ul>                                                                                                 
                                        </div>
                                        <div class="footer-names text-left">                                                        
                                            <ul>
                                                <h2 class="fw-bold text-white"><u>BARANGAY KAGAWAD</u></h2>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad1['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad2['fullname']) ?></h3></li>                                                
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad4['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad5['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad6['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad7['fullname']) ?></h3></li>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad3['fullname']) ?></h3></li>
                                            </ul>                                                       
                                        </div>
                                        <div class="footer-names text-left mt-3">                                                       
                                            <ul>
                                                <li><h3 class="fw-bold"><?= ucwords($kagawad8['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">IPMR</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($skchairman['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">SK Chairman</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($sec['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">Barangay Secretary</h6></li>
                                                <li><h3 class="fw-bold"><?= ucwords($treasurer['fullname']) ?></h3></li>
                                                <li><h6 class="fw-bold text-white" style="font-size: 15px;">Barangay Treasurery</h6></li>
                                            </ul>                                                       
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- Modal -->
           <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_pment.php" >
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="datetime" class="form-control" name="date" value="<?= date('Y-m-d H:i:s') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Certificate of Residency</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" name="name" value="<?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>">
                            <input type="hidden" name="email" value="<?= ucwords($resident['email']) ?>">
                            <button type="button" class="btn btn-danger" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'templates/main-footer.php' ?>
			<?php if(!isset($_GET['closeModal'])){ ?>
                <script>
                    setTimeout(function(){ openModal(); }, 1000);
                </script>
            <?php } ?>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function openModal(){
                $('#pment').modal('show');
            }
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
    </script>
</body>
</html>