<?php include 'server/server.php' ?>
<?php 
   include 'model/footer.php';
   $id = $_GET['id'];
   $query = "SELECT * FROM tblfirstjob WHERE job_id='$id'";
   $result = $conn->query($query);
   $resident = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>CertiFast Portal</title>
    <link rel="stylesheet" href="assets/css/payment-style.css">
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<?php include 'templates/main-header.php' ?>
		<?php include 'templates/sidebar.php' ?>
		<div class="main-panel">
			<div class="container mt-5">
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
					<div class="row mt--2">
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
										<div class="card-title">Certificate of Indigency</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body" id="printThis">
                                    <div class="card-header" style="background-color:forestgreen;">
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
                                    </div>
                                    <div class="content-letter">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <h1 class="mt-4 fw-bold" style="font-size:100px;">BARANGAY CERTIFICATION</h1>
                                                <p class="mt-1 text-center" style="font-size:24px;">(First Time Jobseekers Assistance - RA 11261)</p>
                                            </div>
                                            <h2 class="mt-3" style="text-align: justify; text-indent: 40px;">
                                                This is to certify that Mr./Ms.
                                                <span class="fw-bold" style="text-indent: 40px;"><?= ucwords($resident['fullname']) ?></span>, of legal age, and is a bona fide resident of 
                                                <span class="text" style="text-indent: 40px;"> Purok <?= ucwords($resident['purok']) ?></span>, 
                                                <span class="text" style="text-indent: 40px;"><?= ucwords($town) ?></span>, Davao City for <?= ucwords($town) ?>, is qualified availee of RA 11261 or the First Time Jobseekers Act of 2019.
                                            </h2>
                                            <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by RA 11261 through the Oath undertaking he/she has signed and executed in the presence of Barangay Official.                                                
                                            </h2>
                                            <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                Signed this <span class="text" style="text-indent: 40px;"><?= date('jS \d\a\y \o\f F, Y') ?></span>,
                                                in the City of Davao.
                                            </h2>
                                            <h2 class="mt-4" style="text-align: justify; text-indent: 40px;">
                                                <?php
                                                $oneYearValidation = strtotime('+1 year', strtotime(date('jS F, Y')));
                                                ?>
                                                This certification is valid only <span class="text" style="text-indent: 40px;"><u><?php echo date('jS F, Y', $oneYearValidation); ?></u></span> 
                                            </h2>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 90px;">
                                            <div class="p-3 text-right mt-2" style="margin-bottom: 300px;">
                                                <h2 class="fw-bold mb-6"><u><?= ucwords($captain['fullname']) ?></u></h2>
                                                <p class="text-right mr-4">PUNONG BARANGAY</p>
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
            <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_pment.php">
                                <div class="form-group">
                                    <label for="name">Payeer Name</label>
                                    <input type="text" id="name" name="name" value="<?= $resident['requester'] ?>" class="form-control payment-control btn btn-light btn-info">
                                </div>
                                <div class="form-group">
                                    <label for="payment-details">Payment Details</label>
                                    <textarea id="details" name="details" placeholder="Enter Payment Details" class="form-control payment-control btn btn-light btn-info">First Time Jobseekers</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="date-issued">Date Issued</label>
                                    <input type="datetime" id="date-issued" name="date" value="<?= date('Y-m-d') ?>" class="form-control payment-control btn btn-light btn-info">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Copies</label>
                                    <input type="number" id="quantity" name="quantity" value="<?= $resident['quantity'] ?>" class="form-control payment-control btn btn-light btn-info">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" id="price" name="price" placeholder="0.00" class="form-control payment-control btn btn-light btn-info" required>
                                </div>
                                <div class="form-group">
                                    <label class="fw-bold total-amount-label">Total Amount:</label>
                                    <input id="amount" name="amount" class="total-amount-value" value="₱ 0.00" style="border: none; background-color: transparent;">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="email" value="<?= $resident['email'] ?>">
                                <input type="hidden" name="requirement" value="<?= $resident['requirement'] ?>">
                                <button type="button" class="btn btn-danger" onclick="goBack()" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm and Pay</button>
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
    document.addEventListener("DOMContentLoaded", function () {
        var quantityInput = document.getElementById("quantity");
        var amountInput = document.getElementById("price");
        var totalAmountInput = document.getElementById("amount");

        function updateTotal() {
            var quantity = parseFloat(quantityInput.value) || 0;
            var amount = parseFloat(amountInput.value) || 0;
            var total = quantity * amount;
            totalAmountInput.value = "₱ " + total.toFixed(2);
        }

        quantityInput.addEventListener("input", updateTotal);
        amountInput.addEventListener("input", updateTotal);
    });
</script>
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